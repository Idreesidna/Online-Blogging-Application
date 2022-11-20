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
	<title>Search</title>
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
</head>
<body>

<?php  
require_once 'nav_user.php';
?>

<br><br><br><br>
<div class="container my-2">
  <div class="row">
    <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-8 col-sm-12">
      <div style="margin-bottom: 100px" class="card">
        <div  class="card-header bg-danger text-white">
          Search By Date
        </div>
        <?php echo $_GET['message']??"";?>

        <div class="card-body">
         
 					 <form method="POST" action="search_process.php" enctype="multipart/form-data">
  						<div class="form-row">
 						   <div class="form-group">
					      <label for="inputEmail4">Date</label>
					      <input type="date" class="form-control" id="inputEmail4" name="month" placeholder="Email" required="">
    						</div>

							  <button type="submit" class="btn btn-primary my-2" name="submit">Search</button>

					</form>
      			</div>
   			 </div>
    	</div>
  	</div>
</form>
</div>
</div>
</div>  

<?php require_once("../footer.php"); ?>

</div>
<script type="text/javascript" src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>