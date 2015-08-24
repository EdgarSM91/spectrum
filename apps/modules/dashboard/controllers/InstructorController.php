<?php
namespace Modules\Dashboard\Controllers;
use Modules\Models\CdInstructor;
use Phalcon\Http\Request;

class InstructorController extends ControllerBase{
    public function indexAction(){
        $auth = $this->auth();
        if($auth){
            $this->view->setVar("instructors",CdInstructor::find("status='ACTIVE'"));
        }else{
            $this->response(array("message"=>"error"),404);
        }
    }
    public function inactiveAction(){}
    public function viewAction(){
        $auth = $this->auth();
        if($auth){
            $id = $this->dispatcher->getParam("id","int");
            $find = CdInstructor::findFirst($id);
            if($find){
                $this->view->setVar("instructor",$find);
            }else{
                return $this->response->redirect("dashboard/instructors");
            }
        }else{
            $this->response(array("message"=>"Error"),404);
        }
    }
    public function newAction(){
        $auth = $this->auth();
        if($auth){
            $this->view->setVar("image",uniqid()."-".date("Y").".png");
            $this->view->setVar("curriculum",uniqid()."-".date("Y").".pdf");
        }else{
            $this->response(array("message"=>"Error"),404);
        }
    }
    public function saveAction(){
        $auth = $this->auth();
        $request = new Request();
        if($request->isPost() && $request->isAjax() && $auth && $this->security->checkToken($this->request->getPost('value'),$this->request->getPost('key'))){
            $course = new CdInstructor();
            $date = $this->getFormatDate($request->getPost("beginning"));
            $course->setName($request->getPost("name"))
                ->setLastname($request->getPost("last_name"))
                ->setSecondname($request->getPost("second_name"))
                ->setImage($request->getPost("image"))
                ->setCurriculum($request->getPost("curriculum"))
                ->setSex($request->getPost("sex"))
                ->setTitle($request->getPost("title"))
                ->setDescription($request->getPost("description"))
                ->setBeginning($date)
                ->setJurisdiction($request->getPost("jurisdiction"))
                ->setStatus($request->getPost("status"))
                ->setDateCreation(date('Y-m-d H:i:s'));
            $token = $this->token();
            if($course->save()){
                $this->response(array("message"=>"SUCCESS","code"=>"200","token"=>array("key"=>$token['key'],"value"=>$token["value"])),200);
            }else{
                /*foreach ($course->getMessages() as $message) {
                    $this->flash->error((string) $message);}*/
                $this->response(array("message"=>"Error, try again","code"=>"300","token"=>array("key"=>$token['key'],"value"=>$token["value"])),200);
            }
        }else{
            $this->response(array("message"=>"error"),404);
        }
    }
    public function uploadFileAction(){
        $request = $this->request;
        $auth = $this->auth();
        if($request->isPost() && $request->isAjax() && $auth){
            if($request->hasFiles()==true){
                foreach($request->getUploadedFiles() as $file){
                    $new_file =null;
                    if($request->getPost("file-post")==1){
                       $new_file = $request->getPost("name-image");
                        if($file->moveTo($this->public."dash/img/instructor/img/".$new_file)){
                            imagepng(imagecreatefromstring(file_get_contents($this->public."dash/img/instructor/img/".$new_file)),$this->public."dash/img/instructor/img/".$new_file);
                            $this->response(array("name"=>$new_file,"message"=>"SUCCESS","code"=>"200","type"=>"image"),200);
                        }
                        else{
                            $this->response(array("name"=>$new_file,"message"=>"error try again","code"=>"404"),200);
                        }
                    }else if($request->getPost("file-post")==2){
                        $new_file = $request->getPost("curriculum");
                        if($file->moveTo($this->public."dash/img/instructor/curriculum/".$new_file)){
                            $this->response(array("name"=>$new_file,"message"=>"SUCCESS","code"=>"200","type"=>"pdf"),200);
                        }
                        else{
                            $this->response(array("name"=>$new_file,"message"=>"error try again","code"=>"404"),200);
                        }
                    }else{
                        $this->response(array("name"=>$new_file,"message"=>"error try again","code"=>"404"),200);
                    }
                }
            }
        }else{
            $this->response(array("message"=>"Error 404, try again."),404);
        }
    }
    private function getFormatDate($date){
        $dateP = $date;
        $newDate = explode("/",$dateP);
        return $newDate = $newDate["2"]."-".$newDate["1"]."-".$newDate["0"];
    }
}