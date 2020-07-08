<?php session_start();

?>

<?php 
include"connect.php";
function staff_info($conn)
{
  $sql="SELECT * FROM staff_table WHERE staff_id=".$_SESSION['staff_ID'].""; 

  $result=mysqli_query($conn,$sql);
  $output=' ';

  while($row=mysqli_fetch_assoc($result))
  {
    $output.= '<div >
        <label> Name</label>
        <input type="text" name="name" class="form-control" placeholder="Name" readonly="readonly" value="'.$row["staff_name"].'" />
        </div>
        
         
          <div >
            <label>Email</label>
              <input 
              type="email" 
              name="email" 
              class="form-control" 
              placeholder="Email" 
              readonly="readonly"
              value="'.$row["staff_email"].'"  
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
              value="'.$row["staff_password"].'"
              />
             </div>
             <input type="checkbox" onclick="myFunction()">Show Password

               <div class="has-success " id="cont_cpass">
            <label>Confirm Password </label>
              <input type="password" name="confirm_password" id="confirm_password"  onkeyup="check();" class="form-control" style="width: 97%; display: inline-block;" required="required" placeholder="Confirme Password" /> 
              <span id="message"></span>
             </div>


          <div class="has-success" id="cont-ph">
            <label>Phone</label>
              <input type="number" class="form-control" placeholder="07######## " name="phone" id="phone" value="'.$row["staff_phone_num"].'">
            
          </div>


          <div class="has-success">
            <label>Address </label>
              <input 
              type="text" name="address" class="form-control" placeholder="Address" list="city" required="required" value="'.$row["staff_address"].'"/>
              <datalist id="city" >
              <option value="Amman" />
              <option value="Irbid" />
              <option value="Aqaba" />
              <option value="Az-Zarqa" />
              <option value="Jerash" />
              <option value="Ajloun" />
              <option value="Madaba" />
              <option value="Al-Karak" />
              <option value="Al-Mafrak" />
              <option value="Al-Balqa" />
              <option value="Maan" />
              <option value="Al-Tafilah" />
          </datalist>
             </div>






          ';
  }
return $output ;
}

//*********BTN Updated*****************/
if(isset($_POST['btnEDIT']))
{


$password=$_POST['password'];
$phone=$_POST['phone'];
$address=$_POST['address'];
$sql="UPDATE 
     staff_table 
     SET staff_password='$password',staff_phone_num='$phone',staff_address='$address' 
     WHERE staff_id=".$_SESSION['staff_ID'].""; 


     $result=mysqli_query($conn,$sql);
     if ($result) 
     {

        echo '<script type="text/javascript">alert("Update has been Succesfll");</script>';
        $_SESSION['msg']=1 ; 
      header('Location:StfIndex.php'); 
      exit();
     }
     else
     {
          echo '<script type="text/javascript">alert("ERR: '.mysqli_error($conn).'");</script>';

     }
}



?>




<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard - SB Staff</title>
    <link rel="icon" href="../img/L1.png">
<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <!-- Page Specific CSS -->
    <link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.4.3.min.css">
  </head>
  <body>
<!-- Sidebar starttttttttttttttttttttt -->
     <?php include 'sidNav.php';?>
<!-- End  ddddddddddddddddd  Sidebar -->




          <!---------------------------------------------------------------------------->
            <style type="text/css">
    input::-webkit-outer-spin-button, /*to hide the arrow from input with type number */
  input::-webkit-inner-spin-button {
   -webkit-appearance: none;
   margin: 0;
}



  </style>
  <body>

           <!-- Sidebar starttttttttttttttttttttt -->
             <?php include 'sidNav.php';?>
          <!-- End  ddddddddddddddddd  Sidebar -->

  
      <center><div class="row"  style="margin-top: 10%; width: 80%; padding-left: 10%; padding-right: 10%">
          <div class="col-lg-12">
            <div class="panel panel-success">
              <div class="panel-heading">
                <h3 class="panel-title" align="left"><i class="far fa-id-card"></i> Profile</h3>
              </div>
              <div class="panel-body" align="left">
                <div id="morris-chart-area"></div>

  
          <div class="col-lg-12">
            <div class="table-responsive">
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

            <script>
    function checking ()
    { 
      var phone = document.getElementById("phone").value;
      var patt = phone.match(/07[7-9][0-9]{7}/);
      var pass =document.getElementById('password').value ;
      var cpass = document.getElementById('confirm_password').value ;
      var tpass = pass==cpass ;
      if (patt && tpass) 
      {
          return true ;
      }else{
        if (!patt)
        {
        alert("Invalid Phone Number ");
        document.getElementById("phone").focus();
        document.getElementById('cont-ph').className='has-error' ;        
        return false ; 
      }
      else if (!tpass)
      {
         alert("Password and Confirm password are not the same ");
        document.getElementById("password").focus();
        document.getElementById('cont_cpass').className='has-error' ;        
        document.getElementById('cont-ph').className='has-success' ;        
        return false ; 
      }
      } 
    }
  </script>
        <form class="login" action="#" method="post" onsubmit="return checking()">      

        <?php echo staff_info($conn) ; ?>

     <!-- Modal footer -->
        <div class="modal-footer">
          <input type="submit" name="btnEDIT" class="btn btn-success btn-lg btn-block"  value="Save changes">
         
        </div>

    </form>


            </div>
          </div>
        </div><!-- /.row -->
       </div><!-- /.row -->

</div>
</div> 
</center>


      </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->

     <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>

    <!-- Page Specific Plugins -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="http://cdn.oesmith.co.uk/morris-0.4.3.min.js"></script>
    <script src="js/morris/chart-data-morris.js"></script>
    <script src="js/tablesorter/jquery.tablesorter.js"></script>
    <script src="js/tablesorter/tables.js"></script>

  </body>
  <?php include "footers.php" ?>
</html>