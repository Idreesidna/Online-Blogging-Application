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
	<title> Setting </title>
 	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">

</head>
<body>

  <?php require "nav_user.php"; ?>
  <br><br><br>
<div class="container my-2">
  <div class="row">
    <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-sm-12">
      <div class="card">
        <div class="card-header bg-dark text-white">
        	Setting
        </div>
        <div class="card-body">
         
  <form method="POST" action="setting_process.php" enctype="multipart/form-data">
  <div class="form-row">
  	<center>
      <div class="form-group">
      <label> Background Color</label>
      <br>
   	<input type="color" name="card_body">
    </div>
<hr style="width: 40%;">
    
    <div class="form-group">
      <label>Status</label>
      <br>
   		Active : <input type="radio" name="status" value="Active" required>
   	InActive : <input type="radio" name="status" value="InActive" required>
   	<hr style="width: 40%;">
    </div>

  </div>
<center>
<button type="submit" class="btn btn-primary my-2" name="save">Save</button>
</center>
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
</html>