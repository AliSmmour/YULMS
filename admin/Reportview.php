<?php session_start();
include"connect.php";?>

<?php


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
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Reports</title>
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

   <style type="text/css">
    .options {
    
    position:absolute;
    top:100%;
    right:0;
    left:0;
    z-index:999;
    margin:0 0;
    padding:0 0;
    list-style:none;
    border:1px solid #ccc;
    font-weight: bolder;
    color: black;
    -webkit-box-shadow:0 1px 2px rgba(0, 0, 0, 0.2);
    -moz-box-shadow:0 1px 2px rgba(0, 0, 0, 0.2);
    box-shadow:0 1px 2px rgba(0, 0, 0, 0.2);
}



   </style>

  </head>

  <body>

           <!-- Sidebar starttttttttttttttttttttt -->
             <?php include 'sidNav.php';?>
          <!-- End  ddddddddddddddddd  Sidebar -->
  

      
      <div id="page-wrapper">

        <div class="row remove">
          <div class="col-lg-12">
            <h1>Dashboard <small>Report View</small></h1>
            <ol class="breadcrumb">
              <li class="active"><i class="fa fa-dashboard"></i>  Report Information </li>
            </ol>
            <div class="alert alert-success alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              Welcome Admin  <a class="alert-link" href="#">Start </a>
            </div>
          </div>
        </div><!-- /.row -->

 <!-- Fetch Stafssssssssssssssssssssssssssssssssssssssss-->

        <div class="row">
          <div class="col-lg-12">
            
        </div><!-- /.row -->
               <div class="has-success remove">
            <label>Main Topic </label>
              <SELECT  name="main" class="form-control"  id="main" required="required">
                  <<option class="options" selected="selected" disabled="true"> Choose the main topic</option>
                  <option  value="crs"> Courses</option>
                  <option value="user"> Useres </option>
                  <option class="options" disabled="true"> Choose Faculty</option>
                    <?php echo faculty_list($conn);?>

             </SELECT>
             </div>

             <div class="has-success remove">
            <label>Sub Topic</label>
              <SELECT  name="sub" class="form-control" id="sub" required="required">
                <option selected="selected" disabled="true">Choose Sub topic</option>
             </SELECT>
             </div>
             <br>
             <div>
          <input id="btnCreate" name="btnCreate" class="btn btn-info btn-lg btn-block remove"  value="Create" >
           </div> 


          <br>

<style type="text/css" media="print">
  @media print
  {
    /*Hide Element */
    .remove,.bottom {display: none;}
    /*Specifics */
    #result {font-size: 12pt  ;width: 100% ; height: 100%; display: block;}
    .modal-content ,div ,.table-responsive{ border: none; overflow: hidden; }
    h3{color:white !important; font-size: 16pt; } 
    .panel-success > .panel-heading { background-color: #339966 !important; }
  }
</style>

          <div class="panel panel-success" style="display: none;" id="result">
              <div class="panel-heading">
                <h3 class="panel-title"></i> Report </h3>
              </div>
              <div class="panel-body">
                <div>
                 <button type="button" class="btn btn-info remove" onclick="window.print();"><i class="fas fa-print"> Print</i></button> 
               </div><br>
                <div id="morris-chart-area"></div>
            <div class="table-responsive"> 
              <table class="table table-bordered table-hover table-striped tablesorter"id="table">
              </table>
            </div>
          </div>
        </div><!-- /.row -->


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
<?php include "footers.php"; ?>
  </body>






</html>

<script>
    $(document).ready(function(){
        $('#main').change(function(){
            var opt = $(this).val() ;
            $.ajax({

                url:"load_sub.php", 
                method:"POST",
                data:{opt:opt},
                success:function(data){
                    $('#sub').html(data);
                }
            });

        });
    });
</script>


<script>
  $(document).ready(function(){
    $('#btnCreate').click(function(){
      var Mopt=$('#main').val() ;
      var Sopt = $('#sub').val() ; 
      $('#result').css('display','block') ;
      $.ajax({
          url:"load_table.php",
          method:"POST",
          data:{Sopt:Sopt,Mopt:Mopt},
          success:function(data){
            $('#table').html(data) ;
          }
        });
      });
    });
</script>