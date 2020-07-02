
<?php 
include "connect.php";


?>

<!DOCTYPE html>
<html>
<head>
  <title>Contact US</title>
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

      <!-- alert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.3.14/angular.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.0/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.0/sweetalert.min.css">
   
   <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>


</head>
<boody styel="color:white;">

        <!-- NaVBARRRRRRRRRRRRRRRRRRRRRRRRRRRRRRR -->
 <?php include "navbar.php" ?>


<?php
if (isset($_POST['btnSent']))
{ 

$to="yulms2020@gmail.com";
$sub=$_POST['subject'];
$msg=$_POST['msg'];
$from=$_POST['from'];
$header= "From: $from";
$result= mail($to, $sub, $msg,$header);
   if ($result)
   {
      echo "<script> swal('','The message has been sent','success') ; </script>"; 

   }else
   {
    echo "<script>swal('Error','Try later !','error') ;</script>";    
   }
}
?>
  
<!--contct us ------------------------------------------------------------------------------->

  

<!--contct us ----------------------------------------------->

<style type="text/css">
h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 {
  color: #ffff;

  }

#contatti{
  background-color: #2C523E;
  letter-spacing: 2px;
  padding-top: 50px;


  }
#contatti a{
  color: #ffff;
  text-decoration: none;
}


@media (max-width: 575.98px) {

  #contatti{padding-bottom: 800px;}
  #contatti .maps iframe{
    width: 100%;
    height: 450px;
  }
 }


@media (min-width: 576px) {

   #contatti{padding-bottom: 800px;}

   #contatti .maps iframe{
     width: 100%;
     height: 450px;
   }
 }

@media (min-width: 768px) {

  #contatti{padding-bottom: 350px;}

  #contatti .maps iframe{
    width: 100%;
    height: 850px;
  }
}

@media (min-width: 992px) {
  #contatti{padding-bottom: 200px;}

   #contatti .maps iframe{
     width: 100%;
     height: 700px;
   }
}


#author a{
  color: #ffff;
  text-decoration: none;
    
}
</style>

        <!--/ccontaccccccccccccccccccccccccccccccccccccccccccccccccccct USSSSSSSSSSSSSSSSSSSSSs-->
<div class="row" id="contatti">
<div class="container mt-5" >

    <div class="row" style="height:550px;">
  <div class="col-md-6 maps" >
<iframe src="https://maps.google.com/maps?width=100%&amp;height=600&amp;hl=en&amp;q=yarmouk%20Univesity+(YU)&amp;ie=UTF8&amp;t=&amp;z=22&amp;iwloc=B&amp;output=embed" width="600" height="450" frameborder="0" style="border:0" allowfullscreen>
</iframe>
      </div>
      <div class="col-md-6">
        <h2 class="text-uppercase mt-3 font-weight-bold text-white">Contuct US</h2>

        <form action="#" method="POST"  style="  margin: 20px;">
          <div class="row">

            
            <div class="col-lg-12">
              <div class="form-group">
                <input type="email" name="from" class="form-control mt-2" placeholder="From " required>
              </div>
            </div>

            <div class="col-lg-12">
              <div class="form-group">
                <input type="text" name="subject" class="form-control mt-2" placeholder="Subject" required>
              </div>
            </div>

            <div class="col-12">
              <div class="form-group">
                <textarea name="msg" class="form-control" id="exampleFormControlTextarea1" placeholder="Write here" rows="3" required></textarea>
              </div>
            </div>
        
            <div class="col-12">
               <button name='btnSent' class='btn btn-block btn-primary btn-lg'type="submit"><i class='fas fa-paper-plane'></i>
                      Send  </button>
            </div>
          </div>
        </form>

        <div class="text-white">
        <h2 class="text-uppercase mt-4 font-weight-bold">For Contuct</h2>

      
        <i class="fas fa-phone mt-3"></i> <a href="tel:+">(+962) 123456</a><br>
        <i class="fa fa-envelope mt-3"></i> <a href="mailto:yulms2020@gmail.com">YULMS2020@gmail.com</a><br>
        <i class="fas fa-globe mt-3"></i>YU-Jordan<br>
        <div class="my-4">
        <a href=""><i class="fab fa-facebook fa-3x pr-4"></i></a>
      
        </div>
        </div>
      </div>

    </div>
</div>
</div>



</div>



  <!--EMD contct us ------------------------------------------------------------------------------->


    <!-- Page Specific Plugins -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="http://cdn.oesmith.co.uk/morris-0.4.3.min.js"></script>
    <script src="js/morris/chart-data-morris.js"></script>
    <script src="js/tablesorter/jquery.tablesorter.js"></script>
    <script src="js/tablesorter/tables.js"></script>


<?php include "footers.php" ?>


</body>
</html>
