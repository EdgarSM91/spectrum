<?php
namespace Modules\Dashboard\Controllers;
include dirname(dirname(dirname(dirname(__FILE__))))."/library/wideimage/WideImage.php";
use Modules\Models\CdImages;
use Modules\Models\CdPhotoNote;
use Modules\Models\Galleryphotonote;
use Modules\Models\ImagesHasPhotoNote;
use Modules\Models\Vphotonote;

class PhotoController extends ControllerBase{
    public function indexAction(){
        $auth = $this->auth();
        if($auth){
            $uid = $auth['uid'];
            $allPhotoNotes = new Vphotonote();
            $ncgid = $auth['ncgid'];
            if($auth['rol']=="ADMIN" && $ncgid=="All"){
                $this->view->setVar("allPhotoNotes",$allPhotoNotes->find("status='PUBLIC' group by permalink"));
            }elseif($auth['rol']=="ADMIN"){
                $cgid = $auth['cgid'];
                $this->view->setVar("allnotes",$allPhotoNotes->find("status='PUBLIC' and cgid=$cgid group by permalink"));
            }else{
                $this->view->setVar("allPhotoNotes",$allPhotoNotes->find("status='PUBLIC' and uid=$uid group by permalink"));
            }
        }else{
            exit();
        }
    }
    public function draftAction(){
        $auth = $this->auth();
        if($auth){
            $uid = $auth['uid'];
            $allPhotoNotes = new Vphotonote();
            $ncgid = $auth['ncgid'];
            if($auth['rol']=="ADMIN" && $ncgid=="All"){
                $this->view->setVar("allPhotoNotes",$allPhotoNotes->find("status='ERASER' group by permalink"));
            }elseif($auth['rol']=="ADMIN"){
                $cgid = $auth['cgid'];
                $this->view->setVar("allnotes",$allPhotoNotes->find("status='ERASER' and cgid=$cgid group by permalink"));
            }else{
                $this->view->setVar("allPhotoNotes",$allPhotoNotes->find("status='ERASER' and uid=$uid group by permalink"));
            }
        }else{
            exit();
        }
    }
    public function newAction(){
        $this->assets->collection('jsPhotoNotes')->addJs("dash/js/custom_photos.js");
        $auth = $this->auth();
        if($auth){
            $this->view->setVar("category",json_decode($this->getCategory(),true));
            $this->view->setVar("auth",$auth);
        }else{
            exit();
        }
    }
    public function editAction(){
        $request = $this->request;
        $auth = $this->auth();
        $pnid = $request->get("pnid");
        $cdPN = CdPhotoNote::findFirst($pnid);
        if($auth && $cdPN){
            $this->assets->collection('jsPhotoNotes')->addJs("dash/js/custom_photos.js");
            $galleryPN = Galleryphotonote::find("pnid=$pnid");
            $this->view->setVar("category",json_decode($this->getCategory(),true));
            $this->view->setVar("categoryVal",$cdPN->getCgid());
            $this->view->setVar("auth",$auth);
            $this->view->setVar("pn",$cdPN);
            $this->view->setVar("gpn",$galleryPN);
        }else{
            $this->response->redirect("dashboard/photo");
        }
    }
    public function saveAction(){
        $auth = $this->auth();
        $request = $this->request;
        if($request->isPost() && $request->isAjax() && $auth && $this->security->checkToken($this->request->getPost('value'),$this->request->getPost('key'))){
            $pnid = $request->getPost("pnid");
            $note = new CdPhotoNote();
            $token = $this->token();
            if($pnid){
                $find  = $note->findFirst($pnid);
                $find->setTitle(str_replace('\'', '"',$request->getPost("title")))
                    ->setImage($request->getPost("image"))
                    ->setPermalink($request->getPost("permalink"))
                    ->setContent($request->getPost("content"))
                    ->setStatus($request->getPost('status'))
                    ->setTypePn($request->getPost('type_pn'))
                    ->setCgid($request->getPost('category'))
                    ->setDateUpdate(date('Y-m-d H:i:s'))
                    ->setUid($auth['uid']);
                if($find->update()){
                    $this->PhotoNoteJson();
                    $this->MemesIndexJson();
                    $this->response(array("token"=>array("value"=>$token['value'],"key"=>$token['key']),"message"=>"SUCCESS","code"=>200,"pnid"=>$find->getPnid(),"active"=>1),200);
                }else{
                    $this->response(array("message"=>"error try again","code"=>404),200);
                }
            }else{
                $note->setTitle(str_replace('\'', '"',$request->getPost("title")))
                    ->setImage($request->getPost("image"))
                    ->setPermalink($request->getPost("permalink"))
                    ->setContent($request->getPost("content"))
                    ->setStatus($request->getPost('status'))
                    ->setVisits(0)
                    ->setDateCreation(date('Y-m-d H:i:s'))
                    ->setDateUpdate(date('Y-m-d H:i:s'))
                    ->setTypePn($request->getPost('type_pn'))
                    ->setCgid($request->getPost('category'))
                    ->setUid($auth['uid']);
                if($note->save()){
                    $this->PhotoNoteJson();
                    $this->MemesIndexJson();
                    $this->response(array("token"=>array("value"=>$token['value'],"key"=>$token['key']),"message"=>"SUCCESS","code"=>200,"pnid"=>$note->getPnid(),"active"=>2),200);
                }else{
                    $result = array();
                    foreach ($note->getMessages() as $key => $message) {
                        $result[$key]= $this->flash->error((string) $message);
                    }
                    $this->response(array("message"=>"$result","code"=>404),200);
                }
            }
        }else{
            $this->response(array("message"=>"SUCCESS","code"=>200),200);
        }
    }
    public function saveMultipleImagesAction()
    {
        $request = $this->request;
        $auth = $this->auth();
            if($request->isPost() && $request->isAjax() && $request->hasFiles() && $auth){
            $photo = new CdImages();
            foreach($request->getUploadedFiles() as $file){
                $image_replace = str_replace(" ","_",$file->getName());
                $name_image = uniqid()."_".$image_replace;
                $pnid= $request->getPost("pnid");
                $original_name = $file->getName();

                //add values table ddt_image
                $photo->setOriginalName($original_name)
                    ->setName($name_image)
                    ->setSize($file->getSize())
                    ->setType($file->getRealType())
                    ->setDateCreation(date('Y-m-d H:i:s'))
                    ->setUid($auth['uid']);
                if($photo->save()){
                    $this->PhotoNoteJson();
                    $last_imgid = $photo->getImgid();
                    if($photo->setImagesNotes($last_imgid,$pnid)){
                        if($file->moveTo($this->public."dash/img/photo_notes/".$name_image)){
                            $image_transform = \WideImage::load($this->public."dash/img/photo_notes/".$name_image);
                            $newImageThumbnail = $image_transform->resize(800,450)->crop(0,0,800,450);
                            $newImageThumbnail->saveToFile($this->public."dash/img/photo_notes/800x450/".$name_image);
                            $newImageThumbnail2 = $image_transform->resize(256,144)->crop(0,0,256,144);
                            $newImageThumbnail2->saveToFile($this->public."dash/img/photo_notes/256x144/".$name_image);
                            $newImageThumbnail3 = $image_transform->resize(512,288)->crop(0,0,512,288);
                            $newImageThumbnail3->saveToFile($this->public."dash/img/photo_notes/512x288/".$name_image);
                            $newImageThumbnail4 = $image_transform->resize(null,75)->crop(0,0,100,75);
                            $newImageThumbnail4->saveToFile($this->public."dash/img/photo_notes/100x75/".$name_image);
                            $this->response(array("original_name"=>$original_name,"name"=>$name_image,"message"=>"SUCCESS","code"=>"200","photo_id"=>$last_imgid),200);
                        }
                    }
                    else{
                        $this->response(array("name"=>$name_image,"message"=>"error try again","code"=>"404"),200);
                    }
                }
                else{
                    $this->response(array("name"=>$name_image,"message"=>"error try again","code"=>"404"),200);
                }
            }
        }
    }
    public function saveDescriptionAction(){
        $auth = $this->auth();
        $request = $this->request;
        if($request->isPost() && $request->isAjax() && $auth && $this->security->checkToken($this->request->getPost('value'),$this->request->getPost('key'))){
            $imgid = $request->getPost("id");
            $description   = $request->getPost("description");
            $photo = CdImages::findFirst($imgid);
            $photo->setDescription($description)->setDateUpdate(date('Y-m-d H:i:s'));
            if($photo->update()){
                $this->PhotoNoteJson();
                $token =$this->token();
                $this->response(array("token"=>array("value"=>$token['value'],"key"=>$token['key']),"message"=>"SUCCESS","code"=>200),200);
            }else{
                $result = array();
                foreach ($photo->getMessages() as $key => $message) {
                    $result[$key]= $this->flash->error((string) $message);
                }
                $this->response(array("message"=>"$result","code"=>404),200);             }
        }else{
            $this->response(array("message"=>"error","code"=>404),404);
        }
    }
    public function orderImageAction(){
        $auth = $this->auth();
        $request = $this->request;
        if($request->isPost() && $request->isAjax() && $auth ){
            $imgid = explode("|",$request->getPost("imgid"));
            $pnid = $request->getPost("pnid");
            $order = $request->getPost("order");
            $photo = new ImagesHasPhotoNote();
            if($photo->setOrderImages($imgid[1],$pnid,$order)){
                $this->PhotoNoteJson();
                $this->response(array("message"=>"SUCCESS","code"=>200),200);
            }else{
                $result = array();
                foreach ($photo->getMessages() as $key => $message) {
                    $result[$key]= $this->flash->error((string) $message);
                }
                $this->response(array("message"=>"$result","code"=>404),200);             }
        }else{
            $this->response(array("message"=>"error","code"=>404),404);
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
                    if($file->moveTo($this->public."dash/img/photo_notes/".$new_image)){
                        $image_transform = \WideImage::load($this->public."dash/img/photo_notes/".$new_image);
                        $newImageThumbnail = $image_transform->resize(800,450)->crop(0,0,800,450);
                        $newImageThumbnail->saveToFile($this->public."dash/img/photo_notes/800x450/".$new_image);
                        $newImageThumbnail2 = $image_transform->resize(256,144)->crop(0,0,256,144);
                        $newImageThumbnail2->saveToFile($this->public."dash/img/photo_notes/256x144/".$new_image);
                        $newImageThumbnail3 = $image_transform->resize(512,288)->crop(0,0,512,288);
                        $newImageThumbnail3->saveToFile($this->public."dash/img/photo_notes/512x288/".$new_image);
                        $newImageThumbnail4 = $image_transform->resize(null,75)->crop(0,0,100,75);
                        $newImageThumbnail4->saveToFile($this->public."dash/img/photo_notes/100x75/".$new_image);
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
    public function validateUrlAction(){
        $request = $this->request;
        $auth = $this->auth();
        if($request->isPost() && $request->isAjax() && $auth && $this->security->checkToken($this->request->getPost('value'),$this->request->getPost('key'))){
            $post = new CdPhotoNote();
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
            $this->response(array("token"=>array("value"=>$token['value'],"key"=>$token['key']),"message"=>"SUCCESS","new_url"=>$new_url,"code"=>"200","data"=>"url generated"),200);
        }else{
            $this->response(array("message"=>"error"),404);
        }
    }
    public function deleteImageAction(){
        $request = $this->request;
        $auth = $this->auth();
        if($request->isPost() && $request->isAjax() && $auth){
            $imgid = $request->getPost("imgid");
            $name_image = $request->getPost("name_image");
            $image_has_photo = ImagesHasPhotoNote::findFirst("imgid=$imgid");
            if($image_has_photo->delete()){
                $image = CdImages::findFirst("imgid=$imgid");
                if ($image->delete()){
                    $this->PhotoNoteJson();
                    unlink($this->public."dash/img/photo_notes/".$name_image);
                    unlink($this->public."dash/img/photo_notes/800x450/".$name_image);
                    unlink($this->public."dash/img/photo_notes/256x144/".$name_image);
                    unlink($this->public."dash/img/photo_notes/512x288/".$name_image);
                    unlink($this->public."dash/img/photo_notes/100x75/".$name_image);
                    $this->response(array("id"=>$name_image."|".$imgid,"message"=>"SUCCESS","code"=>"200"),200);
                }else{
                    $this->response(array("message"=>"error try again cd_images"),200);
                }
            }else{
                $this->response(array("message"=>"error try again image_has_photo_note"),200);
            }
        }else{
            $this->response(array("message"=>"error"),404);
        }
    }
    protected function MemesIndexJson(){
        $json = $this->public."json/memes.json";
        $file = fopen($json,"wb");
        $subCategory = new CdPhotoNote();
        $find = $subCategory->find("status='PUBLIC' order by date_creation desc limit 1,4");
        $content = array();
        foreach($find as $key => $values){
            $content[$key+1]=array(
                "pnid"=>$values->getPnid(),
                "title"=>$values->getTitle(),
                "image"=>$values->getImage(),
                "permalink"=>$values->getPermalink(),
                "content"=>$values->getContent(),
            );
        }
        $subCategory_json = json_encode($content);
        fwrite($file,$subCategory_json);
        fclose($file);
        return true;
    }
}