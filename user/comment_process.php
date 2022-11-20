<?php 

require_once("..\connection.php");

if (!$_SESSION['user']) {
  header("location:../login.php?msg=access denied");
}
else if ($_SESSION['user']['role_id']!='2') {
  header("location:../admin/admin.php?msg=Illegal way");
}
if (isset($_REQUEST['send_comment'])) {
	
	$post_id=$_REQUEST['post_id'];
	$comment=$_REQUEST['comment'];

	$insert="INSERT INTO user_post_comment (post_id,user_id,comment)
	VALUES('".$post_id."','".$_SESSION['user']['user_id']."','".$comment."')";
	$query=mysqli_query($connection,$insert);
	if ($query) {
		header("location:full_post.php?msg=commented");
	}

}


?>