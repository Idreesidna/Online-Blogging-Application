<?php 
require_once "../connection.php";
if (!$_SESSION['user']) {
  header("location:../login.php?msg=access denied");
}
else if ($_SESSION['user']['role_id']!='2') {
  header("location:../admin/admin.php?msg=Illegal way");
}

date_default_timezone_set('Asia/Karachi'); 
$date = date('Y-m-d H:i:s');

if (isset($_REQUEST['uf_blog'])) {
	$blog_id=$_REQUEST['uf_blog']??"";

	$unfollow="UPDATE user_blog_following set status = 'Unfollowed' ,updated_at = '".$date."' WHERE follower_id='".$_SESSION['user']['user_id']."' AND blog_following_id = '".$blog_id."' ";
	$query=mysqli_query($connection,$unfollow);
	if ($query) {
		header("location:show_blog.php?msg=Unfollowed Successfully");
	}
}

else if (isset($_REQUEST['upf_blog'])) {
	$blog_id=$_REQUEST['upf_blog']??"";

	$upfollow="UPDATE user_blog_following set status = 'Followed', updated_at = '".$date."' WHERE follower_id='".$_SESSION['user']['user_id']."' AND blog_following_id = '".$blog_id."' ";
	$query=mysqli_query($connection,$upfollow);
	if ($query) {
		header("location:show_blog.php?msg=Followed Successfully");
	}
}
else if (isset($_REQUEST['follow'])) {
	$blog_id=$_REQUEST['follow'];

	$follow="INSERT INTO user_blog_following (follower_id,blog_following_id,status)
	VALUES('".$_SESSION['user']['user_id']."','".$blog_id."','Followed')";
	$query=mysqli_query($connection,$follow);
	if ($query) {
		header("location:show_blog.php?msg=Followed Successfully");
	}
}
 ?>