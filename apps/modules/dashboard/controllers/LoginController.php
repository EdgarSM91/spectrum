<?php
namespace Modules\Dashboard\Controllers;
use Modules\Models\CdCategory;
use Modules\Models\CdUser;
use Phalcon\Mvc\Controller;
class LoginController extends \Phalcon\Mvc\Controller
{
    public function initialize(){
        $this->assets->collection("functions")->addJs("dash/css/general.min.css");
        $this->assets->collection('JsIndexLogin')
            ->setTargetPath("dash/js/login.min.js")
            ->setTargetUri("dash/js/login.min.js")
            ->addJs("dash/js/plugins/jquery/jquery.min.js")
            ->addJs("front/src/js/formValidation.min.js")
            ->addJs("front/src/js/bootstrapV.min.js")
            ->addJs("dash/js/custom.js")
            ->join(true)
            ->addFilter(new \Phalcon\Assets\Filters\Jsmin());
        $this->view->setLayout('login');
    }
    public function indexAction()
    {
    }
    public function sessionAction(){
        if($this->validate() && $this->security->checkToken()){
            $request = $this->request;
            $user = new CdUser();
            $email      = $request->getPost("email");
            $password   = $request->getPost("password");
            $session = $user->findFirst("email='$email'");
            if(!$session){
                $this->response(array("message"=>"ERROR","code"=>400,"notification"=>"email incorrect"),200);
            }
            else if($session->getStatus()=="ACTIVE"){
                if($this->security->checkHash($password,$session->getPassword())){
                    $this->_registerSession($session);
                    $this->response(array("message"=>"SUCCESS","code"=>200,"url"=>$this->url->getBaseUri()."dashboard"),200);
                }
                else{
                    $this->response(array("message"=>"ERROR","code"=>300,"notification"=>"Password incorrect"),200);
                }
            }
        }
        else{
            $this->response(array("message"=>"ERROR","code"=>404,"notification"=>"Values Not found !!!"),404);
        }
    }
    public function _registerSession($user){
        $this->session->set("auth",array(
                "uid" => $user->getUid(),
                "username"=>$user->getUsername(),
                "rol"=>$user->getRol(),
                "name"=>$user->getName(),
                "photo"=>$user->getPhoto(),
                "email"=>$user->getEmail()
            )
        );
    }
    public function logoutAction(){
        $this->session->remove("auth");
        $this->response->redirect("login");
        $this->flash->success('Goodbye!');
    }
    public function response($dataArray,$status)
    {
        $this->view->disable();
        if($status==200){
            $this->response->setStatusCode($status, "OK");
        }else{
            $this->response->setStatusCode($status, "ERROR");
        }
        $this->response->setJsonContent($dataArray);
        $this->response->send();
    }
    public function validate(){
        if($this->request->isPost() && $this->request->isAjax()){
            return true;
        }else{
            return false;
        }
    }
}
