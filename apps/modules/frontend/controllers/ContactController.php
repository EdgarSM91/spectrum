<?php
namespace Modules\Frontend\Controllers;
require dirname(dirname(dirname(dirname(__FILE__))))."/library/PHPMailer/PHPMailerAutoload.php";
use Phalcon\Http\Request;
class ContactController extends ControllerBase{
    public function indexAction(){ }
    public function contactanosAction(){}
    public function tokenAction(){
        $request = new Request();
        if($request->isGet()){
            $token = $this->token();
            $this->response(array("value"=>$token['value'],"key"=>$token['key']),200);
        }
    }
    public function messageInformationAction(){
        $request = new Request();
        if($request->isPost() && $this->security->checkToken($this->request->getPost('value'),$this->request->getPost('key'))){
            $values = array(
                "name" => $request->getPost('name'),
                "lastname"=> $request->getPost('lastname'),
                "secondname"=> $request->getPost('secondname'),
                "studies"=>$request->getPost('studies'),
                "email"=>$request->getPost('email'),
                "phone"=> $request->getPost('phone'),
                "activity"=>$request->getPost('activity'),
                "subject"=>$request->getPost('subject'),
                "message"=>$request->getPost('message')
            );

            if($this->SendEmailAccount($values)){
                $this->response(array("code"=>200,"message"=>"ok"),200);
            }else{
                $this->response(array("code"=>404,"message"=>"data-error"),200);
            }
        }else{
            $this->response(array("message"=>"Error try again","code"=>"404"),404);
        }
    }
    public function SendEmailAccount($values){
        $email = new \PHPMailer();
        $email->isSMTP();
        //$email->SMTPDebug = 2;
        //$email->Debugoutput = 'html';

        $email->Host = "smtp.gmail.com";
        $email->Port=587;
        $email->CharSet = 'UTF-8';
        $email->SMTPSecure="tls";
        $email->SMTPAuth =true;
        $email->Username = "retosrevista@gmail.com";
        $email->Password = "ariciluper171987";

        $email->setFrom("{$values['email']}","SPECTRUM | Servicios Técnicos de México");
        $email->addReplyTo("retosrevista@gmail.com","SPECTRUM | Servicios Técnicos de México");
        $email->addAddress("team-developers@c-developers.com");

        $email->WordWrap =100;
        $email->isHTML(true);

        $email->Subject = "Mensaje página web SPECTRUM | Servicios Técnicos de México";
        $html = "<!DOCTYPE html><html lang='es-Mx'><head><meta charset='UTF-8'><meta http-equiv='X-UA-Compatible' content='IE=edge'><title>SPECTRUM | Servicios Técnicos de México</title></head><body><style type='text/css'>p,strong {font-family: sans-serif;font-size: 14px;}</style><p><strong>Asunto : </strong>{$values['subject']}</p><p><strong>Nombre : </strong>{$values['name']} {$values['lastname']} {$values['secondname']}</p><p><strong>Email : </strong>{$values['email']}</p><p><strong>Teléfono : </strong>{$values['phone']}</p><p><strong>Actividad : </strong>{$values['activity']}</p><p><strong>Estudios : </strong>{$values['studies']}</p><p><strong>Mensaje : </strong>{$values['message']}</p></body></html>";
        $email->msgHTML($html);
        $email->AltBody = "Contacto Página web";

        if(!$email->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $email->ErrorInfo;
        } else {
            return true;
        }
    }
    public function SendEmail($account,$type){
        $email = new \PHPMailer();
        $email->isSMTP();
//        $email->Timeout       =   120;
        //$email->SMTPDebug = 2;
        //$email->Debugoutput = 'html';

        $email->Host = "smtp.gmail.com";
        $email->Port=587;
        $email->SMTPSecure="tls";
        $email->SMTPAuth =true;
        $email->Username = "team-developers@c-developers.com";
        $email->Password = "ChNtLdVlPrS20E#";

        $email->setFrom("team-developers@c-developers.com","Retos");
        $email->addReplyTo("team-developers@c-developers.com","Retos");
        $email->addAddress("$account");
        $email->isHTML(true);

        $email->Subject = "Retos | Chontal Developers";
        $file = dirname(__DIR__)."/views/email/index.html";
        $email->msgHTML(file_get_contents($file));
        if($type==1){
            $email->AltBody = "Gracias por contactarnos en breve nos comunicaremos con usted. Les agradece El equipo Retos.";
        }else if($type==2){
            $email->AltBody = "Gracias por suscribirse a nuestro sito http://www.retos.co";
        }
        if(!$email->send()) {
            //echo 'Message could not be sent.';
            //echo 'Mailer Error: ' . $email->ErrorInfo;
        } else {
            return true;
        }
    }

}