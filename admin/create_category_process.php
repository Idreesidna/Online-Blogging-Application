<?php 

require_once("..\connection.php");
if (!$_SESSION['user']) {
  header("location:../login.php?msg=Login First");
}
else if ($_SESSION['user']['role_id']!='1') {
  header("location:../user/user.php");
}
if (isset($_REQUEST['add'])) {
	$category_title=$_REQUEST['category_title'];
	$category_description=$_REQUEST['category_description'];
	$category_status=$_REQUEST['category_status'];

	$insert="INSERT INTO category (category_title,category_description,category_status)
	VALUES('".$category_title."','".$category_description."','".$category_status."')";
	$query=mysqli_query($connection,$insert);
	if ($query) {
		header("location:create_category.php?msg=Category Created Successfully");
	}
}



 ?>