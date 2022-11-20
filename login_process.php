<?php 

require_once"connection.php";

if (isset($_REQUEST['login'])) {
	$email=$_REQUEST['email'];
	$password=$_REQUEST['password'];

	$select="SELECT * FROM `user` WHERE `email` = '".$email."' AND `password` = '".$password."';";
	$query=mysqli_query($connection,$select);
}

if ($query->num_rows) {
	$user = mysqli_fetch_assoc($query);
	$_SESSION['user'] = $user;

}

if ($_SESSION['user']['is_approved']=='Pending') {
	header("location:login.php?msg=You are still in pending list wait for approval from user");
}

else if ($_SESSION['user']['email']==$email && $_SESSION['user']['password']==$password && $_SESSION['user']['is_active']=='InActive') {
	header("location:login.php?msg=You are InActive You can not login");
}
else if ($_SESSION['user']['email']==$email && $_SESSION['user']['password']==$password && $_SESSION['user']['is_approved']=='Rejected') {
	header("location:login.php?msg=Invalid login");
}

else if ($_SESSION['user']['email']!=$email &&  $_SESSION['user']['password']!=$password ) {
	header("location:login.php?msg=Invalid login");
}
else if ($_SESSION['user']['email']==$email && $_SESSION['user']['password']==$password && $_SESSION['user']['role_id']=="1") {
	header("location:admin\admin.php");
}
else if ($_SESSION['user']['email']==$email && $_SESSION['user']['password']==$password && $_SESSION['user']['role_id']=="2") {
	header("location:user\user.php");
}
else{
	header("location:login.php?msg=Invalid login");
}

?>