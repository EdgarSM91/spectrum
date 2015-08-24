<?php
namespace Modules\Dashboard\Controllers;

use Modules\Models\CdCourses;
use Modules\Models\Vlistcourses;
use Phalcon\Http\Request;

class CourseController extends ControllerBase{
    public function indexAction(){
        $auth = $this->auth();
        if($auth){
            $this->view->setVar("courses",Vlistcourses::find("status='ACTIVE'"));
            $this->view->setVar("expressions",$this->expressions());
        }else{
            return $this->response->redirect("dashboard");
        }
    }
    public function inactiveAction(){
        $auth = $this->auth();
        if($auth){
            $this->view->setVar("courses",Vlistcourses::find("status='INACTIVE'"));
            $this->view->setVar("expressions",$this->expressions());
        }else{
            return $this->response->redirect("dashboard");
        }
    }
    public function newAction(){
        $auth = $this->auth();
        if($auth){
            $this->view->setVar("category",json_decode($this->getCategory(),true));
            $this->view->setVar("image",uniqid()."-".date("Y").".png");
        }else{
            return $this->response->redirect("dashboard");
        }
    }
    public function editAction(){
        $auth = $this->auth();
        $id = $this->dispatcher->getParam("id","int");
        if($auth && $id){
            $this->view->setVar("category",json_decode($this->getCategory(),true));
            $this->view->setVar("course",CdCourses::findFirst($id));
        }else{
            return $this->response->redirect("dashboard");
        }
    }
    public function saveAction(){
        $auth = $this->auth();
        $request = new Request();
        if($request->isPost() && $request->isAjax() && $auth && $this->security->checkToken($this->request->getPost('value'),$this->request->getPost('key'))){
            $course = new CdCourses();
            $course->setName($request->getPost("name"))
                ->setPermalink($request->getPost("permalink"))
                ->setImage($request->getPost("image"))
                ->setDescription($request->getPost("description"))
                ->setObjective($request->getPost("objective"))
                ->setDirected($request->getPost("directed"))
                ->setContent($request->getPost("content"))
                ->setCgid($request->getPost("category"))
                ->setStatus($request->getPost("status"))
                ->setUid($auth['uid'])
                ->setUidUpdate($auth['uid'])
                ->setDateCreation(date('Y-m-d H:i:s'));
            $token = $this->token();
            if($course->save()){
                $this->response(array("message"=>"SUCCESS","code"=>"200","token"=>array("key"=>$token['key'],"value"=>$token["value"])),200);
            }else{
                $this->response(array("message"=>"Error, try again","code"=>"300","token"=>array("key"=>$token['key'],"value"=>$token["value"])),200);
            }
        }else{
            $this->response(array("message"=>"error"),404);
        }
    }
    public function updateAction(){
        $auth = $this->auth();
        $request = new Request();
        $cid=$request->getPost("cid");
        if($request->isPost() && $request->isAjax() && $auth && $cid && $this->security->checkToken($this->request->getPost('value'),$this->request->getPost('key'))){
            $course = CdCourses::findFirst($cid);
            $course->setName($request->getPost("name"))
                ->setPermalink($request->getPost("permalink"))
                ->setImage($request->getPost("image"))
                ->setDescription($request->getPost("description"))
                ->setObjective($request->getPost("objective"))
                ->setDirected($request->getPost("directed"))
                ->setContent($request->getPost("content"))
                ->setCgid($request->getPost("category"))
                ->setStatus($request->getPost("status"))
                ->setUidUpdate($auth['uid']);
            $token = $this->token();
            if($course->update()){
                $this->response(array("message"=>"SUCCESS","code"=>"200","token"=>array("key"=>$token['key'],"value"=>$token["value"])),200);
            }else{
                $this->response(array("message"=>"Error, try again","code"=>"300","token"=>array("key"=>$token['key'],"value"=>$token["value"])),200);
            }
        }else{
            $this->response(array("message"=>"error"),404);
        }
    }
    public function uploadImageAction(){
        $request = $this->request;
        $auth = $this->auth();
        if($request->isPost() && $request->isAjax() && $auth){
            if($request->hasFiles()==true){
                foreach($request->getUploadedFiles() as $file){
                    $new_image = $request->getPost("name-image");
                    if($request->getPost("image-post")==1){
                        if($file->moveTo($this->public."dash/img/course/1024x576/".$new_image)){
                            imagepng(imagecreatefromstring(file_get_contents($this->public."dash/img/course/1024x576/".$new_image)),$this->public."dash/img/course/1024x576/".$new_image);
                            $this->response(array("name"=>$new_image,"message"=>"SUCCESS","code"=>"200"),200);
                        }
                        else{
                            $this->response(array("name"=>$new_image,"message"=>"error try again","code"=>"404"),200);
                        }
                    }else if($request->getPost("image-post")==2){
                        if($file->moveTo($this->public."dash/img/course/300x300/".$new_image)){
                            imagepng(imagecreatefromstring(file_get_contents($this->public."dash/img/course/300x300/".$new_image)),$this->public."dash/img/course/300x300/".$new_image);
                            $this->response(array("name"=>$new_image,"message"=>"SUCCESS","code"=>"200"),200);
                        }
                        else{
                            $this->response(array("name"=>$new_image,"message"=>"error try again","code"=>"404"),200);
                        }
                    }else{
                        $this->response(array("name"=>$new_image,"message"=>"error try again","code"=>"404"),200);
                    }
                }
            }
        }else{
            $this->response(array("message"=>"Error 404, try again."),404);
        }
    }
    public function validateUrlAction(){
        $request = $this->request;
        $auth = $this->auth();
        if($request->isPost() && $request->isAjax() && $auth && $this->security->checkToken($this->request->getPost('value'),$this->request->getPost('key'))){
            $post = new CdCourses();
            $name_post = $request->getPost("name");
            $new_url = $this->url_clean($name_post);
            $check_url = $post->find("permalink = '$new_url'");
            $count = 1;
            while(count($check_url)){
                $generate_url = $new_url."-".$count;
                $check_url = $post->find("permalink = '$generate_url'");
                if(count($check_url)==0){
                    $new_url = $generate_url;
                }
                $count++;
            }
            $token = $this->token();
            $this->response(array("message"=>"SUCCESS","new_url"=>$new_url,"code"=>"200","data"=>"url generated","token"=>array("value"=>$token['value'],"key"=>$token['key'])),200);
        }else{
            $token = $this->token();
            $this->response(array("message"=>"error","token"=>array("value"=>$token['value'],"key"=>$token['key'])),404);
        }
    }
}