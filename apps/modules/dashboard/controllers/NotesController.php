<?php
namespace Modules\Dashboard\Controllers;
include dirname(dirname(dirname(dirname(__FILE__))))."/library/wideimage/WideImage.php";
require dirname(dirname(dirname(dirname(__FILE__))))."/library/PHPMailer/PHPMailerAutoload.php";
use Modules\Models\Allnotes;
use Modules\Models\CdGalleryTags;
use Modules\Models\CdPost;
use Modules\Models\CdSettingsPost;
use Modules\Models\CdSubcategory;
use Modules\Models\CdTags;
use Phalcon\Http\Request;

class NotesController extends ControllerBase{
    public function indexAction(){
        $auth = $this->auth();
        if($auth){
            $uid = $auth['uid'];
            $allNotes = new Allnotes();
            $ncgid = $auth['ncgid'];
            if($auth['rol']=="ADMIN" && $ncgid=="All"){
                $this->view->setVar("allnotes",$allNotes->find("status='PUBLIC'"));
            }elseif($auth['rol']=="ADMIN"){
                $cgid = $auth['cgid'];
                $this->view->setVar("allnotes",$allNotes->find("status='PUBLIC' and cgid=$cgid"));
            }
            else{
                $this->view->setVar("allnotes",$allNotes->find("status='PUBLIC' and uid=$uid"));
            }
        }else{
            exit();
        }
    }
    public function draftAction(){
        $auth = $this->auth();
        if($auth){
            $uid = $auth['uid'];
            $allNotes = new Allnotes();
            $ncgid = $auth['ncgid'];
            if($auth['rol']=="ADMIN" && $ncgid=="All"){
                $this->view->setVar("allnotes",$allNotes->find("status='ERASER'"));
            }elseif($auth['rol']=="ADMIN"){
                $cgid = $auth['cgid'];
                $this->view->setVar("allnotes",$allNotes->find("status='ERASER' and cgid=$cgid"));
            }
            else{
                $this->view->setVar("allnotes",$allNotes->find("status='ERASER' and uid=$uid"));
            }
        }else{
            exit();
        }
    }
    public function visitsAction(){
        $auth = $this->auth();
        if($auth){
            $uid = $auth['uid'];
            $allNotes = new Allnotes();
            $ncgid = $auth['ncgid'];
            if($auth['rol']=="ADMIN" && $ncgid=="All"){
                $this->view->setVar("notes",$allNotes->find("status='PUBLIC' order by visits desc"));
            }elseif($auth['rol']=="ADMIN"){
                $cgid = $auth['cgid'];
                $this->view->setVar("notes",$allNotes->find("status='PUBLIC' and cgid=$cgid order by visits desc"));
            }
            else{
                $this->view->setVar("notes",$allNotes->find("status='PUBLIC' and uid=$uid order by visits desc"));
            }
        }else{
            exit();
        }
    }
    public function newNoteAction(){
        $auth = $this->auth();
        if($auth){
            $cgid = $auth['cgid'];
            $this->view->setVar("category",json_decode($this->getCategory(),true));
            $this->view->setVar("tags",$auth['ncgid']=="All"?CdTags::find():CdTags::find("cgid=$cgid"));
            $this->view->setVar("auth",$auth);
        }else{
            exit();
        }
    }
    public function editNoteAction(){
        $auth = $this->auth();
        $pid = $this->request->get("pid");
        $notes = new CdPost();
        if($auth && $pid && $notes->findFirst($pid)){
            $find = $notes->findFirst($pid);
            $subCategory = json_decode($this->getSubCategory(),true);
            foreach($subCategory as $key => $val){
                if($key==$find->getScid()){
                    $cat = $subCategory[$key];
                }
            }
            $tagsPost = array();
            foreach(CdGalleryTags::find("pid=$pid") as $key => $val){
                $tagsPost[$key+1]=$val->getTid();
            }
            $cgid = $auth['cgid'];
            $this->view->setVar("categoryVal",key($cat));
            $this->view->setVar("category",json_decode($this->getCategory(),true));
            $this->view->setVar("subcategory",$subCategory);
            $this->view->setVar("note",$find);
            $this->view->setVar("auth",$auth);
            $this->view->setVar("activeTags",$tagsPost);
            $this->view->setVar("tags",$auth['ncgid']=="All"?CdTags::find():CdTags::find("cgid=$cgid"));
        }else{
            return $this->response->redirect("dashboard/notes");
        }
    }
    public function saveNoteAction(){
        $auth = $this->auth();
        $request = new Request();
        if($request->isPost() && $request->isAjax() && $auth && $this->security->checkToken($this->request->getPost('value'),$this->request->getPost('key'))){
             $note = new CdPost();
             $note->setTitle(str_replace('\'', '"',$request->getPost("title")))
                 ->setImage($request->getPost("image"))
                 ->setPermalink($request->getPost("permalink"))
                 ->setSummary($request->getPost("summary"))
                 ->setContent($request->getPost("content"))
                 ->setStatus($request->getPost('status'))
                 ->setDescriptionImage($request->getPost('descriptionI'))
                 ->setVisits(0)
                 ->setDateCreation(date('Y-m-d H:i:s'))
                 ->setDatePublic(date('Y-m-d H:i:s'))
                 ->setIsGallery(0)
                 ->setUid($auth['uid'])
                 ->setType($request->getPost("type"))
                 ->setScid($request->getPost("subcategory"));
             if($note->save()){
                 foreach($request->getPost('tag') as $values){
                     $tag = new CdGalleryTags();
                     $tag->setPid($note->getPid())->setTid($values)->save()     ;
                 }
                 $this->NotesHeaderJson();
                 $token = $this->token();
                 $this->response(array("message"=>"SUCCESS","code"=>200,"value"=>$token['value'],"key"=>$token['key']),200);
             }else{
                 foreach ($note->getMessages() as $message) {
                     $this->flash->error((string) $message);
                 }
                 $this->response(array("message"=>"$message","code"=>404),200);
             }
        }else{
            exit();
        }
    }
    public function updateNoteAction(){
        $auth = $this->auth();
        $request = $this->request;
        if($request->isPost() && $request->isAjax() && $auth && $this->security->checkToken($this->request->getPost('value'),$this->request->getPost('key'))){
             $dateP = $request->getPost("dateP");
             $newDate = explode("/",$dateP);
             $newDate = $newDate["2"]."-".$newDate["1"]."-".$newDate["0"];
             $note = new CdPost();
             $find = $note->findFirst($request->getPost("pid"));
             $find->setTitle(str_replace('\'', '"',$request->getPost("title")))
                 ->setImage($request->getPost("image"))
                 ->setPermalink($request->getPost("permalink"))
                 ->setSummary($request->getPost("summary"))
                 ->setContent($request->getPost("content"))
                 ->setStatus($request->getPost('status'))
                 ->setDescriptionImage($request->getPost('descriptionI'))
                 ->setDateCreation(date('Y-m-d H:i:s'))
                 ->setDatePublic($newDate)
                 ->setIsGallery(0)
                 ->setUid($auth['uid'])
                 ->setType($request->getPost("type"))
                 ->setScid($request->getPost("subcategory"));
             if($find->update()){
                 $pid=$find->getPid();
                 $delete = CdGalleryTags::find("pid=$pid");
                 $delete->delete();
                 foreach($request->getPost('tag') as $values){
                     $tag = new CdGalleryTags();
                     $tag->setPid($pid)->setTid($values)->save();
                 }
                 $this->NotesHeaderJson();
                 $token = $this->token();
                 $this->response(array("message"=>"SUCCESS","code"=>200,"value"=>$token['value'],"key"=>$token['key']),200);
             }else{
                 foreach ($find->getMessages() as $message) {
                     $message = $this->flash->error((string) $message);
                 }
                 $this->response(array("message"=>"$message","code"=>404),200);             }
        }else{
            exit();
        }
    }
    public function uploadImageNoteAction(){
        $request = $this->request;
        $auth = $this->auth();
        if($request->isPost() && $request->isAjax() && $auth){
            if($request->hasFiles()==true){
                foreach($request->getUploadedFiles() as $file){
                    $image_replace = preg_replace('/[^A-Za-z0-9áéíóúÁÉÍÓÚñÑ\_\.!¡¿?]/', '',$file->getName());
                    $new_image = uniqid()."_".$image_replace;
                    if($file->moveTo($this->public."dash/img/notes/".$new_image)){
                        $image_transform = \WideImage::load($this->public."dash/img/notes/".$new_image);
                        $img800= $image_transform->resize(800,450)->crop(0,0,800,450);
                        $img800->saveToFile($this->public."dash/img/notes/800x450/".$new_image);
                        $img512 = $image_transform->resize(512,288)->crop(0,0,512,288);
                        $img512->saveToFile($this->public."dash/img/notes/512x288/".$new_image);
                        $img256 = $image_transform->resize(256,144)->crop(0,0,256,144);
                        $img256->saveToFile($this->public."dash/img/notes/256x144/".$new_image);
                        $img100 = $image_transform->resize(null,75)->crop(0,0,100,75);
                        $img100->saveToFile($this->public."dash/img/notes/100x75/".$new_image);
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
    public function uploadMultipleImagesAction(){
        $request = $this->request;
        $auth = $this->auth();
        if($auth){
            if($request->hasFiles()==true){
                foreach($request->getUploadedFiles() as $file){
                    $image_replace = preg_replace('/[^A-Za-z0-9áéíóúÁÉÍÓÚñÑ\_\.!¡¿?]/', '',$file->getName());
                    $new_image = uniqid()."_".$image_replace;
                    if($file->moveTo($this->public."dash/img/notes/".$new_image)){
                        $image_transform = \WideImage::load($this->public."dash/img/notes/".$new_image);
                        $imgPost = $image_transform->resize(800,null);
                        $imgPost->saveToFile($this->public."dash/img/notes/800x600/".$new_image);
                        $url = $this->url->getBaseUri()."dash/img/notes/800x600/"."$new_image";
                        $funcNum = $_GET['CKEditorFuncNum'] ;
                        echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction('".$funcNum."','".$url."', 'Guardado correctamente');</script>";
                        exit();
                        //$this->response(array("name"=>$new_image,"message"=>"SUCCESS","code"=>"200"),200);
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
    public function categoryAction(){
        $request = $this->request;
        if($this->auth() && $request->isPost() && $request->isAjax()){
            $category_id = $request->getPost("category");
            $subCategory = json_decode($this->getSubCategory(),true);
            $scid = array();
            foreach($subCategory as $key => $value){
                foreach($subCategory[$key] as $k => $newValue){
                    if($k==$category_id){
                        $scid[$key] = $newValue;
                    }
                }
            }
            $this->response(array("message"=>"Success","code"=>"200","result"=>$scid),200);
        }else
        {$this->response(array("message"=>"error","code"=>"200"),200);}
    }
    public function validateUrlAction(){
        $request = $this->request;
        $auth = $this->auth();
        if($request->isPost() && $request->isAjax() && $auth && $this->security->checkToken($this->request->getPost('value'),$this->request->getPost('key'))){
            $post = new CdPost();
            $name_post = $request->getPost("title");
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
            $this->response(array("message"=>"SUCCESS","new_url"=>$new_url,"code"=>"200","data"=>"url generated","value"=>$token['value'],"key"=>$token['key']),200);
        }else{
            $this->response(array("message"=>"error"),200);
        }
    }
}