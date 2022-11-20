<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require 'mail/PHPMailer/src/PHPMailer.php';
require 'mail/PHPMailer/src/SMTP.php';
require 'mail/PHPMailer/src/Exception.php';


require_once("connection.php");

if (isset($_REQUEST['register'])) {
	$first_name=$_REQUEST['first_name'];
	$last_name=$_REQUEST['last_name'];
	$email=$_REQUEST['email'];
	$password=$_REQUEST['password'];
	$gender=$_REQUEST['gender'];
	$dob=$_REQUEST['dob'];
	$address=$_REQUEST['address'];

	$_SESSION['first_name']=$first_name;
	$_SESSION['last_name']=$last_name;
	$_SESSION['email']=$email;
	$_SESSION['gender']=$gender;
	$_SESSION['date_of_birth']=$address;
	$_SESSION['password']=$password;

	$img_name = $_FILES['image']['name'];
	$img_size = $_FILES['image']['size'];
	$tmp_name = $_FILES['image']['tmp_name'];
	$error = $_FILES['image']['error'];
}
	if ($img_size > 1000000) {
			$em = "Sorry, your picture is too large.";
		    header("Location: register.php?msg=$em");
		}	
		else {
			$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
			$img_ex_lc = strtolower($img_ex);
			$allowed_exs = array("jpg", "jpeg", "png"); 

}
		if (in_array($img_ex_lc, $allowed_exs)) {

				$new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
				$img_upload_path = 'images/'.$new_img_name;
				move_uploaded_file($tmp_name, $img_upload_path);
				$insert="INSERT INTO `user` (`role_id`,`first_name`,`last_name`,`email`,`password`,`gender`,`date_of_birth`,`user_image`,`address`) 
				VALUES ('2','".$first_name."','".$last_name."','".$email."','".$password."','".$gender."','".$dob."','".$new_img_name."','".$address."')";
				$execute=mysqli_query($connection,$insert);



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
$mail->addAddress($email,"Reciever");
//Set the subject line
//Read an HTML message body
//$mail->isHTML();
//$mail->msgHTML("This Is Testing Message Using PhpMailer");
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
 }}
// $mail->addCC('idriiislaghari@gmail.com','Admin');
// $mail->addCC('enter-your-id@gmail.com','Sajjad');

// $mail->addBCC('enter-your-id@gmail.com');


//Set the subject line
$mail->Subject = 'New Account Request';
//Read an HTML message body
//$mail->isHTML();
//$mail->msgHTML("This Is Testing Message Using PhpMailer");
$mail->msgHTML("<h1> New Account Request </h1>");

//Attach an image file (optional)
// $mail->addAttachment('image1.jpg',"My Image");




//send the message, check for errors
if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} 
else {
  	header("location:register.php?msg=Account Created Wait for approval from admin&download=pdf.php");
}}

?>