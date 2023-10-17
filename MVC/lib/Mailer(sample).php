<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require '../vendor/autoload.php';

class Mailer{

    public function sendMail($email) {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 465;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->SMTPAuth = true;

        $mail->Username = 'account@gmail.com';
        $mail->Password = '**********';

        $mail->setFrom('account@gmail.com', 'Name');
        $mail->addAddress($email);


        $mail->Subject = 'PHPMailer GMail SMTP test';

        $mail->msgHTML('hello');

        $mail->AltBody = 'This is a plain-text message body';
        if (!$mail->send()) {
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message sent!';
        }
        die();
    }
}
