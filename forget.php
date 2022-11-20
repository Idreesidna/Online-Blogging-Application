<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> Forget Password </title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">

</head>
<body>
<br>
<?php 
if (isset($_REQUEST['msg'])) {
?> <h5 align="center" style="color: red;"> error : <?php echo $_REQUEST['msg'] ?> </h5>
<?php  
}

 ?>
<div class="container my-2">
  <div class="row">
    <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-sm-12">
      <div class="card">
        <div class="card-header bg-dark text-white">
          Login Form
        </div>
        <div class="card-body">
         
  <form method="POST" action="forget_process.php">
  <div class="form-row">

    <div class="form-group">
      <label for="inputEmail4">Email</label>
      <input type="email" class="form-control" id="inputEmail4" name="email" required>
    </div>
<center>
<button type="submit" class="btn btn-primary my-2" name="reset">Reset</button>
</center>
    </form>
      </div>
        
      </div>
    </div>
    </div>
  </div>
  
  <script type="text/javascript" src="bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
  <?php 
  require 'footer.php';
   ?>


</body>
</html>