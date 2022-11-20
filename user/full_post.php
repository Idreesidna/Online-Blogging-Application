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
 	<title> Full Post </title>
 	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
 </head>
 <body>
 <?php require "nav_user.php"; ?>
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
                  <div>
                  <input type="hidden" id="post_id" value="<?php echo $_REQUEST['post_id']?>">
                  <input type="hidden" id="user_id" value="<?php echo $_SESSION['user']['user_id']??"";?>">
                  <input type="hidden" id="first_name" value="<?php echo $_SESSION['user']['first_name']??"";?>">
                  <input type="text-white" id="comment_text" placeholder="comment" >
                  <button onclick="send_comment()">send</button>
                  </div>
                  </div>
                  <div class="card-footer">
                    <small class="text-muted"> <?php echo $data['created_at']; ?> </small>
                  </div>
                </div>
              </div>
            
      </div>










<?php
}

?>
<script>
      var set_interval_message = null;

      view_comment();

  
      function view_comment(){
             var post_id=document.getElementById('post_id').value;
 
        // alert("Interval");
        var ajax_request = null;
        if(window.XMLHttpRequest){
          ajax_request = new XMLHttpRequest();
        }
        else{
          ajax_request = new ActiveXObject("Microsoft.XMLHTTP")
        }

        ajax_request.onreadystatechange = function(){
          if(this.readyState == 4 && this.status == 200){
            // alert(this.responseText);
            document.getElementById("view_comment").innerHTML = this.responseText;
          }
        }

        ajax_request.open("GET","comment_processing.php?action=view_comment&post_id="+post_id);
        ajax_request.send();
      }


 function send_comment(){
             var post_id=document.getElementById('post_id').value;
          var first_name=document.getElementById('first_name').value;
          var user_id=document.getElementById('user_id').value;
         var comment_text = document.getElementById('comment_text').value;
        
        var ajax_request = null;
        if(window.XMLHttpRequest){
          ajax_request = new XMLHttpRequest();
        }
        else{
          ajax_request = new ActiveXObject("Microsoft.XMLHTTP")
        }

        ajax_request.onreadystatechange = function(){
          if(this.readyState == 4 && this.status == 200){
            // alert(this.responseText);
            document.getElementById("comment_text").value = "";
             }
            view_comment();
        }

        ajax_request.open("POST","comment_processing.php");
        ajax_request.setRequestHeader("content-type","application/x-www-form-urlencoded");
        ajax_request.send("action=send_comment&comment_text="+comment_text+"&post_id="+post_id+"&user_id="+user_id+"&first_name="+first_name);
      }
       // set_interval_message = setInterval(view_comment,1000);
     // set_interval_user = setInterval(show_users,1000);

</script>



<?php require "../footer.php"; ?>
<script type="text/javascript" src="../bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

 </body>
 </html>