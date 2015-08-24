<?php
namespace Modules\Dashboard\Controllers;
use Modules\Models\CdSocialMedia;
use Modules\Models\CdUser;
use Modules\Models\Vuserpost;
use Modules\Models\Vusers;
use Phalcon\Http\Request;

include dirname(dirname(dirname(dirname(__FILE__))))."/library/wideimage/WideImage.php";
require dirname(dirname(dirname(dirname(__FILE__))))."/library/PHPMailer/PHPMailerAutoload.php";

class UserController extends ControllerBase
{
    public function indexAction()
    {   $auth = $this->auth();
        if($auth){
            $this->assets->collection('jsMasonry')->addJs("dash/js/masonry.pkgd.min.js");
            $uid = $auth["uid"];
            $users = CdUser::find("uid!=$uid and status='ACTIVE'");
            $this->view->setVar("users",$users);
        }
    }
    public function inactiveAction()
    {   $auth = $this->auth();
        if($auth){
            $this->assets->collection('jsMasonry')->addJs("dash/js/masonry.pkgd.min.js");
            $uid = $auth["uid"];
            $users = CdUser::find("uid!=$uid and status='INACTIVE'");
            $this->view->setVar("users",$users);
        }
    }
    public function newUserAction(){
        $auth = $this->auth();
        if($auth){
            $this->view->setVar("category",json_decode($this->getCategory(),true));
            $this->view->setVar("auth",$auth);
        }else{
            exit();
        }
    }
    public function editAction(){
        $auth = $this->auth();
        if($auth){
            $uid = $this->dispatcher->getParam("id","int");
            $user = new CdUser();
            $find = $user->findFirst($uid);
            $this->view->setVar("user",$find);
            $this->view->setVar("auth",$auth);
        }else{
            return $this->response->redirect();
        }
    }
    public function saveUserAction(){
        $request = $this->request;
        $auth = $this->auth();
        if($request->isAjax() && $request->isPost() && $auth && $this->security->checkToken($this->request->getPost('value'),$this->request->getPost('key'))){
            $user = new CdUser();
            $find = $user;
            $usnm = str_replace(" ","-",$request->getPost("username"));
            $find->setName($request->getPost("name"))
                ->setLastName($request->getPost("last_name"))
                ->setSecondName($request->getPost("second_name"))
                ->setSex($request->getPost("sex"))
                ->setPhone($request->getPost("phone"))
                ->setUsername($usnm)
                ->setEmail($request->getPost("email"))
                ->setPhoto("no-image.jpg")
                ->setPassword($this->security->hash($request->getPost("password")))
                ->setRol($request->getPost('rol'))
                ->setStatus($request->getPost('status'))
                ->setDateCreation(date("Y-m-d H:i:s"));
            if($find->save()){
                $this->response(array("message"=>"SUCCESS","code"=>200),200);
            }else{
                foreach ($find->getMessages() as $message) {
                    $this->flash->error((string) $message);
                }
                $token = $this->token();
                $this->response(array("message"=>"try again","code"=>404,"token"=>array("value"=>$token['value'],"key"=>$token['key'])),200);
            }
        }else{
            $this->response(array("message"=>"try again","code"=>404),404);
        }
    }
    public function searchProfileAction(){
        $username = $this->dispatcher->getParam("username");
        $auth = $this->session->get("auth");
        $type = $this->dispatcher->getParam("type");
        $user_session = "";
        if($auth){
            $user_session = $auth['username'];
        }
        if($type=="search"){
            $donor = new VDonors();
            $find = $donor->findFirst("username='$username' and donor=1");
            if(!$find or $find->getUsername()==="$user_session"){
                if($user_session!=""){
                    return $this->response->redirect("usuario/mi-perfil/$user_session");
                }else{
                    return $this->response->redirect();
                }

            }
            $cd_donors = new CdDonors();
            $uid  = $find->getUid();
            $find_cd = $cd_donors->findFirst("uid=$uid");
            $visit = $find_cd->getVisit();
            $find_cd->setVisit($visit+1);
            $find_cd->update();
            if($find_cd->update()){
                $this->view->setVar("donor",$find);
            }else{
                return $this->response->redirect();
            }
        }
        else{
            return $this->response->redirect();
        }
    }
    public function profileAction(){
        $auth = $this->auth();
        if($auth){
            $uid = $auth['uid'];
            $user = new CdUser();
            $find = $user->findFirst("uid=$uid");
            $this->view->setVar("user",$find);
            $this->view->setVar("auth",$auth);
        }else{
            return $this->response->redirect();
        }
    }
    public function updateUserAction(){
        $request = new Request();
        $auth = $this->auth();
        if($request->isAjax() && $request->isPost() && $auth && $this->security->checkToken($this->request->getPost('value'),$this->request->getPost('key'))){
            $uid = $request->getPost("uid");
            $user = new CdUser();
            $find = $user->findFirst($uid);
            $usnm = str_replace(" ","-",$request->getPost("username"));
            $find->setName($request->getPost("name"))
                ->setLastName($request->getPost("last_name"))
                ->setSecondName($request->getPost("second_name"))
                ->setSex($request->getPost("sex"))
                ->setPhone($request->getPost("phone"))
                ->setUsername($usnm)
                ->setEmail($request->getPost("email"))
                ->setRol($request->getPost('rol')==null?$auth['rol']:$request->getPost('rol'))
                ->setStatus($request->getPost("status")==null?"ACTIVE":$request->getPost("status"));
            $token = $this->token();
            if($find->update()){
                $this->response(array("message"=>"SUCCESS","code"=>200,"redirect"=>$request->getPost('redirect'),"token"=>$token),200);
            }else{
                $this->response(array("message"=>"try again","code"=>404,"token"=>$token),200);
            }
        }else{
            return $this->response->redirect();
            exit();
        }
    }
    public function updatePasswordAction(){
        $request = $this->request;
        $auth = $this->auth();
        if($request->isAjax() && $request->isPost() && $auth && $this->security->checkToken($this->request->getPost('value'),$this->request->getPost('key'))){
            $uid = $request->getPost("uid");
            $user = new CdUser();
            $find = $user->findFirst($uid);
            $find->setPassword($this->security->hash($request->getPost("password")));
            if($find->update()){
                $token = $this->token();
                $this->response(array("token"=>array("value"=>$token['value'],"key"=>$token['key']),"message"=>"SUCCESS","code"=>200),200);
            }else{
                $this->response(array("message"=>"update","code"=>404),200);
            }
        }else{
            return $this->response->redirect();
            exit();
        }
    }
    public function updateUserImageAction(){
        $request = $this->request;
        $auth = $this->auth();
        if($request->isAjax() && $request->isPost() && $auth){
            $uid = $request->getPost("uid");
            $user = new CdUser();
            $find = $user->findFirst($uid);
            $image_actual = $find->getPhoto();
            if($image_actual==$request->getPost("photo")){
                $this->response(array("message"=>"warning","code"=>303),200);
            }else{
                $find->setPhoto($request->getPost("photo"));
                if($find->update()){
                    $_SESSION['auth']['photo'] = $request->getPost("photo");
                    $this->response(array("message"=>"SUCCESS","code"=>200),200);
                }else{
                    $this->response(array("message"=>"error","code"=>404),200);
                }
            }
        }else{
            return $this->response->redirect();
            exit();
        }
    }
    public function uploadImageAction(){
        $request = $this->request;
        $auth = $this->auth();
        if($request->isPost() && $request->isAjax() && $auth){
            if($request->hasFiles()==true){
                foreach($request->getUploadedFiles() as $file){
                    $image_replace = preg_replace('/[^A-Za-z0-9áéíóúÁÉÍÓÚñÑ\_\.!¡¿?]/', '',$file->getName());
                    $new_image = uniqid()."_".$image_replace;
                    if($file->moveTo(dirname(dirname(dirname(dirname(__DIR__))))."/public/dash/assets/images/users/".$new_image)){
                        $image_transform = \WideImage::load(dirname(dirname(dirname(dirname(__DIR__))))."/public/dash/assets/images/users/".$new_image);
                        $newImageThumbnail = $image_transform->resize(null,200);
                        $newImageThumbnail->saveToFile(dirname(dirname(dirname(dirname(__DIR__))))."/public/dash/assets/images/users/thumbnail/".$new_image);
                        $this->response(array("name"=>$new_image,"message"=>"SUCCESS","code"=>"200"),200);
                    }
                    else{
                        $this->response(array("name"=>$new_image,"message"=>"error try again","code"=>"404"),200);
                    }
                }
            }
        }else{
            exit();
        }
    }
    public function validateEmailAction(){
        $request = $this->request;
        if($request->isPost() && $request->isAjax()){
            $email = $this->request->getPost("email");
            $user = new CdUser();
            $find  = $user->findFirst("email='$email'");
            if($find==null){
                $this->response(array('valid' => true),200);
            }
            elseif($find!=null){
                $this->response(array('valid' => false),200);
            }
            else{
                $this->response(array("message"=>"error try again","code"=>"404"),404);
            }
        }
    }
    public function validateUsernameAction(){
        $request = $this->request;
        if($request->isPost() && $request->isAjax()){
            $username = str_replace(" ","-",$request->getPost("username"));
            $user = new CdUser();
            $find  = $user->findFirst("username='$username'");
            if($find==null){
                $this->response(array('valid' => true),200);
            }
            elseif($find!=null){
                $this->response(array('valid' => false),200);
            }
            else{
                $this->response(array("message"=>"error try again","code"=>"404"),404);
            }
        }
    }
    public function _registerSession($user){
        $this->session->set("auth",array(
                "uid" => $user->getUid(),
                "username"=>$user->getUsername(),
                "rol"=>$user->getRol(),
                "name"=>$user->getName(),
                "user_photo"=>$user->getUserPhoto(),
                "register"=>$user->getRegister(),
                "email"=>$user->getEmail()
            )
        );
    }

}
