<?php 


 session_start();
 session_destroy();
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Form</title>

  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">

</head>
<body>
  <?php require "nav_bar.php"; ?>
  <br><br><br>

 <center>

              <?php if ($_REQUEST['msg']??"") { ?> 

             <h4 align="center" style="color: red" > <?php echo $_REQUEST['msg']; ?> </h4>
              <?php } ?>
</center>
<div class="container my-2">
  <div class="row">
    <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-sm-12">
      <div class="card">
        <div class="card-header bg-dark text-white">
          Login Form
        </div>
        <div class="card-body">
         
  <form method="POST" action="login_process.php" enctype="multipart/form-data">
  <div class="form-row">

    <div class="form-group">
      <label for="inputEmail4">Email</label>
      <input type="email" class="form-control" id="inputEmail4" name="email" required>
    </div>

    <div class="form-group">
      <label for="inputPassword4">Password</label>
      <input type="password" class="form-control" id="inputPassword4"
      name="password" placeholder="Password" required>
    </div>
  </div>
<center>
<button type="submit" class="btn btn-primary my-2" name="login">Login</button>
</center>
    </form>

    <center>
 Have not an account <a href="register.php" style="text-decoration: none;"> Register </a>
        </center>
        
        <center> <a href="forget.php" style="text-decoration: none;"> Forget Password </a> </center>
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