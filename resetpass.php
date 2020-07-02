<?php
include "navbar.php";
include "connect.php";

$sid=$_GET['s_id'];
$s_email='';
  $sql="SELECT staff_email FROM staff_table WHERE staff_id='$sid'"; 
  $result=mysqli_query($conn,$sql);
  while($row=mysqli_fetch_assoc($result))
  {
    $s_email = $row['staff_email'];
  }


?>
<!DOCTYPE html>
<html>

<head>
  <title>Reset password</title>
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

</head>
<body  style='color: black;' >
  <br><br>  <br><br>  <br><br>  <br><br>
  <div class="container ">
  

<div class="row ">


          <div class="col-lg-12">
            <div class="panel panel-success ">
              <div class="panel-heading">
                <h3 class="panel-title">Reset password </h3>
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
              readonly="readonly"
              value="<?php echo $s_email;?>" 
              />
          </div>

           <div class="has-success">
            <label>Password </label>
              <input 
              type="password" 
              name="password" 
              class="form-control" 
              id="password" 
              placeholder="Password" 
              required="required" 

              
              />
             </div>
             <input type="checkbox" onclick="myFunction()">Show Password
            <script type="text/javascript">
              function myFunction() {
                  var x = document.getElementById("password");
                 if (x.type === "password") {
                  x.type = "text";
                  } else {
                   x.type = "password";
                 }
                    }
            </script>
            <div class="has-success " id="cont_cpass">
            <label>Confirm Password </label>
              <input type="password" name="confirm_password" id="confirm_password"  onkeyup='check();' class="form-control" style="width: 98.3%; display: inline-block;" required="required" placeholder="Confirme Password" /> 
              <span id='message'></span>
             </div>

             <script type="text/javascript">//To Check password and conformed password
               var check = function() {
              if (document.getElementById('password').value ==document.getElementById('confirm_password').value) {
                     document.getElementById('message').style.color = 'green';
                      document.getElementById('message').innerHTML = '<i class="fas fa-check-circle"></i>';
                      document.getElementById('cont_cpass').className='has-success' ;
                     } else {
                    document.getElementById('message').style.color = 'red';
                    document.getElementById('message').innerHTML = '<i class="fas fa-times-circle"></i>';
                    document.getElementById('cont_cpass').className='has-error' ;
            }
          }
             </script>

          
     <!-- Modal footer -->
        <div class="modal-footer">
          <input type="submit" name="btnrestpass" class="btn btn-primary btn-block btn-lg"  value="Reset Password">
         
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
if (isset($_POST['btnrestpass'])) 
{ 
  $Email=$_POST['email'];
  $pass=$_POST['password'];
  $sql = "UPDATE staff_table SET staff_password='$pass' WHERE staff_email='$Email';";
  $result = mysqli_query($conn,$sql);
   if ($result) 
  {
    echo '<script >swal( "" ,  "Reset successfuly " ,  "success" );</script>';
  }
  else
  {
    $err=mysqli_error($conn);
    echo '<script > swal( "Error" ,  "'.mysql_error($conn).'" ,  "error" );
   </script>';
  }

}




?>
<!---------------------------------------- End Rest Password------------------------------------------------>