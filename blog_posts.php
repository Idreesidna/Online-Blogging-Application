<?php 

require_once("connection.php");



?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> Posts in blog </title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">

</head>
<body>
<?php 
require "nav_visitor.php";
?>

<br><br><br><br>

<?php 
if (isset($_REQUEST['view'])) {
  $blog_id=$_REQUEST['blog_id'];


  $select_blog="SELECT * FROM post WHERE blog_id = '".$blog_id."'";
  $query_blog=mysqli_query($connection,$select_blog);
  
  $blog="SELECT * FROM blog WHERE blog_id = '".$blog_id."' ";
  $blog_query=mysqli_query($connection,$blog);
  $fetch_blog=mysqli_fetch_assoc($blog_query);
  $bg_image="admin/blog_image/".$fetch_blog['blog_background_image'];

if ($query_blog->num_rows>0) {
	 
	
?>

<?php while ($row=mysqli_fetch_assoc($query_blog)) {
	

  	?>
    <div style="background-image: url(<?php echo $bg_image; ?>);" >
  	<center>  <div class="card" style="width: 18rem;" >
 <?php //echo $bg_image; die(); ?>

  <img style="width: 100%" src="admin/featured_image/<?php echo $row['featured_image'] ; ?>" class="card-img-top" alt="..." height="150">
  <div class="card-body">
    <h2> </h2>
    <!-- <span><?php echo $row['created_at'] ?> </span> -->
    <h5 class="card-title"> <b> <?php echo $row['post_title']  ?></b> </h5>
    <p class="card-text"><?php echo $row['post_summary'] ?></p>
    <a href="full_post.php?post_id=<?php echo $row['post_id'] ; ?>">read more</a>
  <div class="card-body">
<!--   <a href="#" class="card-link">more</a> -->
  </form>
  
  </div>
  </div>
  <div class="card-footer">
  <small class="text-muted"> <?php echo $row['created_at']; ?> </small>
  </div>
</div>
    </center>
</div>
<br>
<?php
}}}

?>




<?php require "footer.php"; ?>
<script type="text/javascript" src="bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

</body>
</html>