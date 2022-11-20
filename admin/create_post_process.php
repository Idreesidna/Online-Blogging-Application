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
if (isset($_REQUEST['post'])) {
	$blog_id=$_REQUEST['select_blog'];
	$_SESSION['category']=$_REQUEST['category'];
	$post_title=$_REQUEST['post_title'];
	$post_summary=$_REQUEST['post_summary'];
	$post_description=$_REQUEST['post_description'];
	$post_status=$_REQUEST['post_status'];
	$is_comment_allowed=$_REQUEST['is_comment_allowed'];
	

	$img_name = $_FILES['featured_image']['name'];
	$img_size = $_FILES['featured_image']['size'];
	$tmp_name = $_FILES['featured_image']['tmp_name'];
	$error = $_FILES['featured_image']['error'];
}
	if ($img_size > 22500000) {
			$em = "Sorry, your file is too large.";
		    header("Location: create_post.php?msg=$em");
		}	
		else {
			$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
			$img_ex_lc = strtolower($img_ex);
			$allowed_exs = array("jpg", "jpeg", "png"); 

}
		if (in_array($img_ex_lc, $allowed_exs)) {

				$new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
				$img_upload_path = 'featured_image/'.$new_img_name;
				move_uploaded_file($tmp_name, $img_upload_path);


	$insert_post="INSERT INTO post (blog_id,post_title,post_summary,post_description,
	featured_image,post_status,is_comment_allowed)
	VALUES ('".$blog_id."','".$post_title."','".$post_summary."','".$post_description."','".$new_img_name."','".$post_status."','".$is_comment_allowed."') ";
	$query=mysqli_query($connection,$insert_post);

	$last_insert= mysqli_insert_id($connection); // Last inserted id for 


	
	if ($_FILES['attachment']['full_path']!=="") {
		$attachment_title=$_REQUEST['attachment_title']??"";
		$file=$_FILES['attachment']['full_path'];




	$file_name = $_FILES['attachment']['name'];
	$file_size = $_FILES['attachment']['size'];
	$tmp_name = $_FILES['attachment']['tmp_name'];
	$error = $_FILES['attachment']['error'];
}

			$file_ex = pathinfo($file_name, PATHINFO_EXTENSION);
			$file_ex_lc = strtolower($file_ex);
			$allowed_exs = array("jpg", "jpeg", "png","doc","docx","odt","pdf","xls","ods","ppt","pptx","txt","php","html","zip",); 


		if (in_array($file_ex_lc, $allowed_exs)) {

				$new_file_name = uniqid("ATTACHMENT-", true).'.'.$file_ex_lc;
				$file_upload_path = 'attachment/'.$new_file_name;
				move_uploaded_file($tmp_name, $file_upload_path);

		$insert_attachment="INSERT INTO post_atachment (post_id,post_attachment_title,post_attachment_path,is_active) VALUES ('".$last_insert."','".$attachment_title."','".$file_upload_path."','Active')";
		$query_attachment=mysqli_query($connection,$insert_attachment);
}      
      foreach ($_SESSION['category'] as $category_id) {
      		
      		$insert_bridge="INSERT INTO post_category (post_id,category_id) VALUES ('".$last_insert."','".$category_id."')";
     		$query_bridge=mysqli_query($connection,$insert_bridge);
 }
 $select_follower="SELECT * FROM user_blog_following WHERE blog_following_id='".$blog_id."' AND status = 'Followed' ";
	$query_follower=mysqli_query($connection,$select_follower);

	if ($query->select_follower<1) {
	  	header("location:create_post.php?msg=Posted Successfully");
		
	}

if ($query_follower->num_rows>0) {

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


//Set an alternative reply-to address
//$mail->addReplyTo('hidayatrust1788@gmail.com', 'Hidaya Trust');
//Set who the message is to be sent to
	
	if ($query_follower->num_rows>0) {
		while ($ids=mysqli_fetch_assoc($query_follower)) {
			// echo $ids['follower_id']."<br>";
	$select_email="SELECT * FROM user WHERE user_id='".$ids['follower_id']."'";
	$query_email=mysqli_query($connection,$select_email);
	
	$email=mysqli_fetch_assoc($query_email);
 	$mail->addAddress($email['email'], "Reciever");
	
}}  

 
// $mail->addCC('idriiislaghari@gmail.com','Admin');
// $mail->addCC('enter-your-id@gmail.com','Sajjad');

// $mail->addBCC('enter-your-id@gmail.com');


//Set the subject line
$mail->Subject = 'New post uploaded';
//Read an HTML message body
//$mail->isHTML();
//$mail->msgHTML("This Is Testing Message Using PhpMailer");
$mail->msgHTML("<h1> New Post Uploaded </h1>");

//Attach an image file (optional)
// $mail->addAttachment('image1.jpg',"My Image");




//send the message, check for errors
if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
    header("location:create_post.php?msg=Error in sending email to followers $mail->ErrorInfo");
} 
else {
  	header("location:create_post.php?msg=Posted Successfully");
}

}     		
}



?>
