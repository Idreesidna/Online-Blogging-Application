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
  <title>Add User</title>
  <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
</head>
<body>
<?php require "nav_admin.php" ?>
<br><br><br>
<?php 
	if (isset($_REQUEST['msg'])) {
	?> <h5 align="center"> <?php echo $_REQUEST['msg']; ?> </h5>
<?php	}

 ?>
<div class="container my-2" style="padding-top: 2%;padding-bottom: 10%">
  <div class="row">
    <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-sm-12">
      <div class="card">
        <div class="card-header bg-dark text-white">
          Add User
        </div>
        <div class="card-body">

  <form method="POST" action="add_user_process.php" enctype="multipart/form-data">
  
	<div class="form-row">
    <div class="form-group">
 	<label>Role</label> &nbsp&nbsp(
	User <input type="radio" name="role" value="2" required>
	Admin <input type="radio" name="role" value="1" required>)
	<br>
	</div>


  <div class="form-row">
    <div class="form-group">
      <label for="inputfirstname">First name</label>
      <input type="text" class="form-control" id="inputEmail4" name="first_name"placeholder="Idris" required>
    </div>
    <div class="form-group">
      <label for="inputlastname">Last name </label>
      <input type="text" class="form-control" id="inputEmail4" name="last_name" placeholder="Ahmed" required>
    </div>
    <div class="form-group">
      <label for="inputEmail4">Email</label>
      <input type="email" class="form-control" id="inputEmail4" name="email" placeholder="idris@gmail.com" required>
    </div>

    <div class="form-group">
      <label for="inputPassword4">Password</label>
      <input type="password" class="form-control" id="inputPassword4"
      name="password" placeholder="Password" required>
    </div>
  </div>
<div>
 <label> Gender</label>

Male: <input type="radio" name="gender" value="male" required>
Female:<input type="radio" name="gender" value="Female"required>
</div>

  <div class="form-group"> 
    <label for="inputdate">Date of Birth</label>
    <input type="date" class="form-control" id="inputdate" placeholder="Apartment, studio, or floor" name="dob" required>
  </div>

  <div class="form-row">
    <div class="form-group">
      <label for="inputCity">Image</label>
      <input type="file" class="form-control" id="inputCity" name="image" required>
    </div>
</div>

  <div class="form-group"> 
    <label for="inputAddress2">Address</label>
    <input type="text" class="form-control" id="inputAddress" name="address" placeholder="Apartment, studio, or floor" required>
  </div>

  <button type="submit" class="btn btn-primary my-2" name="add">Add</button>



    </form>
 
        </div>
        
      </div>
    </div>
    </div>
  </div>
  <script type="text/javascript" src="../bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    
  
<footer style="margin-left: -200;">
  
<?php 
  require '../footer.php';
   ?>

</footer>

</body>
</html