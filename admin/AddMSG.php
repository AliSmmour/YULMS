<?php


session_start();
include "connect.php";

?>






<!DOCTYPE html>
<html>

<head>
  <title>Write New Message</title>
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <!-- Page Specific CSS -->
    <link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.4.3.min.css">
   <link rel="stylesheet" type="text/css" href="css/control.css">
   <link rel="stylesheet" type="text/css" href="css/loading.css">

    <!-- alert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.3.14/angular.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.0/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.0/sweetalert.min.css">


<style type="text/css">
    input::-webkit-outer-spin-button, /*to hide the arrow from input with type number */
  input::-webkit-inner-spin-button {
   -webkit-appearance: none;
   margin: 0;
}



  </style>
</head>
<body >
  <?php include "sidNav.php";?>

  <div class="container">
    <br><br>

<div id="page-wrapper">

        <div class="row">
          <div class="col-lg-12">
           
            <div class="alert alert-success alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              Welcome Admin  <a class="alert-link" href="#">Start </a>
            </div>
          </div>
        </div><!-- /.row -->


<!-------------------------------Form Registerd--------------------------------------------------->
 <div class="row">

          <div class="col-lg-12">
            <div class="panel panel-success">
              <div class="panel-heading">
                <h3 class="panel-title"><i class="fas fa-envelope-open" ></i> Add New Message </h3>
              </div>
              <div class="panel-body">
                <div id="morris-chart-area"></div>


          

        <form class="login" action="#" method="post">
          <div class="has-success">
            <label>Message Text</label>
              <textarea class =" form-control" name="msg_txt" required="required" placeholder="Write your Message Hear"></textarea>
             </div>

            <div class="has-success">
            <label>Message Link</label>
              <textarea class="form-control" name="msg_link" required="required" placeholder="Link Message"></textarea>   
             </div>



     <!-- Modal footer -->
        <div class="modal-footer">
          <input type="submit" name="btnAdd" class="btn btn-info btn-lg btn-block"  value="Save">
         
        </div>
    </form>

  </div>
</div>
</div>
</div>
</div>
</div>
</div>
  <br /><br /><br /><br/><br/>
  <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>

    <!-- Page Specific Plugins -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="http://cdn.oesmith.co.uk/morris-0.4.3.min.js"></script>
    <script src="js/morris/chart-data-morris.js"></script>
    <script src="js/tablesorter/jquery.tablesorter.js"></script>
    <script src="js/tablesorter/tables.js"></script>
    <script src="js/toTop.js"></script>



  
   <?php 
  include "footers.php";
 
  ?>

</body>
</html>

<?php
if (isset($_POST['btnAdd']))
{
  $msg_txt=$_POST['msg_txt'];
  $msg_link=$_POST['msg_link'];
  $admin_id_msg=$_SESSION['ID'];
  
  $sql="INSERT INTO `message_table` (`msg_text`, `msg_link`, `admin_id`) 
  VALUES ('$msg_txt', '$msg_link', '$admin_id_msg');";
  $result=mysqli_query($conn,$sql);
   if ($result) 
  {
    echo '<script> swal( "" ,  "Send successfully!" ,  "success" ); </script>';
  }else
  {
    $err=mysqli_error($conn);

  echo ' <script> swal( "Error" ,  "'.$err.'" ,  "error" );  </script>';
  }

}
 mysqli_close($conn);
?>