<?php 

require_once("..\connection.php");

if (!$_SESSION['user']) {
  header("location:../login.php?msg=access denied");
}
else if ($_SESSION['user']['role_id']!='2') {
  header("location:../admin/admin.php?msg=Illegal way");
}
if (isset($_REQUEST['update'])) {
	$first_name=$_REQUEST['first_name']??"";
	$last_name=$_REQUEST['last_name']??"";
	$gender=$_REQUEST['gender'];
	$dob=$_REQUEST['dob'];
	$address=$_REQUEST['address']??"";

date_default_timezone_set('Asia/Karachi'); 
$date = date('Y-m-d H:i:s');

  $update="UPDATE `user` SET first_name= '".$first_name."', last_name = '".$last_name."',gender='".$gender."',date_of_birth= '".$dob."',address= '".$address."', updated_at='".$date."' WHERE user_id= '".$_SESSION['user']['user_id']."' ";
    $execute=mysqli_query($connection,$update);

}

if (isset($_FILES['image'])) {
	
  $img_name = $_FILES['image']['name'];
  $img_size = $_FILES['image']['size'];
  $tmp_name = $_FILES['image']['tmp_name'];
  $error  =   $_FILES['image']['error'];

  if ($img_size > 1000000) {
      $em = "Sorry, your file is too large.";
        header("Location: update_user.php?msg=$em");
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

        $update_pic="UPDATE `user` SET user_image='".$new_img_name."' WHERE user_id= '".$_SESSION['user']['user_id']."' ";
    	$execute_pic=mysqli_query($connection,$update_pic);

}

}

header("location:user.php?msg=Edited Successfully");



 ?>