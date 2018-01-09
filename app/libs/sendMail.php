<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../app/libs/mailer/Exception.php';
require '../app/libs/mailer/PHPMailer.php';
require '../app/libs/mailer/SMTP.php';
class sendMail {
    public function send($data = [])
    {
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
            $mail->addAddress($data['clientEmail'], $data['clientName']);
            if(isset($data['reply'])){
                $mail->addReplyTo($data['reply'],'Client');
            }else{
                $mail->addReplyTo('no-reply@qourota.me','Client');
            }
            //Attachments
            if(isset($data['attch'])){
                $mail->addAttachment($data['attch']);
            }
            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $data['subject'];
            $mail->Body    = $data['body'];
            if(isset($data['bodyNonHtml'])){
                $mail->AltBody = $data['bodyNonHtml'];
            }
            $mail->send();
        } catch (Exception $e) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
    }
}