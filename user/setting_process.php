<?php

require_once("..\connection.php");

if (!$_SESSION['user']) {
  header("location:../login.php?msg=access denied");
}
else if ($_SESSION['user']['role_id']!='2') {
  header("location:../admin/admin.php?msg=Illegal way");
}
if (isset($_REQUEST['save'])) {
	$post_background=$_REQUEST['card_body'];
	$status=$_REQUEST['status'];

	$delete="DELETE FROM setting WHERE user_id = '".$_SESSION['user']['user_id']."' ";
	$delete_query = mysqli_query($connection,$delete);

$insert_background="INSERT INTO setting (user_id,setting_key,setting_value,setting_status)
VALUES ('".$_SESSION['user']['user_id']."','post_background','".$post_background."','".$status."')";
$post_background_query=mysqli_query($connection,$insert_background);

header("location:setting.php?msg=Changes Saved");

}




?>