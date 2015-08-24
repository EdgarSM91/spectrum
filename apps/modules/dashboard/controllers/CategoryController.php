<?php
namespace Modules\Dashboard\Controllers;
use Modules\Models\CdCategory;

class CategoryController extends ControllerBase{
    public function indexAction(){
        $category = new CdCategory();
        $this->view->setVar("categories",$category->find());
    }
    public function newAction(){
        $auth = $this->auth();
        $request = $this->request;
        if($request->isPost() && $request->isAjax() && $auth && $this->security->checkToken($this->request->getPost('value'),$this->request->getPost('key'))){
            $name_category = $request->getPost("name_category");
            $category = new CdCategory();
            $category->setName(ucfirst($name_category))->setDateCreation(date('Y-m-d'));
            if($category->save()){
                $this->categoryJson();
                $token = $this->token();
                $result = array("id"=>$category->getCgid(),"name"=>$category->getName());
                $this->response(array("token"=>array("value"=>$token['value'],"key"=>$token['key']),"message"=>"SUCCESS","code"=>200,"result"=>$result),200);
            }else{
                $this->response(array("message"=>"error try again","code"=>"404"),200);
            }
        }else{exit();}
    }
    public function editAction(){
        $auth = $this->auth();
        $request = $this->request;
        if($request->isPost() && $request->isAjax() && $auth && $this->security->checkToken($this->request->getPost('value'),$this->request->getPost('key'))){
            $name_category = $request->getPost("name_category");
            $id = $request->getPost("id");
            $category = CdCategory::findFirst($id);
            $category->setName(ucfirst($name_category));
            if($category->update()){
                $this->categoryJson();
                $result = array("id"=>$category->getCgid(),"name"=>$category->getName());
                $token = $this->token();
                $this->response(array("token"=>array("value"=>$token['value'],"key"=>$token['key']),"message"=>"SUCCESS","code"=>200,"result"=>$result),200);
            }else{
                $this->response(array("message"=>"error try again","code"=>"404"),200);
            }
        }else{exit();}
    }
    public function deleteAction(){
        $auth = $this->auth();
        $request = $this->request;
        if($request->isPost() && $request->isAjax() && $auth && $this->security->checkToken($this->request->getPost('value'),$this->request->getPost('key'))){
            $id = $request->getPost("id");
            $category = CdCategory::findFirst($id);
            if($category->delete()){
                $this->categoryJson();
                $token = $this->token();
                $this->response(array("token"=>array("value"=>$token['value'],"key"=>$token['key']),"message"=>"SUCCESS","code"=>200),200);
            }else{
                $this->response(array("message"=>"Error","code"=>404),200);
            }
        }else{
            $this->response(array("message"=>"Error","code"=>404),200);
        }
    }
    public function validateCategoryAction(){
        $request = $this->request;
        if($request->isPost() && $request->isAjax()){
            $name_category = $this->request->getPost("name_category");
            $category = CdCategory::findFirst("name='$name_category'");
            if($category==null){
                $this->response(array('valid' => true),200);
            }
            elseif($category!=null){
                $this->response(array('valid' => false),200);
            }
            else{
                $this->response(array("message"=>"error try again","code"=>"404"),404);
            }
        }
    }
    private function categoryJson(){
        $json = dirname(dirname(dirname(dirname(__DIR__))))."/public/json/category.json";
        $file = fopen($json,"wb");
        $category = new CdCategory();
        $find = $category->find();
        $content = array();
        foreach($find as  $values){
            $content[$values->getCgid()]=$values->getName();
        }
        $category_json = json_encode($content);
        fwrite($file,$category_json);
        fclose($file);
    }
}