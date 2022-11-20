<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require '../mail/PHPMailer/src/PHPMailer.php';
require '../mail/PHPMailer/src/SMTP.php';
require '../mail/PHPMailer/src/Exception.php';

require_once("..\connection.php");

if (!$_SESSION['user']) {
  header("location:../login.php?msg=access denied");
}
else if ($_SESSION['user']['role_id']!='2') {
  header("location:../admin/admin.php?msg=Illegal way");
}


if (isset($_REQUEST['submit'])) {
	$feedback=$_REQUEST['feedback'];

	$insert="INSERT INTO user_feedback (user_id,user_name,user_email,feedback)
	VALUES('".$_SESSION['user']['user_id']."','".$_SESSION['user']['first_name']."','".$_SESSION['user']['email']."','".$feedback."')";
	$query=mysqli_query($connection,$insert);


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


//Attach an image file (optional)
// $mail->addAttachment('image1.jpg',"My Image");


$select_admins="SELECT * FROM `user` WHERE role_id='1'";
$query_admin= mysqli_query($connection,$select_admins);

//Set an alternative reply-to address
//$mail->addReplyTo('hidayatrust1788@gmail.com', 'Hidaya Trust');
//Set who the message is to be sent to
  

if ($query_admin->num_rows > 0) 
             {
             while ($data = mysqli_fetch_assoc($query_admin)) { 
           		$mail->addAddress($data['email'], "Reciever");
 
// $mail->addCC('idriiislaghari@gmail.com','Admin');
// $mail->addCC('enter-your-id@gmail.com','Sajjad');

// $mail->addBCC('enter-your-id@gmail.com');


//Set the subject line
$mail->Subject = 'Recieved a Feedback';
//Read an HTML message body
//$mail->isHTML();
//$mail->msgHTML("This Is Testing Message Using PhpMailer");
$mail->msgHTML("<h1> Online Blogging Application has recieved a feedback from '".$_SESSION['user']['first_name']."' </h1>");
}}
//Attach an image file (optional)
// $mail->addAttachment('image1.jpg',"My Image");




//send the message, check for errors
if (!$mail->send()) {
    header("location:feedback_user.php?msg=$mail->ErrorInfo");
} 
else {
  	header("location:feedback_user.php?msg=Feedback Sent Successfully");
}}

 ?>