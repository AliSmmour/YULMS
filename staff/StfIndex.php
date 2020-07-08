<?php session_start();

include"connect.php";?>

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
    <!-- alert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.3.14/angular.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.0/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.0/sweetalert.min.css">


  </head>

  <body>




<?php
if ($_SESSION['msg']==1) {

   echo '<script> swal( "" ,  "Operation successfully!" ,  "success" ); </script>';
   $_SESSION['msg']=0 ;
  }elseif ($_SESSION['msg']==2) {
    $err= $_SESSION['err'] ;
echo ' <script> swal( "Error" ,  "'.$err.'" ,  "error" );  </script>';
   $_SESSION['msg']=0 ;
   $_SESSION['err']='';
 }


?>
<!-- Sidebar starttttttttttttttttttttt -->
     <?php include 'sidNav.php';?>
<!-- End  ddddddddddddddddd  Sidebar -->




      <div id="page-wrapper">

        <div class="row">
          <div class="col-lg-12">
            <h1>Dashboard <small>Statistics Overview</small></h1>
            <ol class="breadcrumb">
              <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
            </ol>
            <div class="alert alert-success alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              Welcome <?php echo $_SESSION['staff_user'];?>  <a class="alert-link" href="#">Start </a>
            </div>
           
          </div>
        </div><!-- /.row -->

        <div class="row">
          <div class="col-lg-4">
            <div class="panel panel-info">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-6">
                  </i><i class='fas fa-book style="font-size:48px;  fa-5x " '></i>
                  </div>
                  <div class="col-xs-6 text-right">
                    <p class="announcement-heading">
                      <?php
                       $staff_id=$_SESSION['staff_ID'];
                       $sql= "SELECT Distinct  count(course_id) FROM take_relation WHERE staff_id=$staff_id AND course_id in 
                       (SELECT course_id from course_table WHERE course_status=1)";
                        $result = mysqli_query($conn,$sql);
                        $row = mysqli_fetch_array($result); 
                        $quantity = $row[0];
                        echo $quantity;


                      ?>
                    </p>
                    <p class="announcement-text">Current Courses</p>
                  </div>
                </div>
              </div>
              <a href="CurrentCourses.php">
                <div class="panel-footer" style="color: #31708F;">
                  <div class="row">
                    <div class="col-xs-6">
                      View 
                    </div>
                    <div class="col-xs-6 text-right">
                      <i class="fa fa-arrow-circle-right"></i>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>
          
          <div class="col-lg-4">
            <div class="panel panel-danger">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-6">
                    <i class=" fas fa-chalkboard-teacher fa-5x"></i>
                  </div>
                  <div class="col-xs-6 text-right">
                    <p class="announcement-heading">      

                     <?php
                     $staff_id=$_SESSION['staff_ID'];
                        $sql= "SELECT COUNT(course_id) from course_table WHERE course_status=1 AND staff_id=$staff_id";
                        $result = mysqli_query($conn,$sql);
                        $row = mysqli_fetch_array($result); 
                        $quantity = $row[0];
                        echo $quantity;
                        ?>    
                   


                      </p>
                    <p class="announcement-text">Teached Courses</p>
                  </div>
                </div>
              </div>
              <a href="TeachedCourses.php">
                <div class="panel-footer" style="color: #A94442;">
                  <div class="row">
                    <div class="col-xs-6">
                      View 
                    </div>
                    <div class="col-xs-6 text-right">
                      <i class="fa fa-arrow-circle-right"></i>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="panel panel-warning">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-6">
                    <i class="fas fa-users fa-5x"></i>
                  </div>
                  <div class="col-xs-6 text-right">
                    <p class="announcement-heading">
                     
                        
                    <?php
                    $staff_id=$_SESSION['staff_ID'];
                    $sql= "SELECT DISTINCT count(tk.staff_id)
                      From staff_table stf , take_relation tk
                      WHERE stf.staff_id=tk.staff_id and course_id in 
                    (SELECT course_id FROM course_table WHERE staff_id=$staff_id and course_status=1)";
                    $result = mysqli_query($conn,$sql);
                    $row = mysqli_fetch_array($result); 
                    $quantity = $row[0];
                    echo $quantity;
                    ?>

                         
                    </p>
                    <p class="announcement-text">Number of Trainee</p>
                  </div>
                </div>
              </div>
              <a href="Trainee.php">
                <div class="panel-footer" style="color:#8A6D3B;">
                  <div class="row">
                    <div class="col-xs-6">
                      View 
                    </div>
                    <div class="col-xs-6 text-right">
                      <i class="fa fa-arrow-circle-right"></i>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>



          <!---------------------------------------------------------------------------->
            






          <!---------------------------------------------------------------------------->
 

        <div class="row" >
          <div class="col-lg-12">
            <div class="panel panel-success">
              <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> TRAFFIC</h3>
              </div>
              <div class="panel-body" >



    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      // Load Charts and the corechart and barchart packages.
      google.charts.load('current', {'packages':['corechart']});

      // Draw the pie chart and bar chart when Charts is loaded.
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
          ['Course As Trainee', 
           <?php
                        $sql= "SELECT Distinct  count(course_id) FROM take_relation WHERE staff_id=$staff_id AND course_id in 
                       (SELECT course_id from course_table WHERE course_status=1)";
                        $result = mysqli_query($conn,$sql);
                        $row = mysqli_fetch_array($result); 
                        $quantity = $row[0];
                        echo $quantity;
                        ?>
         ],
          
         
        ['Course As Trainer', 
        <?php 

         $sql= "SELECT COUNT(course_id) from course_table WHERE course_status=1 AND staff_id=$staff_id";
                        $result = mysqli_query($conn,$sql);
                        $row = mysqli_fetch_array($result); 
                        $quantity = $row[0];
                        echo $quantity;


        ?>],
        ['Trainee', 
        <?php 
         $staff_id=$_SESSION['staff_ID'];
         $sql= "SELECT COUNT(tk.staff_id) FROM staff_table stf,take_relation tk,course_table crs
          WHERE   stf.staff_id=tk.staff_id AND crs.course_id=tk.course_id AND tk.course_id IN 
         (SELECT course_id FROM course_table WHERE staff_id=$staff_id AND course_status=1)";
                        $result = mysqli_query($conn,$sql);
                        $row = mysqli_fetch_array($result); 
                        $quantity = $row[0];
                        echo $quantity;


        ?>],
         
         
      
         
        ]);
         
         

        var piechart_options = {title:'Pie Chart: How Much Course I Have in This Semster ',
                       width:550,
                       height:300};
        var piechart = new google.visualization.PieChart(document.getElementById('piechart_div'));
        piechart.draw(data, piechart_options);
        

         

        var barchart_options = {title:'Barchart: How Much Course I Have in This Semster',
                       width:550,
                       height:300,
                       legend: 'none'};
        var barchart = new google.visualization.BarChart(document.getElementById('barchart_div'));
        barchart.draw(data, barchart_options);
      }
</script>
<body>
    <!--Table and divs that hold the pie charts-->
    <table class="columns">
      <tr>
        <td><div id="piechart_div" ></div></td>
        <td><div id="barchart_div" ></div></td>
      </tr>
    </table>
  </body>
</html>
               











              <div id="morris-chart-area"></div>
              </div>
            </div>
          </div>
        </div><!-- /.row -->

</div>
</div>
</div>

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
