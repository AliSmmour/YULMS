<?php
  $dsn = 'mysql:host=localhost;dbname=yulms_db';
  $user = 'root';
  $pass = '';
  $option = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
  );

  try {
    $con = new PDO($dsn, $user, $pass, $option);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }

  catch(PDOException $e) {
    echo 'Failed To Connect' . $e->getMessage();
  }
  ?>



<?php
 session_start();

$_SESSION['msg']=0 ;
$_SESSION['err']='' ; 
  if (isset($_SESSION['ID'])) {
    header('Location: admin/AdmIndex.php'); // Redirect To Dashboard Page
  }


  if (isset($_SESSION['staff_ID'])) {
    header('Location:staff/StfIndex.php');  // Redirect To Dashboard Page
  }


  // Check If User Coming From HTTP Post Request

  if ($_SERVER['REQUEST_METHOD'] == 'POST') 
  {
    if (isset($_POST['btnlogin']))
    {


    $username = $_POST['txtuser'];
    $password = $_POST['txtpass'];
    $hashedPass = sha1($password);
    
    // Check If The User Exist In Database

    $stmt = $con->prepare("SELECT 
                  *
                FROM 
                  admin_table 
                WHERE 
                  admin_email = '$username'
                AND 
                  admin_password = '$password'
               ");

    $stmt->execute(array($username, $password));
    $row = $stmt->fetch();
    $count = $stmt->rowCount();

    if ($count > 0)
    {
      $_SESSION['txtuser'] = $row['admin_name']; // Register Session Name
       $_SESSION['email'] = $row['admin_email'];;
      $_SESSION['ID'] = $row['admin_id']; // Register Session ID
      header('Location: admin/AdmIndex.php'); // Redirect To Dashboard admin Page
      exit();

  }else
  {
    $username = $_POST['txtuser'];
    $password = $_POST['txtpass'];
    $hashedPass = sha1($password);

    // Check If The User Exist In Database

    $stmt = $con->prepare("SELECT 
                  *
                FROM 
                  staff_table 
                WHERE 
                  staff_email = '$username'
                AND 
                  staff_password = '$password'
               ");

    $stmt->execute(array($username, $password));
    $row = $stmt->fetch();
    $count = $stmt->rowCount();
    if ($count > 0)
    {
      $_SESSION['staff_user'] = $row['staff_name']; // Register Session Name
       $_SESSION['staff_email'] = $row['staff_email'];;
      $_SESSION['staff_ID'] = $row['staff_id']; // Register Session ID
      header('Location:staff/StfIndex.php'); // Redirect To Dashboard Staff Page
      exit();
  }
  else
    {
        $_SESSION['Login_err']=1 ; 
      
        echo '<script type="text/javascript"> $(document).ready(function(){$("#login").modal("show");});</script>';
    }
} 

    // If Count > 0 This Mean The Database Contain Record About This Username
    //Set Cookies

    if ($count > 0) {

      if(isset($_POST['remumber'])){
        setcookie("username",$_POST['txtuser'],time()+3600);
        setcookie("password",$_POST['txtpass'],time()+3600) ;
      }else{ 
        setcookie("username",$_POST['txtuser'],time()-3600);
        setcookie("password",$_POST['txtpass'],time()-3600) ;
      }

     
    }

}
  }


  ?>


  





<style type="text/css">
  .navbar-inverse .navbar-nav>li>a:focus, .navbar-inverse .navbar-nav>li>a:hover {
    color: darkgray;
    background-color: transparent;
}
</style>





   
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  
             
                  
          
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" style="font-family: 'Do Hyeon', sans-serif;" href="index.php">

                 <img src="img/L4.png"  alt="" style="height: 5rem; width: 5rem;">
                 <span>YU LMS </span>
                    </a>

           
                    
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav navbar-right navbar-user">
          <li><a href="index.php">       <i class='fas fa-home'></i> Home</a></li>
          <li><a href="connectus.php">     <i class="fas fa-address-book"> Contact Us</i>  </a></li>
          <li><a href="Aboutus.php">     <i class='fas fa-info'>  About Us</i>  </a></li>


          
        
         
          <li>
          <button style="margin-top: 8px;" type="button" class="btn btn-info" data-toggle="modal" data-target="#login"> Sign in</button>
          </li>





              


              <li class="dropdown user-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-user">
              </i>
              </a>


                

            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </nav>




<!-- Modallllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllll login  -->
<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Sign in</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <div class="">
    <form class="login" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">

      <?php
      if (isset($_SESSION['Login_err'])){
        if ($_SESSION['Login_err']==1 )
        {
      ?>
      <div class="alert alert-danger alert-dismissable" >
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              Invalid Username or password ! 
            </div>
     <?php }$_SESSION['Login_err']=0;}  ?>
     
      <label>Username</label>
      <input type="text" name="txtuser" placeholder="Please Enter UserName" autofocus="on" class="form-control"  ><br/>
     
     
      <label>Password</label>
      <input type="Password" name="txtpass" id="pass" placeholder="Please Enter Password"class="form-control"
      >
    
    <!--Show Password-->
    <input type="checkbox" onclick="myFunction()">Show Password
            <script type="text/javascript">
              function myFunction() {
                  var x = document.getElementById("pass");
                 if (x.type === "password") {
                  x.type = "text";
                  } else {
                   x.type = "password";
                 }
                    }
            </script>
            

 
  <br>

     <!-- Modal footer -->
        <div  style="text-align:center; " class="modal-footer">


          <br>
           <a href="forgetpass.php"> Forget password ? </a> 
           <br>




           
          <input style="margin-top: 10px;"  type="submit" name="btnlogin" value="sign in" class="btn btn-info btn-lg btn-block" >
          Create New <a href="Register.php">Account
          </button></a> 
         
        </div>
    </form>

    </div>
      </div> 
    </div>
  </div>
</div>

    <!-- end Modallllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllll login  -->

