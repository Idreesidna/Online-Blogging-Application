<?php 

require_once("..\connection.php");

if (!$_SESSION['user']) {
  header("location:../login.php?msg=access denied");
}
else if ($_SESSION['user']['role_id']!='2') {
  header("location:../admin/admin.php?msg=Illegal way");
}
if(isset($_REQUEST['action']) && $_REQUEST['action'] == "view_comment"){

		$query = "SELECT * FROM user_post_comment WHERE post_id='".$_REQUEST['post_id']."' AND is_active = 'Active' ";
		$comments = mysqli_query($connection,$query);

		// print_r($messages);

		if($comments->num_rows){
			while ($comment = mysqli_fetch_assoc($comments)) {
			echo $comment['comment']."<br>";	
		}
	}
	
}




	elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "send_comment"){
		//print_r($_REQUEST);
     $comment=$_REQUEST['first_name']." : ".$_REQUEST['comment_text'];
	 $query="INSERT INTO user_post_comment(comment,post_id,user_id,is_active) VALUES('".$comment."','".$_REQUEST['post_id']."','".$_REQUEST['user_id']."','InActive')";
		$result=mysqli_query($connection,$query);
		// if ($result) {
		// 	echo "send";
		// }
	}


?>