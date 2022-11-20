<?php 
// error_reporting(0);

require_once("..\connection.php");

if (!$_SESSION['user']) {
  header("location:../login.php?msg=access denied");
}
else if ($_SESSION['user']['role_id']!='2') {
  header("location:../admin/admin.php?msg=Illegal way");
}

$setting = "SELECT * FROM setting WHERE user_id = '".$_SESSION['user']['user_id']."' AND setting_status='Active' ";
$setting_query=mysqli_query($connection,$setting);



?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> User Panel </title>
 	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">

<style type="text/css">
<?php 

if ($setting_query->num_rows<1) {
  echo "";
}
else{
  $fetch_setting=mysqli_fetch_assoc($setting_query);
  
}



 ?>


    body{
    background-color : <?php echo $fetch_setting['setting_value']; ?> ;
  }


</style>

</head>
<body>
<?php require "nav_user.php"; ?>
 

<br><br><br><br>

<div id="carouselExampleIndicators" class=" container carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="../admin/featured_image/business-women-signature-document.jpg" height="600px" class="d-block w-100" alt="...">
    </div>
<div class="carousel-item">
      <img src="../admin/featured_image/smiley-journalist-filming.jpg" height="600px" class="d-block w-100" alt="...">
    </div>
    </div>
    <div class="carousel-item">
     <img src="admin/featured_image/IMG-6289fcb1641d58.51468064.jpg" height="600px" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="admin/featured_image/IMG-6289fd26ed3f41.30056845.jpg" height="600px" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<br>



<?php 
  
      $q="SELECT COUNT(*) AS 'Total' FROM `post`";
      $r = mysqli_query($connection,$q);
      $f = mysqli_fetch_assoc($r);

      $per_page = 8;
      $total_links = ceil($f['Total']/$per_page);

  if(isset($_REQUEST['page']))
      {
        $start = $_REQUEST['page'] * $per_page;
      }else
      {
         $_REQUEST['page'] = 0;
         $start = 0;
      }
    
?>


<?php 
  $select_p="SELECT * FROM post WHERE post_status = 'Active' ORDER BY post_id DESC LIMIT $start,$per_page";
  $result_p=mysqli_query($connection,$select_p);

  if ($result_p->num_rows>0) {
     # code...
    


// }

   ?>

<div class="container-fluid">
  <div class="row">
    <div class=" container-fluid col-sm-8" id="div_color" style="background-color: gray;height: 90%;">
      <div class="row">
        <?php
   while ($row_p=mysqli_fetch_assoc($result_p)) {
         // for ($i=0; $i < 11; $i++) { 
            ?>
              <div class="col-sm-3">
                <div class="card mb-4">
                    <h6 class="card-title" align="center" style="background-color: saddlebrown;color: white;"> <b> <?php echo substr($row_p['post_title'], 0,10);  ?> </b> </h6>
                  <img src="../admin/featured_image/<?php echo $row_p['featured_image']; ?>" class="card-img-top" alt="..." height="100">
    
                  <div class="card-body" style="background-color: saddlebrown;   ">
                    <p class="card-text" style="color: white"><?php echo substr($row_p['post_summary'], 0,15); ?> <a href="full_post.php?post_id=<?php echo $row_p['post_id']; ?>"> read more </a> </p>
                    
                  </div>
                  <div class="card-footer" style="background-color: ;">
                    <small class="text-muted"> <?php echo $row_p['created_at']; ?> </small>
                  </div>
                </div>
              </div>
            <?php
         }
               if($_REQUEST['page'] > 1)
      {
        ?>
        <a href="user.php?page=<?php echo $_REQUEST['page'] - 1; ?>">Prev</a>
        <?php
      }

      for ($i=1; $i<$total_links; $i++) { 
      
          if($i == $_REQUEST['page'])
          {
            ?>
            <a style="font-size: 40px;color: red" href="user.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
            <?php
          }else{
            ?>
            <a href="user.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
            <?php
          }

        
      }


      if($_REQUEST['page'] != $total_links-1)
      {
        ?>
        <a href="user.php?page=<?php echo $_REQUEST['page'] + 1; ?>">Next</a>
        <?php
      }
      }else{
              echo " No post found";
            }

   ?> 
      </div>
    </div>
  <!-- </div> -->




    
 


  <?php 
  $select="SELECT * FROM post LIMIT 5 ";
  $result=mysqli_query($connection,$select);

  if ($result->num_rows>0) {
     # code...
    

   ?>
   <div class="container-fluid col-md-4" align="center" >
    <h3 align="center"> Recent Posts </h3>
   <?php while ($row=mysqli_fetch_assoc($result)) {
?>
  <div class="card" style="width: 18rem;">
   <h5 class="card-title" style="background-color: brown;"> <b><?php echo substr($row['post_title'], 0,10) ?> </b></h5>
  
  <img style="width: 100%" src="../admin/featured_image/<?php echo $row['featured_image'] ; ?>" class="card-img-top" alt="..." height="150">
  <div class="card-body" style="background-color: brown;">
    
   <p class="card-text" style="color: white;"><?php echo $row['post_summary'] ?></p>
    <a href="full_post.php?post_id=<?php echo $row['post_id'] ; ?>">read more</a>
  <div class="card-body">
<!--   <a href="#" class="card-link">more</a> -->
  </form>
  
  </div>
  </div>
  <div class="card-footer">
  <small class="text-muted"> <?php echo $row['created_at']; ?> </small>
  </div>
</div>
    
<br>
<?php
}} ?>
  
</div>
</div>
</div>





<?php require "../footer.php"; ?>
<script type="text/javascript" src="../bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>


</body>
</html>