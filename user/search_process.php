<?php 

require_once("..\connection.php");

if (!$_SESSION['user']) {
  header("location:../login.php?msg=access denied");
}
else if ($_SESSION['user']['role_id']!='2') {
  header("location:../admin/admin.php?msg=Illegal way");
}

 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">

</head>
<body>

</body>
</html>
<?php
require_once 'nav_user.php';
require_once('../connection.php');
if (isset($_REQUEST['submit'])) {
?>


<?php

//print_r($_REQUEST);


 $query="SELECT * FROM post WHERE created_at like '".$_REQUEST['month']."%'";
$result=mysqli_query($connection,$query);
if ($result->num_rows) {
	while ($show=mysqli_fetch_assoc($result)) {
		?>
<br><br><br><br><br><br>
<div class="card" style="width: 18rem; margin-bottom: 10px;">
  	<div class="card-header">
    <?php echo $show['post_title']??""; ?>
   	</div>
   		<ul class="list-group list-group-flush">
     		<img src="../admin/featured_image/<?php echo $show['featured_image']??"" ;?>">
     		<li class="list-group-item"><?php echo $show['post_summary']??'';  ?>
    		<a href="full_post.php?post_id=<?php echo  $show['post_id']; ?>">Read more.....</a>
   			 </li>
  		</ul>
	</div>

	<?php
	}

 }
	else{
		echo "No post on that date";
	}
}
require_once '../footer.php';
  ?>