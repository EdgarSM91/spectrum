<?php
namespace Modules\Dashboard\Controllers;
use Modules\Models\CdCategory;
use Modules\Models\CdSettingsPost;
use Modules\Models\Vsectionnotes;
use Phalcon\Http\Request;

class SectionsController extends ControllerBase
{
    public function indexAction(){
        $auth = $this->auth();
        if($auth){
            $category = str_replace("-"," ",$this->request->get("category"));
            $ct = new CdCategory();
            $ncgid = str_replace(" ","-",strtolower($auth["ncgid"]));
            if($auth["ncgid"]=="All"){
                $findCategory = $ct->findFirst("name_category='$category'");
                if($findCategory){
                    $post = new Vsectionnotes();
                    $findNew = $post->findFirst("name_category='$category' and important='1'");
                    $findNewSlider = $post->find("name_category='$category' and gallery='1' order by order_slider asc");
                    $this->view->setVar("findNew",$findNew);
                    $this->view->setVar("slider",$findNewSlider);
                    $this->view->setVar("category",$category);
                    $this->view->setVar("cgt",$findCategory);
                }
            }elseif($ncgid==$category){
                $findCategory = $ct->findFirst("name_category='$category'");
                if($findCategory){
                    $post = new Vsectionnotes();
                    $findNew = $post->findFirst("name_category='$category' and important='1'");
                    $findNewSlider = $post->find("name_category='$category' and gallery='1' order by order_slider asc");
                    $this->view->setVar("findNew",$findNew);
                    $this->view->setVar("slider",$findNewSlider);
                    $this->view->setVar("category",$category);
                    $this->view->setVar("cgt",$findCategory);
                }
            }
            else{$this->response->redirect("dashboard");}
        }else{
            $this->response->redirect("dashboard");
        }
    }
    public function homeAction(){
        $auth = $this->auth();
        if($auth['rol']=="ADMIN"){
            $post = new Vsectionnotes();
            $findNew = $post->findFirst("home=1");
            $this->view->setVar("findNew",$findNew);
        }else{
            $this->response->redirect("dashboard");
        }
    }
    public function feedPostAction(){
        if($this->auth()){
            $word = $this->request->get("q");
            $category = $this->request->get("category");
            $type = $this->request->get("type");
            $pid = $this->request->get("pid");
            $note = new Vsectionnotes();
            if($type=="principal"){
                $find = $note->find("name_category='$category' and title like '$word%' and (gallery!=1 or gallery is null) ");
            }
            elseif($type=="slider"){
                if($pid){
                    $find = $note->find("name_category='$category' and title like '$word%' and pid!=$pid and (gallery!=1 or gallery is null) and (important!=1 or important is null)") ;
                }else{
                    $find = $note->find("name_category='$category' and title like '$word%' and (gallery!=1 or gallery is null) and (important!=1 or important is null)");
                }
            }elseif($type=="home"){
                $find = $note->find("title like '$word%' and (gallery!=1 or gallery is null)");
            }
            $content =array();
            foreach($find as $values){
                $content[$values->getPid()] = $values->getTitle();
            }
            $this->response($content,200);
        }else{
            exit;
        }
    }
    public function updateSectionAction(){
        $auth = $this->auth();
        $request = new Request();
        if($auth && $request->isAjax() && $request->isPost() && $this->security->checkToken($this->request->getPost('value'),$this->request->getPost('key'))){
            $token = $this->token();
            if($request->getPost("type")=="principal"){
                $pid = $request->getPost("principalNew");
                $principal_new = new CdSettingsPost();
                $pidLast = $request->getPost("pidLast");
                $cgid = $request->getPost("cgid");
                if($pidLast){
                    $find = $principal_new->findFirst("pid=$pidLast");
                    $find->setPid($pid);
                    $this->getResultSections($find,$find->update());
                }else{
                    $principal_new->setPid($pid)->setImportant(1)->setGallery(0)->setHeader(0)->setOrderPost(0)->setCgid($cgid);
                    $this->getResultSections($principal_new,$principal_new->save());
                }
            }elseif($request->getPost("type")=="slider"){
                $pid = $request->getPost("pid");
                $order = $request->getPost("order");
                $last = $request->getPost("last");
                $cgid  = $request->getPost("cgi");
                $orderSlider = new CdSettingsPost();
                if($last){
                    $find = $orderSlider->findFirst("pid=$last");
                    $find->setPid($pid);
                    $find->setCgid($cgid);
                    if($find->update()){
                        $pid_response = $find->getPid();
                        $this->response(array("token"=>array("value"=>$token['value'],"key"=>$token['key']),"message"=>"SUCCESS","code"=>200,"pid"=>$pid_response,"order"=>$order),200);
                    }
                }else{
                    $find = $orderSlider->findFirst("cgid=$cgid order by order_post desc");
                    if($find){
                        $orderSlider->setPid($pid)->setCgid($cgid)->setOrderPost($find->getOrderPost()+1)->setImportant(0)->setGallery(1)->setHeader(0)->setHome(0);
                    }else{
                        $orderSlider->setPid($pid)->setCgid($cgid)->setOrderPost(1)->setImportant(0)->setGallery(1)->setHeader(0)->setHome(0);
                    }
                    if($orderSlider->save()){
                        $pid_response = $orderSlider->getPid();
                        $this->response(array("token"=>array("value"=>$token['value'],"key"=>$token['key']),"message"=>"SUCCESS","code"=>200,"pid"=>$pid_response,"order"=>$order),200);
                    }
                }
            }elseif($request->getPost("type")=="home"){
                $pid = $request->getPost("principalNew");
                $principal_new = new CdSettingsPost();
                $pidLast = $request->getPost("pidLast");
                if($pidLast){
                    $find = $principal_new->findFirst("pid=$pidLast and home=1");
                    $find->setPid($pid);
                    $this->getResultSections($find,$find->update());
                }else{
                    $principal_new->setPid($pid)->setImportant(0)->setGallery(0)->setHeader(0)->setOrderPost(0)->setHome(1)->setCgid(1);
                    $this->getResultSections($principal_new,$principal_new->save());
                }
            }
        }else{
            $this->response(array("message"=>"error"),404);
        }
    }
    public function orderPostSectionsAction(){
        $auth = $this->auth();
        $request = $this->request;
        if($request->isPost() && $request->isAjax() && $auth){
            $pid = $request->getPost("pid");
            $order = $request->getPost("order");
            $cgid = $request->getPost("cgid");
            $photo = new CdSettingsPost();
            if($pid || $pid!=0){
                if($photo->setOrderSections($pid,$order,$cgid)){
                    $this->response(array("message"=>"SUCCESS","code"=>200),200);
                }else{
                    $result = array();
                    foreach ($photo->getMessages() as $key => $message) {
                        $result[$key]= $this->flash->error((string) $message);
                    }
                    $this->response(array("message"=>"$result","code"=>404),200);
                }
            }else{
                $this->response(array("message"=>"SUCCESS","code"=>300),200);
            }
        }else{
            $this->response(array("message"=>"error","code"=>404),404);
        }
    }
    public function getResultSections($object,$action){
        if($action){
            $token = $this->token();
            return $this->response(array("token"=>array("value"=>$token['value'],"key"=>$token['key']),"message"=>"SUCCESS","code"=>200,"pid"=>$object->getPid()),200);
        }else{
            foreach ($action->getMessages() as $key => $message) {
                $message[$key] = $this->flash->error((string) $message);
            }
            return $this->response(array("message"=>"$message","code"=>404),200);
        }
    }
}