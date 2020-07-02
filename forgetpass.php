<?php
include "navbar.php";
include "connect.php";
?>






<!DOCTYPE html>
<html>

<head>
  <title>Forget password</title>
   <link rel="icon" href="img/L1.jpeg">
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

 <!-- Page Specific Plugins -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>

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
<body  style='color: black;' >
  <br><br>  <br><br>  <br><br>  <br><br>
  <div class="container ">
  

<!-------------------------------Sending Email--------------------------------------------------->
<div class="row ">

          <div class="col-lg-12">
            <div class="panel panel-success ">
              <div class="panel-heading">
                <h3 class="panel-title">Forget password </h3>
              </div>
              <div class="panel-body">
                <div id="morris-chart-area"></div>

        <form class="login" action="#" method="POST">

        
         
          <div class="has-success">
            <label>Email</label>
              <input 
              type="email" 
              name="email" 
              class="form-control" 
              placeholder="Email" 
              required="required" 
             />
          </div>


          
     <!-- Modal footer -->
        <div class="modal-footer">
          <input type="submit" name="btnresetpass" class="btn btn-primary btn-block btn-lg"  value="Reset password">
         
        </div>
    </form>

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

<!---------------------------------------- start Rest Password------------------------------------------------>

  <?php 
  include "footers.php";
  ?>
   
</body>
</html>
<?php
if (isset($_POST['btnresetpass'])) 
{

  $to=$_POST['email'];
  $s_id='';
  $s_name='';
  $sql="SELECT * FROM staff_table WHERE staff_email='$to'";
  $result = mysqli_query($conn,$sql);
 if(mysqli_num_rows($result)==0)//Check User Before Send
  {
    echo '<script > swal( "Error" ,  "This User not in DB" ,  "error" );
    </script>';
  }
  else
  {

   while($row=mysqli_fetch_assoc($result))
        {
          $s_id=$row['staff_id'];
          $s_name = $row['staff_name'];
        } 

    $sub ="Reset Psasword in YULMS ";
    $msg='<html><head></head><body>';
    $msg.='
            <div class="table-responsive">
      <div class="panel panel-success">
              <div class="panel-heading">
             <center> <img src="img/L1.jpeg"  alt="" style="width: 7rem; height:7rem;"> </center>
              </div>
              <div class="panel-body">
                <div id="morris-chart-area"></div>
                <center>
                Welcome '.$s_name.' your email is '.$to.'. <br>
            If you want to reset your password click
            <a href="http://yulms.itcodeclub.com/resetpass.php?s_id='.$s_id.'">
          here
          </a>
        </center>
      </div> 
      </div>
      </div> 
      </body></html>
  
    ';
    $header[]="MIME-Version: 1.0";
    $header[]="Content-type:text/html; charset=iso-8859-1";
    $header[]= "From: YU LMS <yulms2020@gmail.com>";
    
 
  $mail=mail($to,$sub,$msg,implode("\r\n",$header));
  
   if ($mail) 
  {
    echo '<script >swal( "" ,  "Check your email " ,  "success" );</script>';
  }
  else
  {
    $err=mysqli_error($conn);
    echo '<script > swal( "Error" ,  "Try later !" ,  "error" );
   </script>';
  }

}


}

?>
<!---------------------------------------- End Rest Password------------------------------------------------>

