<?php 

require_once("..\connection.php");
if (!$_SESSION['user']) {
  header("location:../login.php?msg=Login First");
}
else if ($_SESSION['user']['role_id']!='1') {
  header("location:../user/user.php");
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> Comments </title>
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">

</head>
<body>
<?php require_once "nav_admin.php" ?>

<?php
$query="SELECT * FROM `user_post_comment` ";
$result= mysqli_query($connection,$query);
?>

<br><br><br>

</h5>
<div class="container-fluid mb-5 mt-5">
<div class="row">
  <div class="col-lg-2"></div>
  <div class="col-lg-8">
    <center>
    <h1 class="text-center text-white p-2" style="background-color:indianred;">Comments</h1>
    
    <table class="table table-dark table-striped">
        <thead>
          <tr>
            <th>Post comment id</th>
            <th> Post id</th> 
            <th> User id </th>
           	<th> Comment </th>
           	<th> Status </th>
           	<th> Change Status </th>
          </tr>
        </thead>
        <tbody>
          <?php
             if ($result->num_rows > 0) 
             {
             while ($res = mysqli_fetch_assoc($result)) 
              { ?>
                 
                 <tr>
                   <td><?php echo $res['post_comment_id']?></td>
                   <td><?php echo $res['post_id']?></td>
                   <td><?php echo $res['user_id']?></td>
                 	<td> <?php echo $res['comment']; ?> </td>
                 	<td> <?php echo $res['is_active']; ?> </td>
                 	<?php if ($res['is_active']=="Active") {
                 	?> 		
                 	<td> <b><a href="comments_process.php?inactive=<?php echo $res['post_comment_id'] ?>  " style="color:red ; text-decoration: ;" > InActive </a></b>  </td>
                 	<?php } ?>

                 	<?php if($res['is_active']=="InActive") {
                 	?> 		
                 	<td> <b><a href="comments_process.php?active=<?php echo $res['post_comment_id']; ?>" style="color:green ; text-decoration: ;" > Active </a></b>  </td>
                 	<?php } ?>





<?php }} ?>
<script type="text/javascript" src="../bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<?php /*require "../footer.php";*/ ?>

</body>
</html>