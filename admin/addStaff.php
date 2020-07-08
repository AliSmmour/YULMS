<?php


session_start();
include "connect.php";


//------------------------------------featching Faculty Name---------------------------------------------------//


function faculty_list($conn)
  {
    $output ='';
    $sql = "SELECT * FROM `faculty_table`WHERE f_id !=0";
    $res = mysqli_query($conn,$sql) ; 
     while ($row=mysqli_fetch_assoc($res))
     {
        $output.='<option value="'.$row["f_id"].'">'.$row["bld_name"].'</option>' ;  
     }

     return $output ;
  }


?>






<!DOCTYPE html>
<html>

<head>
  <title>Create New Account</title>
  <link rel="icon" href="../img/L1.png">
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
<!----------------------------------Checking Before Submit------------------------------------------->
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
       swal( "Error" , "Invalid phone number" ,  "error" );
        document.getElementById("phone").focus();
        document.getElementById('cont-ph').className='has-error' ;        
        return false ; 
      }
      else if (!tpass)
      {
        swal("Error" ,"Password and Confirm password are not the same ",  "error");
        document.getElementById("password").focus();
        document.getElementById('cont_cpass').className='has-error' ;        
        document.getElementById('cont-ph').className='has-success' ;        
        return false ; 
      }
      } 
    }
  </script>

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
                <h3 class="panel-title"><i class="fas fa-user-plus" ></i> Add New Staff </h3>
              </div>
              <div class="panel-body">
                <div id="morris-chart-area"></div>


          

        <form class="login" action="#" method="post" onsubmit="return checking()">
        <div class="has-success">
        <label> Name</label>
        <input type="text" name="name" class="form-control" placeholder="Staff Name" required="required" />
        </div>
        
         
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
          
        
          <div class="has-success">
            <label>Password </label>
              <input 
              type="password" 
              name="password" 
              class="form-control" 
              id="password" 
              placeholder="Password" 
               required="required" 
              minlength="8" 
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

          
          <div class="has-success" id="cont-ph">
            <label>Phone</label>
              <input type="number" class="form-control" placeholder="07[7,8,9]####### " name="phone" id="phone"  required="required" >
            
          </div>

          <div >
            <label>Male</label>
              <input 
              type="radio" 
              name="gender"
              value="M"  
              required="required" />
            
            <label>Female</label>
              <input 
              type="radio" 
              name="gender"
              value="F" 
              required="required" />
            
          </div>



          <div class="has-success">
            <label>Address </label>
              <input 
              type="text" name="address" class="form-control" placeholder="Address" list="city" required="required" />
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



          <div class="has-success">
            <label>Faculty</label>
              <SELECT  name="faculty" class="form-control" placeholder="Faculty" >
                <option selected="selected" value="0">Faculty</option>
                <?php echo faculty_list($conn);?>  
             </SELECT>
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
  $Name=$_POST['name'];
  $Email=$_POST['email'];
  $Password=$_POST['password'];
  $Phone=$_POST['phone'];
  $Gender=$_POST['gender'];
  $Address=$_POST['address'];
  $Faculty=$_POST['faculty'];

  $sql="INSERT INTO `staff_table` (`staff_name`, `staff_email`, `staff_password`, `staff_address`, `staff_gender`, `staff_phone_num`, `f_id`) 
  VALUES ('$Name', '$Email', '$Password','$Address', '$Gender','$Phone', '$Faculty');";
  $result=mysqli_query($conn,$sql);
  if ($result) 
  {
    echo '<script> swal( "" ,  "Add successfully!" ,  "success" ); </script>';
  }else
  {
    $err=mysqli_error($conn);

  echo ' <script> swal( "Error" ,  "'.$err.'" ,  "error" );  </script>';
  }

}
mysqli_close($conn);
?>