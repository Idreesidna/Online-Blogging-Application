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
	<title> Posts in blog </title>
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">

</head>
<body>
<?php 
require "nav_user.php";
?>

<br><br><br><br>

<?php 
if (isset($_REQUEST['view'])) {
  $blog_id=$_REQUEST['blog_id'];
  
  $perpage="SELECT * FROM blog WHERE blog_id = '".$blog_id."' ";
  $perpage_query = mysqli_query($connection,$perpage);
  $fetch_perpage=mysqli_fetch_assoc($perpage_query);

      $q="SELECT COUNT(*) AS 'Total' FROM `post`";
      $r = mysqli_query($connection,$q);
      $f = mysqli_fetch_assoc($r);

      $per_page = $fetch_perpage['post_per_page'];
   
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


  $select_blog="SELECT * FROM post WHERE blog_id = '".$blog_id."'";
  $query_blog=mysqli_query($connection,$select_blog);
  
  $blog="SELECT * FROM blog WHERE blog_id = '".$blog_id."' ";
  $blog_query=mysqli_query($connection,$blog);
  $fetch_blog=mysqli_fetch_assoc($blog_query);
  $bg_image="../admin/blog_image/".$fetch_blog['blog_background_image'];

$select="SELECT * FROM user_blog_following WHERE follower_id='".$_SESSION['user']['user_id']."' AND blog_following_id='".$blog_id."' ";
$query=mysqli_query($connection,$select);


if ($query->num_rows>0) {
  $fetch=mysqli_fetch_assoc($query);
    if ($fetch['status']=="Followed") {
      ?>
      <center>
     <a href="blog_follow_process.php?uf_blog=<?php echo $blog_id; ?>" style="text-decoration: none"> unFollow Blog </a> </center> <?php 
    } 

   if ($fetch['status']=="Unfollowed") {
    ?><center> <a href="blog_follow_process.php?upf_blog=<?php echo $blog_id; ?>" style="text-decoration: none">Follow Blog</a> </center>
    <?php 
   }

  
}
else {
  ?> 
  <center>
    <a href="blog_follow_process.php?follow=<?php echo $blog_id; ?>"> follow Blog </a> </center>
  <?php 
}
if ($query_blog->num_rows>0) {
	 
	
?>

<?php while ($row=mysqli_fetch_assoc($query_blog)) {
	

  	?>
    <div style="background-image: url(<?php echo $bg_image; ?>);" >
  	<center>  <div class="card" style="width: 18rem;" >
 <?php //echo $bg_image; die(); ?>

  <img style="width: 100%" src="../admin/featured_image/<?php echo $row['featured_image'] ; ?>" class="card-img-top" alt="..." height="150">
  <div class="card-body">
    <h2> </h2>
    <!-- <span><?php echo $row['created_at'] ?> </span> -->
    <h5 class="card-title"> <b> <?php echo $row['post_title']  ?></b> </h5>
    <p class="card-text"><?php echo $row['post_summary'] ?></p>
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
    </center>
</div>
<br>
<?php
}

         }     if($_REQUEST['page'] > 1)
      {
        ?>
        <a href="blog_posts.php?page=<?php echo $_REQUEST['page'] - 1; ?>">Prev</a>
        <?php
      }

      for ($i=1; $i<$total_links; $i++) { 
      
          if($i == $_REQUEST['page'])
          {
            ?>
            <a style="font-size: 40px;color: red" href="blog_posts.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
            <?php
          }else{
            ?>
            <a href="blog_posts.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
            <?php
          }

        
      }


      if($_REQUEST['page'] != $total_links-1)
      {
        ?>
        <a href="blog_posts.php?page=<?php echo $_REQUEST['page'] + 1; ?>">Next</a>
        <?php
      }
      }else{
              echo " No post found";
            }

?>




<?php require "../footer.php"; ?>
<script type="text/javascript" src="../bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

</body>
</html>