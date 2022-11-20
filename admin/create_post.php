<?php 

require_once("..\connection.php");
if (!$_SESSION['user']) {
  header("location:../login.php?msg=Login First");
}
else if ($_SESSION['user']['role_id']!='1') {
  header("location:../user/user.php");
}
// Query for selecting blog of user
$select="SELECT * FROM blog WHERE user_id = '".$_SESSION['user']['user_id']."' ";
$result=mysqli_query($connection,$select);


$select_category="SELECT * FROM category WHERE category_status='Active'";
$category_result=mysqli_query($connection,$select_category);

?>

<!DOCTYPE html>
<html>
<head>
	<title> Create Post </title>
  <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">

</head>
<body>

<?php require_once("nav_admin.php"); ?>

<script type="text/javascript" src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
  

<br><br><br>
<h3 style="color: green" align="center"> <?php if (isset($_REQUEST['msg'])) {
	echo $_REQUEST['msg'];
} ?> </h3>

<?php 

             if ($result->num_rows < 1) {
                ?> <h5 align="center"> No Blog found first create a blog </h5>  <?php 
              }
             if ($result->num_rows > 0) {
              ?>
<div class="container my-2" style="padding-bottom: 20%">
  <div class="row">
    <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-sm-12">
      <div class="card">
        <div class="card-header bg-dark text-white">
          Create Post
        </div>
        <div class="card-body">
         
  <form method="POST" action="create_post_process.php" enctype="multipart/form-data">
  <div class="form-row">
    <div class="form-group">
      <label>Select Blog</label>

      <select name="select_blog" required>

      	<?php
             if ($result->num_rows > 0) 
             {
             while ($res = mysqli_fetch_assoc($result)) 
              { ?>
   
              	<option value="<?php echo $res['blog_id'] ?>"> <?php echo $res['blog_title']; ?> </option>
              <?php }}  ?>	
      </select>
    </div>
	<hr>    
	<div class="form-row">
    <div class="form-group">
      <label>Select Category</label>
      <br>
     
      	<?php
             if ($category_result->num_rows<1) {
               ?>  <h5 align="center"> No Category Found Create a category </h5>
               <?php
                            }

             if ($category_result->num_rows > 0) 
             {
             while ($category_data = mysqli_fetch_assoc($category_result)) 
              { ?>
   
     		<?php echo $category_data['category_title']; ?> <input type="checkbox" name="category[]" value="<?php echo $category_data['category_id']; ?>"> &nbsp


            <?php }}  ?>	
    	</div>

        <hr>
    <div class="form-group">
    	<label>Post Title</label> 
      <br>
     <textarea name="post_title" required> </textarea>
    </div>

    <hr>
    <div class="form-group">
    	<label>Post Summury</label> 
      <br>
     <textarea name="post_summary" required> </textarea>
    </div>

    <hr>
    <div class="form-group">
      <label>Post Description</label>
      <br>
      <textarea name="post_description" required>  </textarea>
    </div>

    <hr>
    <div class="form-group">
      <label>Featured Image</label>
      <input type="file" name="featured_image" required>
    </div>
  </div>

  <hr>
    <div class="form-group">
      <label>Attachement Title</label>
      <input type="text" name="attachment_title">
    </div>
  </div>

   <hr>
    <div class="form-group">
      <label>Attachment</label>
      <input type="file" name="attachment">
    </div>
  </div>
  

<div class="form-group">
<hr>
 <label> Status </label>
Active <input type="radio" name="post_status" value="Active" required>
InActive <input type="radio" name="post_status" value="InActive"required>
</div>

  <div class="form-group"> 
  	<hr>
    <label for="inputdate">Is Comment Allowed </label>
    Yes <input type="radio" name="is_comment_allowed" value="1" required>
	No <input type="radio" name="is_comment_allowed" value="2" required>
	</div>
  <button type="submit" class="btn btn-primary my-2" name="post">Post</button>
  
</div>




    </form>
 
        </div>
        
      </div>
    </div>
    </div>
  </div>
  
  <?php require '../footer.php';
   }?>
	
</body>
</html>