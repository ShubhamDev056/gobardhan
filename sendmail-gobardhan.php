<?php
phpinfo();
die;
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

require("PHPMailer-master/PHPMailer-master/src/PHPMailer.php");   
require("PHPMailer-master/PHPMailer-master/src/SMTP.php");
require("PHPMailer-master/PHPMailer-master/src/Exception.php");

$mail = new PHPMailer\PHPMailer\PHPMailer();
$mail->IsSMTP(); // enable SMTP

$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
$mail->Host = "relay.nic.in"; //"smtp.gmail.com";  
$mail->Port = 465; // or 587
$mail->IsHTML(true); 
$mail->Username = "gobardhan-ddws@gov.in"; 
$mail->Password = "Ddws@2023";
$mail->SetFrom("gobardhan-ddws@gov.in");
$mail->Subject = "SSS Test Mail MQUAD";
$mail->Body = "This mail is only for testing.";
$mail->AddAddress("satyendrasinghbca777@gmail.com"); 
//$mail->AddAddress("satyendra.singh@indevconsultancy.com"); 
if(!$mail->Send()) {
	echo "Mailer Error: " . $mail->ErrorInfo;
 } else {
	echo "Message has been sent";
 }

 ?>