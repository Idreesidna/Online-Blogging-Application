<?php 

require_once("connection.php");

$select_blog="SELECT * from blog";
$query_blog=mysqli_query($connection,$select_blog);

$select_category="SELECT * from category";
$query_category=mysqli_query($connection,$select_category);


?>

<!DOCTYPE html>
<html>
<head>
	<title> Show blogs </title>
 	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
<?php require "nav_visitor.php"; ?>

<br><br><br><br>
<div class="container-fluid my-2">
  <div class="row">
    <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-sm-12">
      <div class="card">
        <div class="card-header bg-dark text-white">
         Blogs and Categories
        </div>
        <div class="card-body">
         
  <form method="POST" action="blog_posts.php">
  <div class="form-row">

  	<?php if ($query_blog->num_rows>0) {
  		
  	 ?>
    <div class="form-group">
      <center>
      <label>Blogs</label>

    <select name="blog_id" required>
    	<?php while ($blogs=mysqli_fetch_assoc($query_blog)) {	?>	
    	<option value="<?php echo $blogs['blog_id'] ?>"> <?php echo $blogs['blog_title'] ?> </option>
    	<?php }} ?>

     </select>
     </center>
<!-- 
     <?php if ($query_category->num_rows>0) { ?>

     <label> Categories </label>
     
     <select name=category_id required>
     <option> Select Category  </option>
<?php 
    	
     	while ($categories=mysqli_fetch_assoc($query_category)) { ?>
     	
     	<option value="<?php echo $categories['category_id']?>"> <?php  echo $categories['category_title'] ?> </option>
  	  <?php	} } ?>
  
     </select> -->
    </div>
<center>
	<br>
<button type="submit" class="btn btn-primary my-2" name="view"> View </button>
</center>
    </form>
      </div>
        
      </div>
    </div>
    </div>
  </div>



<?php require "footer.php"; ?>
<script type="text/javascript" src="bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

</body>
</html>