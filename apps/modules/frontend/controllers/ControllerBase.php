<?php
namespace Modules\Frontend\Controllers;
use Phalcon\Mvc\Controller;
class ControllerBase extends Controller
{
    public function initialize()
    {
        $this->assets->collection('Angular')
            ->setTargetPath("front/src/js/angular.min.js")
            ->setTargetUri("front/src/js/angular.min.js")
            ->addJs("front/src/js/jquery-2.1.3.min.js")
            ->addJs("default/js/angular/angular.min.js")
            ->addJs("front/src/js/loading/loading-bar.js")
            ->addJs("default/js/angular/angular-route.min.js")
            ->addJs("default/js/angular/angular-animate.min.js")
            ->addJs("default/js/angular/ui-bootstrap-tpls-0.13.0.js")
            ->addJs("front/src/js/map/ng-map.min.js")
            ->addJs("front/src/js/count/angular-count-to.js")
            ->addJs("front/app.js")
            ->addJs("front/controllers/IndexController.js")
            ->addJs("front/controllers/ContactController.js")
            ->addJs("front/services/token.js")
            ->join(true)
            ->addFilter(new \Phalcon\Assets\Filters\Jsmin());

        $this->assets->collection('IndexJs')
            ->setTargetPath("front/src/js/general.min.js")
            ->setTargetUri("front/src/js/general.min.js")
            ->addJs("front/src/vendors/owl.carousel/js/owl.carousel.min.js")
/*            ->addJs("front/src/vendors/flexslider/jquery.flexslider-min.js")*/
            ->addJs("front/src/vendors/rs-plugin/js/jquery.themepunch.tools.min.js")
            ->addJs("front/src/vendors/rs-plugin/js/jquery.themepunch.revolution.min.js")
            ->join(true)
            ->addFilter(new \Phalcon\Assets\Filters\Jsmin());

        $this->assets->collection('IndexCss')
            ->setTargetPath("front/src/css/general.min.css")
            ->setTargetUri("front/src/css/general.min.css")
            ->addJs("front/src/css/font-awesome.min.css")
            ->addCss("default/css/bootstrap.min.css")
            ->addJs("front/src/css/style.css")
            ->addJs("front/src/css/loading/loading-bar.css")
            ->addJs("front/src/css/bootstrap-theme.min.css")
            ->addJs("front/src/vendors/owl.carousel/css/owl.carousel.min.css")
            ->addJs("front/src/vendors/owl.carousel/css/owl.theme.default.min.css")
            /*->addJs("front/src/vendors/flexslider/flexslider.css")*/
            ->addJs("front/src/vendors/rs-plugin/css/settings.css")
            ->addJs("front/src/vendors/rs-plugin/css/settings-ie8.css")
            ->addJs("front/src/css/responsive.css")
            ->addJs("front/src/css/custom.css")
            ->join(true)
            ->addFilter(new \Phalcon\Assets\Filters\Cssmin());
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
    public function metaHome($action,$canonical,$image,$description){
        $this->session->set("meta",
            array(
                "title"=>"$action",
                "url"=>$this->url->getBaseUri()."$canonical",
                "image"=>$this->url->getBaseUri()."dash/img/notes/800x600/$image",
                "description"=>"$description"
            )
        );
        /*{{ router.getRewriteUri() }}*/
    }
    public function header($action){
        $ct = array("futbol"=>"F","basquetbol"=>"B","beisbol"=>"BE","box"=>"BX","otros"=>"O","contactanos"=>"C","index"=>"I","acerca"=>"AC");
        $this->session->set("header",
            array(
                "$ct[$action]"=>"current-menu-ancestor",
            )
        );
    }
    public function cleaCategory($string){
        return  mb_strtolower(str_replace(' ', '-',str_replace('-','',$string)), 'UTF-8');
    }
    public function dateSpanish(){
        return array(
            "01"=>"Enero",
            "02"=>"Febrero",
            "03"=>"Marzo",
            "04"=>"Abril",
            "05"=>"Mayo",
            "06"=>"Junio",
            "07"=>"Julio",
            "08"=>"Agosto",
            "09"=>"Septiembre",
            "10"=>"Octubre",
            "11"=>"Noviembre",
            "12"=>"Diciembre"
        );
    }
    protected function token(){
        return $token = array("key"=>$this->security->getToken(),"value"=>$this->security->getTokenKey());
    }
}