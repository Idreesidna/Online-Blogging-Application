<?php 
require_once("..\connection.php");
if (!$_SESSION['user']) {
	header("location:../login.php?msg=Login First");
}
else if ($_SESSION['user']['role_id']!='1') {
	header("location:../user/user.php");
}
if (isset($_REQUEST['add'] )) {
	$role=$_REQUEST['role'];
	$first_name=$_REQUEST['first_name'];
	$last_name=$_REQUEST['last_name'];
	$email=$_REQUEST['email'];
	$password=$_REQUEST['password'];
	$gender=$_REQUEST['gender'];
	$dob=$_REQUEST['dob'];
	$address=$_REQUEST['address'];


	$img_name = $_FILES['image']['name'];
	$img_size = $_FILES['image']['size'];
	$tmp_name = $_FILES['image']['tmp_name'];
	$error = $_FILES['image']['error'];
}
	if ($img_size > 1000000) {
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
				$img_upload_path = '../images/'.$new_img_name;
				move_uploaded_file($tmp_name, $img_upload_path);


	$insert="INSERT INTO `user` (`role_id`,`first_name`,`last_name`,`email`,`password`,`gender`,`date_of_birth`,`user_image`,`address`,`is_approved`,`is_active`) 
	VALUES ('".$role."','".$first_name."','".$last_name."','".$email."','".$password."','".$gender."','".$dob."','".$new_img_name."','".$address."','Approved','Active')";
	$execute=mysqli_query($connection,$insert);

}
	if ($execute) {
		header("location:add_user.php?msg=User Account Created Successfully");
	}
	else{
		header("location:add_user.php?msg=account is not created please try again ");
	
	}


?>