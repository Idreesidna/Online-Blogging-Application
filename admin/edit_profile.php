<?php 

require_once("..\connection.php");
if (!$_SESSION['user']) {
  header("location:../login.php?msg=Login First");
}
else if ($_SESSION['user']['role_id']!='1') {
  header("location:../user/user.php");
}
if (isset($_REQUEST['user_id'])) {
  $user_id=$_REQUEST['user_id'];

$select= "SELECT * FROM `user` WHERE user_id= '".$user_id."' ";
$query=mysqli_query($connection,$select);


?>

<!DOCTYPE html>
<html>
<head>
  <title> Edit Profile </title>
  <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">

</head>
<body>

  <?php
  require "nav_admin.php";
             if ($query->num_rows > 0) 
             {
             while ($data = mysqli_fetch_assoc($query)) 
              { ?>


<br><br><br>
<div class="container my-2" style="padding-bottom: 10%;padding-top: 2%">
  <div class="row">
    <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-sm-12">
      <div class="card">
        <div class="card-header bg-dark text-white">
         Update
        </div>
        <div class="card-body">
         
  <form method="POST" action="edit_profile_process.php" enctype="multipart/form-data">
  <div class="form-row">
    <div class="form-group">
      <label for="inputfirstname">First name</label>
      <input type="text" class="form-control" id="inputEmail4" name="first_name" value="<?php echo $data['first_name'] ?>" required>
    </div>
    <div class="form-group">
      <label for="inputlastname">Last name </label>
      <input type="text" class="form-control" id="inputEmail4" name="last_name" value="<?php echo $data['last_name'] ?>" required>
    </div>
<br>
<div>
 <label> Gender</label>

Male: <input type="radio" name="gender" value="Male" required>
Female:<input type="radio" name="gender" value="Female"required>
</div>
<br>
<hr>
  <div class="form-group"> 
    <label>Date of Birth</label>
    <input type="date" value="<?php echo $data['date_of_birth'] ?>"name="dob">
  </div>

  <br>
<hr>
<div class="form-row">
    <div class="form-group">
      <label for="inputCity">Image</label>
      <input type="file" class="form-control" name="image" >
    </div>
</div>

<div class="form-group"> 
    <label>Address</label>
    <br>
    <textarea name="address"> <?php echo $data['address'] ?> </textarea>
    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
  </div>

  <button type="submit" class="btn btn-primary my-2" name="update">Update</button>

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

}}}

?>
</body>
</html>