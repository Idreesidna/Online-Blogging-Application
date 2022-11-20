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
  <title>Feedback</title>
  <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
<style type="text/css">
  span{
    color: red;
  }
</style>
</head>
<body>
<?php require "nav_user.php" ?>
<br><br><br>
<?php if (isset($_REQUEST['msg'])){
  ?> <h5 align="center" style="color: darkgreen;"> <?php echo $_REQUEST['msg']; ?> </h5>
  <?php
} ?>
  
<div class="container-fluid my-2">
  <div class="row">
    <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-sm-12">
      <div class="card">
        <div class="card-header bg-dark text-white">
        Feedback</div>
        <div class="card-body">
         
  <form method="POST" action="feedback_process.php" enctype="multipart/form-data" onsubmit="return form_validation()">
  <div class="form-row">
    <div class="form-group">
     <center>
      <label >Feedback</label>
      <br>
      <textarea name="feedback" required>  </textarea>
    </center>
    </div>
<center>
  <button type="submit" class="btn btn-primary my-2" name="submit">Submit</button>
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
</html