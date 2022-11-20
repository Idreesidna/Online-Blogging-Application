  <?php 
  
  require_once("..\connection.php");

  if (!$_SESSION['user']) {
  header("location:../login.php?msg=access denied");
}
else if ($_SESSION['user']['role_id']!='2') {
  header("location:../admin/admin.php?msg=Illegal way");
}  
  $select="SELECT * FROM user WHERE email = '".$_SESSION['user']['email']."' AND password = '".$_SESSION['user']['password']."' ";
  $execute=mysqli_query($connection,$select);
  while ($data=mysqli_fetch_assoc($execute)) {
    $first_name = $data['first_name'];
    $last_name = $data['last_name'];
    $user_image=$data['user_image'];
  }

   ?>
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: darkcyan;">
  <div class="container-fluid">
    <a class="navbar-brand" href="../index.php"><img src="../admin/featured_image/IMG-628a43da3e7838.59925005.jpg" height="40px">  Online Blogging Application</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item mx-2">
          <a class="nav-link" href="user.php">Home</a>
        </li>
        

            
    
        <li class="nav-item dropdown mx-4">
        <a class="nav-link " href="show_blog.php" id="navbarDropdown" role="button" aria-expanded="false">
            Blog
          </a>
        </li>
        

<!--         <li class="nav-item dropdown mx-2">
        <a class="nav-link " href="#" id="navbarDropdown" role="button"  aria-expanded="false">
            Category
        </a>
        </li> -->
        
        <li class="nav-item mx-4">
          <a class="nav-link" href="setting.php">Setting</a>
        </li>

        <li class="nav-item mx-4">
          <a class="nav-link" href="search.php">Search</a>
        </li>


        <li class="nav-item mx-4">
          <a class="nav-link" href="feedback_user.php">Feedback</a>
        </li>

        <li class=" nav-item dropdown mx-4">
        <a class="nav-link " href="#contact" id="navbarDropdown" role="button" aria-expanded="false">
            Contact
          </a>
          </li>

      <li class="nav-item">
      </li>
    </ul>


    <div style="padding-right: 2%">
      <ul class="navbar-nav">
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: white">
            <b>
            <?php echo $first_name??""; ?>
            <?php echo $last_name??"";  ?>
            </b>
             <img src="../images/<?php echo $user_image; ?>" width="40" height="40">
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="edit_profile.php?user_id=<?php echo $_SESSION['user']['user_id'] ?>">Edit Profile</a></li>
            <li><a class="dropdown-item" href="../login.php">logout</a></li>
            
          </ul>
        </li>
      </ul>
      
      </div>

    </div>
  </div>
</nav>