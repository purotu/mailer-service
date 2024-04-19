<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Set Content-Type header
header('Content-Type: application/json');

// json payload
$json = json_decode(filter_input(INPUT_POST, 'php://input'));

// Function to send JSON response and exit
function sendResponse($data) {
  echo json_encode($data);
  exit;
}

// Check if JSON decoding was successful
if (json_last_error() !== JSON_ERROR_NONE) {
  sendResponse(json_last_error);
  // sendResponse(['error' => 'Invalid JSON payload']);
}

// Check if all required properties are present
if (!isset($json->fromEmail, $json->fromName, $json->toEmail, $json->toName, $json->subject, $json->messageBody)) {
  sendResponse(['error' => 'Missing required information']);
}


// Validate email addresses
if (!filter_var($json->fromEmail, FILTER_VALIDATE_EMAIL) || !filter_var($json->toEmail, FILTER_VALIDATE_EMAIL)) {
  sendResponse(['error' => 'Invalid email address']);
}

require_once realpath(__DIR__ . '/../vendor/autoload.php');
// Looing for .env at the root directory
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../..');
$dotenv->load();

// Retrive env variable
$user = $_ENV['SMTP_USER'];
$host = $_ENV['SMTP_HOST'];
$pass = $_ENV['SMTP_PASSWORD'];
$port = $_ENV['SMTP_PORT'];

$mail = new PHPMailer(true);

try {
  //Server settings
  $mail->SMTPDebug = false;
  $mail->isSMTP();
  $mail->CharSet = 'UTF-8';

  $mail->Host       = $host;
  $mail->SMTPAuth   = false;
  $mail->SMTPSecure = '';
  $mail->Port       = $port;   
  
  $mail->Username   = $user;
  $mail->Password   = $pass;

  $mail->SetFrom($json->fromEmail, $json->fromName);
  $mail->addReplyTo($json->fromEmail, $json->fromName);

  //Set who the message is to be sent to
  $mail->addAddress($json->toEmail, $json->toName);
  $mail->Subject = $json->subject;
  $mail->isHTML(true);
  $mail->Body = $json->messageBody;
  $mail->AltBody = strip_tags($json->messageBody);
  $mail->send();

  // Send success response
  sendResponse(['message' => 'Message has been sent']);
} catch (Exception $e) {
  sendResponse(['error' => "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"]);
} catch (\PHPMailer\PHPMailer\Exception $e) {
  sendResponse(['error' => "Message could not be sent. Connection Error: {$e->getMessage()}"]);
}