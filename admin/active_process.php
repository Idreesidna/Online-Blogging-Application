<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require '../mail/PHPMailer/src/PHPMailer.php';
require '../mail/PHPMailer/src/SMTP.php';
require '../mail/PHPMailer/src/Exception.php';


require_once("..\connection.php");
if (!$_SESSION['user']) {
	header("location:../login.php?msg=Login First");
}
else if ($_SESSION['user']['role_id']!='1') {
	header("location:../user/user.php");
}
if (isset($_REQUEST['active'])) {
	$user_id=$_REQUEST['active'];

	$active="UPDATE user SET is_active = 'Active' WHERE user_id = '".$user_id."' ";
	$qactive=mysqli_query($connection,$active);
		
	$select="SELECT * FROM user WHERE user_id = '".$user_id."'";
	$squery=mysqli_query($connection,$select);
	$data=mysqli_fetch_assoc($squery);

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

//Set an alternative reply-to address
//$mail->addReplyTo('hidayatrust1788@gmail.com', 'Hidaya Trust');
//Set who the message is to be sent to
$mail->addAddress($data['email'], "Reciever");
// $mail->addCC('idriiislaghari@gmail.com','Ahmed');
// $mail->addCC('enter-your-id@gmail.com','Idris');

// $mail->addBCC('enter-your-id@gmail.com');


//Set the subject line
$mail->Subject = 'Account Activated';
//Read an HTML message body
//$mail->isHTML();
//$mail->msgHTML("This Is Testing Message Using PhpMailer");
$mail->msgHTML("<h1> Your account Has been Activated </h1>");

//Attach an image file (optional)
// $mail->addAttachment('image1.jpg',"My Image");



//send the message, check for errors
if (!$mail->send()) {
    // echo 'Mailer Error: ' . $mail->ErrorInfo;
   header("location:users.php?msg=$mail->ErrorInfo");
}
 else {
	header("location:users.php?msg=User Activated Successfully");
}}




?>