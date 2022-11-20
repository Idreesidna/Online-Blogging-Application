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
  <title>Create Category</title>
  <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
</head>
<body>
<?php require "nav_admin.php" ?>
<br><br><br><br>
<?php 
	if (isset($_REQUEST['msg'])) {
		?> <h5 align="center"> <?php echo $_REQUEST['msg']; ?> </h5>
		<?php
	}

 ?>
<div class="container my-2">
  <div class="row">
    <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-sm-12">
      <div class="card">
        <div class="card-header bg-dark text-white">
          Create Category
        </div>
        <div class="card-body">
         
  <form method="POST" action="create_category_process.php" enctype="multipart/form-data">
  <div class="form-row">
    <div class="form-group">
      <label>Category Title</label>
      <input type="text" class="form-control" name="category_title" required>
    </div>
    <div class="form-group">
      <label> Category Description </label>
      <input type="text" class="form-control" name="category_description" required>
    </div>
    <br>
    <div class="form-group">
      <label>Category Status</label>
      <br>
      Active <input type="radio"  name="category_status" value="Active" required>
	 
	  InActive <input type="radio" name="category_status" value="InActive" required>
        

    </div>

  <button type="submit" class="btn btn-primary my-2" name="add">Add Category</button>



    </form>
 
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
</html