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
  <title> create blog </title>
  <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">

</head>
<body>

<?php  require "nav_admin.php" ?>
<br><br><br>
<div class="container my-2" style="padding-bottom: 20%">
  <div class="row">
    <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-sm-12">
      <div class="card">
        <div class="card-header bg-dark text-white">     
          <br>Create Blog
        </div>

    <div class="card-body">     
  <form method="POST" action="create_blog_process.php" enctype="multipart/form-data">
  <div class="form-row">
    <div class="form-group">
   <label>Blog Title</label>
     <input type="text" class="form-control" id="inputAddress" name="blog_title" required>
    </div>

    <hr>
    <div class="form-group">
      <label>Post per page</label>
      <select name="ppp">
        
        <option value="5"> Post Per Page </option>
        <option value="5">  5   </option>
        <option value="10"> 10 </option>
        <option value="15"> 15 </option>

      </select>

    <hr>
    <div class="form-row">
    <div class="form-group">
      <label>Background Image</label>
      <input type="file" class="form-control" id="inputCity" name="bg_image" required>
    </div>
    </div>
<hr>
  <div class="form-group">
 <label> Status </label>

Active: <input type="radio" name="status" value="Active" required>
InActive:<input type="radio" name="status" value="InActive"required>
</div>
<hr>

  <button type="submit" class="btn btn-primary my-2" name="create">Create</button>


    </form>
 
        </div>
        
      </div>
    </div>
    </div>
  </div>
</div>
  



<script type="text/javascript" src="../bootstrap/js/bootstrap.bundle.min.js"></script>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

<?php 
  require '../footer.php';
   ?>
   
</body>
</html>