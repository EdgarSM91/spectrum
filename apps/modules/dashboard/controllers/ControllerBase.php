<?php
namespace Modules\Dashboard\Controllers;

use Modules\Models\CdCategory;
use Modules\Models\CdSubcategory;
use Modules\Models\Vphotonote;
use Modules\Models\Vsectionnotes;
use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
    public function initialize(){
        $this->assets->collection('JsIndex')
            ->setTargetPath("dash/js/general.min.js")
            ->setTargetUri("dash/js/general.min.js")
            ->addJs("dash/js/plugins/jquery/jquery.min.js")
            ->addJs("dash/js/plugins/jquery/jquery-ui.min.js")
            ->addJs("dash/js/plugins/bootstrap/bootstrap.min.js")
            ->addJs("dash/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js")
            ->addJs("dash/js/plugins/dropzone/dropzone.min.js")
            ->addJs("dash/js/plugins/scrolltotop/scrolltopcontrol.js")
            ->addJs("dash/js/plugins/moment.min.js")
            /*->addJs("dash/js/plugins/BootstrapDP/bootstrap-datepicker.min.js")
            ->addJs("dash/js/plugins/BootstrapDP/bootstrap-datepicker.es.min.js")*/
            ->addJs("dash/js/plugins/bootstrapV/formValidation.min.js")
            ->addJs("dash/js/plugins/bootstrapV/bootstrapV.min.js")
            ->addJs("dash/js/ckeditor.js")
            ->addJs("dash/ckeditor/adapters/jquery.js")
            ->addJs("dash/js/plugins/datatables/jquery.dataTables.min.js")
            ->addJs("dash/js/plugins/select/select2.min.js")
            ->addJs("dash/js/jquery.tablednd.js")
            ->addJs("dash/js/plugins/select/es.js")
            ->addJs("dash/js/custom.js")
            ->addJs("dash/js/custom.upload.files.js")
            ->addJs("dash/js/spectrum.js")
            ->join(true)
            ->addFilter(new \Phalcon\Assets\Filters\Jsmin());

        $this->assets->collection('CssIndex')
            ->setTargetPath("dash/css/general.min.css")
            ->setTargetUri("dash/css/general.min.css")
            ->addCss("dash/css/jquery/jquery-ui.min.css")
            ->addCss("dash/css/nvd3/nv.d3.css")
            ->addCss("dash/css/mcustomscrollbar/jquery.mCustomScrollbar.css")
            ->addCss("dash/css/rickshaw/rickshaw.css")
            ->addCss("dash/css/dropzone/dropzone.css")
            ->addCss("dash/css/animate/animate.min.css")
            ->addCss("dash/css/bootstrapV/formValidation.min.css")
            ->addCss("dash/css/BDP/bootstrap-datepicker3.css")
            ->addCss("dash/css/select/select2.min.css")
            ->addCss("dash/css/select/select2-bootstrap.css")
            ->addCss("dash/css/custom.css")
            ->join(true)
            ->addFilter(new \Phalcon\Assets\Filters\Cssmin());

        $this->view->setLayout("index");
    }
    public function auth(){
        return $this->session->get("auth");
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
        exit();
    }
    public function getCategory(){
        $json = dirname(dirname(dirname(dirname(__DIR__))))."/public/json/category.json";
        $get_file = file_get_contents($json);
        if(!file_exists($json) || empty($get_file)){
            $file = fopen($json,"wb");
            $category = new CdCategory();
            $find = $category->find();
            $content = array();
            foreach($find as  $values){
                $content[$values->getCgid()]=$values->getNameCategory();
            }
            $category_json = json_encode($content);
            fwrite($file,$category_json);
            fclose($file);
            return $category_json;
        }else{
            return $get_file;
        }
    }
    public function getSubCategory(){
        $json = dirname(dirname(dirname(dirname(__DIR__))))."/public/json/subCategory.json";
        $get_file = file_get_contents($json);
        if(!file_exists($json) || empty($get_file)){
            $file = fopen($json,"wb");
            $subCategory = new CdSubcategory();
            $find = $subCategory->find();
            $content = array();
            foreach($find as $values){
                $content[$values->getScid()][$values->getCgid()]=$values->getSubcategoryname();
            }
            $subCategory_json = json_encode($content);
            fwrite($file,$subCategory_json);
            fclose($file);
            return $subCategory_json;
        }else{
            return $get_file;
        }
    }
    protected function NotesHeaderJson(){
        $json = dirname(dirname(dirname(dirname(__DIR__))))."/public/json/notes.json";
        $file = fopen($json,"wb");
        $subCategory = new Vsectionnotes();
        $find = $subCategory->getAllNotesHeader();
        $content = array();
        foreach($find as $key => $values){
            $content[$key+1]=array(
                "pid"=>$values->getPid(),
                "title"=>$values->getTitle(),
                "image"=>$values->getImage(),
                "permalink"=>$values->getPermalink(),
                "permalink"=>$values->getPermalink(),
                "subcategoryname"=>$values->getSubcategoryname(),
                "name_category"=>$values->getNameCategory(),
            );
        }
        $subCategory_json = json_encode($content);
        fwrite($file,$subCategory_json);
        fclose($file);
        return true;
    }
    protected function PhotoNoteJson(){
        $json = dirname(dirname(dirname(dirname(__DIR__))))."/public/json/photo_note.json";
        $file = fopen($json,"wb");
        $subCategory = new Vphotonote();
        $find = $subCategory->find("status='PUBLIC' limit 3");
        $content = array();
        foreach($find as $key => $values){
            if($key==0){
                $content=array(
                    "pnid"=>$values->getPnid(),
                    "title"=>$values->getTitle(),
                    "image"=>$values->getImage(),
                    "permalink"=>$values->getPermalink(),
                    "content"=>$values->getContent(),
                    "images"=>""
                );
                $array[$key+1]=array('name'=>$values->getName(),'description'=>$values->getDescription());
            }else{
                $array[$key+1]=array('name'=>$values->getName(),'description'=>$values->getDescription());
            }
        }
        $content["images"] = $array;
        $subCategory_json = json_encode($content);
        fwrite($file,$subCategory_json);
        fclose($file);
        return true;
    }
    protected function url_clean($string) {
        $string = mb_strtolower(str_replace(' ', '-',str_replace('-','',$string)), 'UTF-8');
        $utf8 = array(
            '/[áàâãªä]/u'   =>   'a',
            '/[ÁÀÂÃÄ]/u'    =>   'A',
            '/[ÍÌÎÏ]/u'     =>   'I',
            '/[íìîï]/u'     =>   'i',
            '/[éèêë]/u'     =>   'e',
            '/[ÉÈÊË]/u'     =>   'E',
            '/[óòôõºö]/u'   =>   'o',
            '/[ÓÒÔÕÖ]/u'    =>   'O',
            '/[úùûü]/u'     =>   'u',
            '/[ÚÙÛÜ]/u'     =>   'U',
            '/ç/'           =>   'c',
            '/Ç/'           =>   'C',
            '/ñ/'           =>   'n',
            '/Ñ/'           =>   'N',
            '/–/'           =>   '-',
            '/:/'           =>   '-', // UTF-8 hyphen to "normal" hyphen
            '/!/'           =>   '', // UTF-8 hyphen to "normal" hyphen
            '/¡/'           =>   '', // UTF-8 hyphen to "normal" hyphen
            '/@/'           =>   '', // UTF-8 hyphen to "normal" hyphen
            '/,/'           =>   '', // UTF-8 hyphen to "normal" hyphen
            '/[’‘‹›‚¿?]/u'    => '', // Literally a single quote
            '/[“”«»„""]/u'    => '', // Double quote
            '/ /'           =>   '', // nonbreaking space (equiv. to 0x160)
        );
        $string = preg_replace('/[^A-Za-z0-9áéíóúÁÉÍÓÚñÑ\-!¡¿?@]/', '', $string); // Removes special chars.
        return preg_replace(array_keys($utf8),array_values($utf8),$string); // Removes special chars.
        //'/[^A-Za-z0-9áéíóúÁÉÍÓÚñÑ\-!¡¿?@]/', '',
    }
    function getCategoriesSections(){
        $auth = $this->auth();
        if($auth){
                $categories = new CdCategory();
                $ctg = array();
                foreach($categories->find() as $key => $values){
                    $ctg[$values->getCgid()] = $values->getNameCategory();
                }
        }else{
            exit();
        }
    }
    protected function token(){
        return $token = array("key"=>$this->security->getToken(),"value"=>$this->security->getTokenKey());
    }
    protected function expressions(){
        return $utf8 = array(
            '/[áàâãªä]/u'   =>   'a',
            '/[ÁÀÂÃÄ]/u'    =>   'A',
            '/[ÍÌÎÏ]/u'     =>   'I',
            '/[íìîï]/u'     =>   'i',
            '/[éèêë]/u'     =>   'e',
            '/[ÉÈÊË]/u'     =>   'E',
            '/[óòôõºö]/u'   =>   'o',
            '/[ÓÒÔÕÖ]/u'    =>   'O',
            '/[úùûü]/u'     =>   'u',
            '/[ÚÙÛÜ]/u'     =>   'U',
            '/ç/'           =>   'c',
            '/Ç/'           =>   'C',
            '/ñ/'           =>   'n',
            '/Ñ/'           =>   'N',
            '/–/'           =>   '-',
            '/:/'           =>   '-', // UTF-8 hyphen to "normal" hyphen
            '/!/'           =>   '', // UTF-8 hyphen to "normal" hyphen
            '/¡/'           =>   '', // UTF-8 hyphen to "normal" hyphen
            '/@/'           =>   '', // UTF-8 hyphen to "normal" hyphen
            '/,/'           =>   '', // UTF-8 hyphen to "normal" hyphen
            '/[’‘‹›‚¿?]/u'    => '', // Literally a single quote
            '/[“”«»„""]/u'    => '', // Double quote
            '/ /'           =>   '', // nonbreaking space (equiv. to 0x160)
        );
    }
}
