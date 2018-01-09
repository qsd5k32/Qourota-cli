<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../app/libs/mailer/Exception.php';
require '../app/libs/mailer/PHPMailer.php';
require '../app/libs/mailer/SMTP.php';
require("../app/backup/Validation.php");
class contactUs
{
    public $Errors = [];
    public function send($data = []){
        $info = array('name'=> $data['name'],'address'=> $data['subject'],'email'=> $data['email'],'message' => $data['message']);
        foreach($info as $type => $value):
            if (strlen($value) <= 3):
                $this->Errors[] = 'please use more than 3 characters for ' . $type;
            elseif (validate($value, $type)):
                $this->Errors[] =  "$type  not match make sure you're using a valid character";
            endif;
        endforeach;
        if(empty($this->Errors)){
            $mail = new PHPMailer(true);                 // Passing `true` enables exceptions
            try {
                //Server settings
                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = 'qourotacompany@gmail.com';                 // SMTP username
                $mail->Password = 'Szsz123sz321@';                           // SMTP password
                $mail->SMTPSecure = 'tls';                    // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 587;                                    // TCP port to connect to
                //Recipients
                $mail->setFrom('Services@qourota.me', 'Qourota.me');
                $mail->addAddress('qourotacompany@gmail.com', 'Contact us');
                $mail->addReplyTo($data['email'],$data['name']);
                //Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = $data['subject'];
                $mail->Body    = $data['message'];
                $mail->send();
                return true;
            } catch (Exception $e) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
                return false;
            }
        }else {
            return false;
        }
        }
}
