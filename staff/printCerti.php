<?php
session_start();
include"connect.php";
$cid=$_GET['c_id'];
$role=$_GET['role'];

$staff_id=$_SESSION['staff_ID'];

$course_name='';
$staff_name='';
$todate="Issued ".date("d M,Y");
$img_path = '' ;


$course= "SELECT course_name FROM course_table WHERE course_id =$cid";
$result_course = mysqli_query($conn,$course);
if (!$result_course)
{
		$_SESSION['err'] = mysqli_error($conn); 
	    $_SESSION['msg']=2 ; 
	    header('Location:PreviousCourses.php'); 
}else
{
	while ($row_course=mysqli_fetch_assoc($result_course))
	 {
		$course_name=$row_course['course_name'];
	 }

	 $staff= "SELECT staff_name FROM staff_table WHERE staff_id =$staff_id";
	$result_staff = mysqli_query($conn,$staff);
	if (!$result_staff)
	{
		$_SESSION['err'] = mysqli_error($conn); 
		 $_SESSION['msg']=2 ; 
	    header('Location:PreviousCourses.php'); 
	}else
{

	while ($row_staff=mysqli_fetch_assoc($result_staff))
	 {	  $staff_name=$row_staff['staff_name'];
		 if ($role==1)
	 	 {
      $img_path="img/TrainerCertificarte.jpg";
		 }
		 else
		 {
      $img_path="img/TraineeCertificarte.jpg";
		 }
	}

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

    <title>print Certificate </title>
    <link rel="icon" href="../img/L1.jpeg">
<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <!-- Page Specific CSS -->
    <link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.4.3.min.css">

<style>
	
	.date
	{
    position: absolute;
    color: black;
    left: 9cm;
    top: 1.6cm;
	}
	.name
	{
    position: absolute;
    color: black;
    left: 1.3cm;
    top: 4.6cm;
	}
	.course
	{
    position: absolute;
    color: black;
    left: 1.3cm;
    top: 6.1cm;
	}
.date {
    font-family: inherit;
}
 .name strong {
    font-family: inherit;
}
.course strong {
    font-family: inherit;
}


#certi
{
	position: relative;
		text-align: center;
		color: white;
		display: none;
		width: 100%;
		height: 100%;
}


</style>
	
<style type="text/css" media="print">
  @media print
  {
    /*Hide Element */
     .col-lg-12 , h1 , h2 , #remove , .section-padding{display: none;}
     /*Specific */
     #certi {width: 100%; display:block; height: 100%;}
    
  }
</style>
	
  </head>


  <body>


           <!-- Sidebar starttttttttttttttttttttt -->
             <?php include 'sidNav.php';?>
          <!-- End  ddddddddddddddddd  Sidebar -->
   <div id="page-wrapper">

        <div class="row">
          <div class="col-lg-12">
            <h1>Dashboard <small> Print Certificate </small></h1>
            <ol class="breadcrumb">
              <li class="active"><i class="fa fa-dashboard"></i> Print Certificate </li>
            </ol>
            <div class="alert alert-success alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              Welcome <?php echo $_SESSION['staff_user'];?> <a class="alert-link" href="#">Start </a>
            </div>
          </div>
</div><!-- /.row -->

        </div><!-- /#wrapper -->
<br><br> 


<h1 class="text-center"> Congratulations! </h1>
<h2 class="text-center"> Click here to print your certificate </h2>
<div id="certi">
<img class="box" src="<?php echo $img_path ;?>" width="100%"  alt="Cetificate" />
<div class="date"><h6> <?php echo $todate ;?> </h6></div>
<div class="name"><strong><h3><?php echo $staff_name; ?></h3></strong></div>
<div class="course"><strong><h3><?php echo $course_name; ?> </h3></strong></div>
	</div>
	<center>
		<button id="remove" type="button" class="btn btn-info" onclick="window.print();"><i class="fas fa-print"> Print Cerificate</i></button>
	</center>
	<br><br><br><br>

        
    </div>
    <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>

    <!-- Page Specific Plugins -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="http://cdn.oesmith.co.uk/morris-0.4.3.min.js"></script>
    <script src="js/morris/chart-data-morris.js"></script>
    <script src="js/tablesorter/jquery.tablesorter.js"></script>
    <script src="js/tablesorter/tables.js"></script>
<?php include "footers.php"; ?>
  </body>