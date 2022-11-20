<?php 
require 'connection.php';



 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title> Full Post </title>
 	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">

<style type="text/css">
  
h1 {
  text-align: center;
  font-family: Tahoma, Arial, sans-serif;
  color: #06D85F;
  margin: 50px 0;
}
/*
.box {
  width: 5%;
  margin: 0 auto;
  background: gray;
  padding: 35px;
  border: 2px solid #fff;
  border-radius: 20px/50px;
  /background-clip: padding-box;/
  text-align: center;
}
*/
.button {
  font-size: 1em;
  padding: 10px;
  color: #fff;
  border: 2px solid #06D85F;
  border-radius: 20px/50px;
  text-decoration: none;
  cursor: pointer;
  transition: all 0.3s ease-out;
}
/*.button:hover {
  background: #06D85F;
}
*/
.overlay {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background: rgba(0, 0, 0, 0.7);
  transition: opacity 500ms;
  visibility: hidden;
  opacity: 0;
}
.overlay:target {
  visibility: visible;
  opacity: 1;
}

.popup {
  margin: 70px auto;
  padding: 20px;
  background: #fff;
  border-radius: 5px;
  width: 30%;
  position: relative;
  transition: all 5s ease-in-out;
}

.popup h2 {
  margin-top: 0;
  color: #333;
  font-family: Tahoma, Arial, sans-serif;
}
.popup .close {
  position: absolute;
  top: 20px;
  right: 30px;
  transition: all 200ms;
  font-size: 30px;
  font-weight: bold;
  text-decoration: none;
  color: #333;
}
.popup .close:hover {
  color: #06D85F;
}
.popup .content {
  max-height: 30%;
  overflow: auto;
}

@media screen and (max-width: 700px){
  .box{
    width: 70%;
  }
  .popup{
    width: 70%;
  }
}

</style>

 </head>
 <body>
 <?php require "nav_visitor.php"; ?>
<br><br><br>
<?php 
if (isset($_REQUEST['post_id'])) {
	$post_id=$_REQUEST['post_id'];
$select="SELECT * FROM post WHERE post_id= '".$post_id."' ";
$query=mysqli_query($connection,$select);
$data=mysqli_fetch_assoc($query);
?>	


<div class="container mt-5 mb-5  " id="xyz">
<center>
<hr style="width:100px; height:4px;color:darkcyan;" class="mb-3">
<br>

	              <div class="col-sm-3">
                <div class="card">
                  <img src="../admin/featured_image/<?php echo $data['featured_image']; ?>" class="card-img-top" alt="...">
                  <div class="card-body">
                  
                    <h5 class="card-title"> <b><?php echo $data['post_title']; ?> </b></h5>
                    <hr>
                    <h5> Summary </h5>
                    <p class="card-text"><?php echo $data['post_summary']; ?>
                    <hr>
                    <h5> Description </h5>
                    <p class="card-text"> <?php echo $data['post_description'];  ?> </p>
                    <hr>
                  <div id="view_comment"></div>
  <input type="text" name="comment">
      <br><br>
                  <div>
               <div class="box">
  <a class="button" href="#popup1">SEND</a>
</div>

<div id="popup1" class="overlay">
  <div class="popup">
    <h1 style="background-color: brown;">Please Login First</h1>
    <a class="close" href="#">&times;</a>
    <div class="content">
     <a href="Login.php">login now</a>
    </div>
  </div>
    </div>
   </div>
   
                  </div>
                  <div class="card-footer">
                    <small class="text-muted"> <?php echo $data['created_at']; ?> </small>
                  </div>
                </div>
              </div>
            
      </div>




<script type="text/javascript">
  
  function prompt (){
    alert("Please Login First");
  }


</script>



<?php
}

?>


<?php require "footer.php"; ?>
<script type="text/javascript" src="bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

 </body>
 </html>