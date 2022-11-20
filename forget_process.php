<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require 'mail/PHPMailer/src/PHPMailer.php';
require 'mail/PHPMailer/src/SMTP.php';
require 'mail/PHPMailer/src/Exception.php';

require "connection.php";

if (isset($_REQUEST['reset'])) {
	$email=$_REQUEST['email'];

$select="SELECT * FROM user WHERE email = '".$email."' ";
$query=mysqli_query($connection,$select);
$fetch=mysqli_fetch_assoc($query);



//Create a new PHPMailer instance
$mail = new PHPMailer();
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// SMTP::DEBUG_OFF = off (for production use)
// SMTP::DEBUG_CLIENT = client messages
// SMTP::DEBUG_SERVER = client and server messages
//$mail->SMTPDebug = SMTP::DEBUG_SERVER;
//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;
//Set the encryption mechanism to use - STARTTLS or SMTPS
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = 'dummyidris@gmail.com';
//Password to use for SMTP authentication
$mail->Password = 'dummyidris123';
//Set who the message is to be sent from
$mail->setFrom('dummyidris@gmail.com');
$mail->addAddress($fetch['email'], "Reciever");




//Set the subject line
$mail->Subject = 'Reset Password';
//Read an HTML message body
//$mail->isHTML();
//$mail->msgHTML("This Is Testing Message Using PhpMailer");
$mail->msgHTML("<h1> Dear ".$fetch['first_name']." Your Password is ".$fetch['password']." </h1>");

//Attach an image file (optional)
// $mail->addAttachment('image1.jpg',"My Image");




//send the message, check for errors
if (!$mail->send()) {
	header("location:forget.php?msg=$mail->ErrorInfo");
    // echo 'Mailer Error: ' . $mail->ErrorInfo;
} 
else {
   
   header("location:login.php?msg=Password has been sent to your email");
}

}

 ?>