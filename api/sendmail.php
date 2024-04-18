<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$env = parse

require 'vendor/autoload.php'; // Adjust the path as needed if you're not using Composer

$mail = new PHPMailer(true);

try {
  //Server settings
  $mail->SMTPDebug = SMTP::DEBUG_SERVER;
  $mail->isSMTP();
  $mail->CharSet = 'UTF-8';

  $mail->Host       = ;
  $mail->SMTPAuth   = true;
  $mail->SMTPSecure = 'tls';
  $mail->Port       = 587;   

  
  
  $mail->Username   = 'tuomas.puro@esedu.fi';
  $mail->Password   = 'Maanantai!';

  $mail->SetFrom('tuomas.puro@esedu.fi', 'Työmaili'); //you need "send to" permission on that account, if dont use yourname@mail.org
  $mail->addReplyTo('no-reply@mail.com', 'First Last');

  //Set who the message is to be sent to
  $mail->addAddress('tuomas.puro@gmail.com', 'Tuomas Puro');
  $mail->Subject = 'PHPMailer SMTP test';
  $mail->isHTML(true);
  $mail->Body = 'This is the <b>message</b>';
  $mail->AltBody = 'This is the message';
  $mail->send();
  echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}