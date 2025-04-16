<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include_once("../PHPMailer-master/src/PHPMailer.php");
include_once("../PHPMailer-master/src/SMTP.php");
include_once("../PHPMailer-master/src/Exception.php");

class Emailer
{
    public $receiver;
    public $subject;
    public $body;

    /**
     * costruttore
     */
    public function __construct()
    {
        $this->receiver = "";
        $this->subject = "";
        $this->body = "";
    }

    public function setInfo($r, $s, $b){
        $this->receiver = $r;
        $this->subject = $s;
        $this->body = $b;
    }

    public function sendEmail(){
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'testrdcsmn@gmail.com';                     //SMTP username
            $mail->Password   = 'xhhr ffwt fsnq icgt';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('testrdcsmn@gmail.com');
            $mail->addAddress($this->receiver);

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $this->subject;
            $mail->Body    = $this->body;

            $mail->send();

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

}
