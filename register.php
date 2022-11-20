<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registration Form</title>
  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
<style type="text/css">
  span{
    color: red;
  }
</style>
</head>
<body>
<?php require "nav_bar.php"; ?>
<br><br><br>
<?php if (isset($_REQUEST['msg'])){
  ?> <h5 align="center" style="color: darkgreen;"> <?php echo $_REQUEST['msg']; ?> </h5>
  <?php
}
if (isset($_REQUEST['download'])) {
  $_REQUEST['download']??"";
  ?>
   <a href="<?php echo $_REQUEST['download']??"" ?>"> Download Registration Data </a></center>

  <?php
}
 ?> 
<div class="container my-2" style="padding-bottom: 10%;">
  <div class="row">
    <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-sm-12">
      <div class="card">
        <div class="card-header bg-dark text-white">
          Registeration Form
        </div>
        <div class="card-body">
         
  <form method="POST" action="registration_process.php" enctype="multipart/form-data" onsubmit="return form_validation()">
  <div class="form-row">
    <div class="form-group">
      <label for="inputfirstname">First name</label>
      <span id="first_name_msg">  </span>
      <input type="text" class="form-control" id="first_name" name="first_name"placeholder="Idris" required>

    </div>
    <div class="form-group">
      <label for="inputlastname">Last name </label>
      <span id="last_name_msg">  </span>
      <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Ahmed" required>
    </div>
    <div class="form-group">
      <label for="inputEmail4">Email</label>
      <span id="email_msg">  </span>
      <input type="email" class="form-control" id="email" name="email" placeholder="idris@gmail.com" required>
    </div>

    <div class="form-group">
      <label for="inputPassword4">Password</label>
      <span id="password_msg">  </span>
      <input type="password" class="form-control" id="password"
      name="password" placeholder="Password" required>
    </div>
  </div>
<div>
 <label> Gender</label>
<span id="gender_msg">  </span>
Male: <input type="radio" name="gender" value="male" id="male" required>
Female:<input type="radio" name="gender" value="Female" id="female" required>
</div>

  <div class="form-group"> 
    <label for="inputdate">Date of Birth</label>
    <input type="date" class="form-control" id="inputdate" placeholder="Apartment, studio, or floor" name="dob" required>
  </div>
  <div class="form-row">
    <div class="form-group">
      <label>Image</label>
      <input type="file" class="form-control" id="inputCity" name="image" required>
    </div>
</div>


  <div class="form-group"> 
    <label for="inputAddress2">Address</label>
    <span id="address_msg">  </span>
    <input type="text" class="form-control" id="address" name="address" placeholder="Apartment, studio, or floor" required>
  </div>

  <button type="submit" class="btn btn-primary my-2" name="register">Register</button>



    </form>
    <center>
    Already have an account <a href="login.php"> login </a>
 </center>
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


<script>
          function form_validation(){
            var is_validate = true;
                // Input Fields Data
            var first_name = document.getElementById("first_name").value;
            var last_name = document.getElementById("last_name").value;
            var email = document.getElementById("email").value;
            var password = document.getElementById("password").value;
            var gender_male = document.getElementById("male").checked;
            var gender_female = document.getElementById("female").checked;
            var address = document.getElementById("address").value;
  
            // Input Fields Patterns

            var alphabets_pattern = /^[a-z]{3,15}$/i;
            var email_pattern = new RegExp(/^[a-z0-9]{3,30}@[a-z]{5,10}\.(com|org)$/i);
  
            var address_pattern = /^[\w\W]{7,100}$/;
            var password_pattern=  /^[a-z0-9]{8,}$/;

              if(first_name == ""){
                is_validate = false;
                document.getElementById("first_name_msg").innerHTML  = "Please Enter First Name";
              }
              else{
                document.getElementById("first_name_msg").innerHTML = "";
                if(!alphabets_pattern.test(first_name)){
                  is_validate = false;
                  document.getElementById("first_name_msg").innerHTML  = "First Name Should Contain only Alphabets range[3-15]";
                }
              }

              if(last_name != ""){
                if(!alphabets_pattern.test(last_name)){
                  is_validate = false;
                  document.getElementById("last_name_msg").innerHTML  = "Last Name Should Contain only Alphabets range[3-15]";
                }
                else{
                  document.getElementById("last_name_msg").innerHTML  = "";
                }
              }

              if(email == ""){
                is_validate = false;
                document.getElementById("email_msg").innerHTML  = "Please Enter Email";
              }
              else{
                document.getElementById("email_msg").innerHTML = "";
                if(!email_pattern.test(email)){
                  is_validate = false;
                  document.getElementById("email_msg").innerHTML  = "Email Should Be Like: abc@gmail.com";
                }
              }

               if(password == ""){
                is_validate = false;
                document.getElementById("password_msg").innerHTML  = "Please Enter password";
              }
              else{
                document.getElementById("password_msg").innerHTML = "";
                if(!password_pattern.test(password)){
                  is_validate = false;
                  document.getElementById("password_msg").innerHTML  = " password can be like this : idna12la";
                }
              }





              
                if(address == ""){
                is_validate = false;
                document.getElementById("address_msg").innerHTML  = "Please Enter Address";
              }
              else{
                document.getElementById("address_msg").innerHTML = "";
                if(!address_pattern.test(address)){
                  is_validate = false;
                  document.getElementById("address_msg").innerHTML  = "Address Length Min:10 Max:100";
                }
              }

              // alert("Male: "+gender_male);
              // alert("Female: "+ gender_female);

              if(!gender_male && !gender_female){
                is_validate = false;
                document.getElementById("gender_msg").innerHTML  = "Please Select Gender";
              }
              else{
                document.getElementById("gender_msg").innerHTML  = "";
              }

             
            if(is_validate){
              return true;
            }
            else{
              return false;
            }
          }
        </script>


</body>
</html