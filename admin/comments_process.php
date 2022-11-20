<?php 

require_once("..\connection.php");
if (!$_SESSION['user']) {
	header("location:../login.php?msg=Login First");
}
else if ($_SESSION['user']['role_id']!='1') {
	header("location:../user/user.php");
}

if (isset($_REQUEST['inactive'])) {
$id=$_REQUEST['inactive'];
$update="UPDATE user_post_comment SET is_active = 'InActive' WHERE post_comment_id='".$id."'";
$query=mysqli_query($connection,$update);
header("location:comments.php?msg=Status Changed Successfully");

}

else if (isset($_REQUEST['active'])) {
	$id=$_REQUEST['active'];

$update="UPDATE user_post_comment SET is_active = 'Active' WHERE post_comment_id='".$id."'";
$query=mysqli_query($connection,$update);
header("location:comments.php?msg=Status Changed Successfully");


}


?>