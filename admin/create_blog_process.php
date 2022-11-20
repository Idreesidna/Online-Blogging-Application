<?php 
require_once("..\connection.php");
if (!$_SESSION['user']) {
	header("location:../login.php?msg=Login First");
}
else if ($_SESSION['user']['role_id']!='1') {
	header("location:../user/user.php");
}
if (isset($_REQUEST['create'])) {
	$blog_title=$_REQUEST['blog_title'];
	$ppp=$_REQUEST['ppp'];
	$blog_status=$_REQUEST['status'];



	$img_name = $_FILES['bg_image']['name'];
	$img_size = $_FILES['bg_image']['size'];
	$tmp_name = $_FILES['bg_image']['tmp_name'];
	$error = $_FILES['bg_image']['error'];
}
	if ($img_size > 22250000) {
			$em = "Sorry, your file is too large.";
		    header("Location: create_blog.php?msg=$em");
		}	
		else {
			$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
			$img_ex_lc = strtolower($img_ex);
			$allowed_exs = array("jpg", "jpeg", "png"); 

}
		if (in_array($img_ex_lc, $allowed_exs)) {

				$new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
				$img_upload_path = 'blog_image/'.$new_img_name;
				move_uploaded_file($tmp_name, $img_upload_path);
				

	$insert="INSERT INTO blog (user_id,blog_title,post_per_page,blog_background_image,blog_status) 
	VALUES ('".$_SESSION['user']['user_id']."','".$blog_title."','".$ppp."','".$new_img_name."','".$blog_status."')";
	$query=mysqli_query($connection,$insert);
	header("location:view_blog.php");
}

?>