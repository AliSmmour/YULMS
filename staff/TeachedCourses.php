<?php session_start();

include"connect.php";?>



<?php 

function course_info($conn)
{
$staff_id=$_SESSION['staff_ID'];
$table='';
$records="SELECT crs.course_id,course_name,course_time,course_date,material_link,bld_name,loc.room_id
          FROM teach_in_relation tr,course_table crs,faculty_table fac,location_table loc
          WHERE crs.course_id=tr.course_id AND loc.room_id=tr.room_id AND loc.f_id=fac.f_id AND course_status=1 and staff_id=$staff_id
          ORDER BY course_id desc";


$serv=$_SERVER['PHP_SELF'];
$result = mysqli_query($conn,$records);
$c = 1; 
if(mysqli_num_rows($result)>0)
{
while($row=mysqli_fetch_assoc($result))
{
  $c_id=$row['course_id'];

  $table.="<tr>";
  $table.= "<td>".$c." </td>";
  $table.= "<td>".$row['course_name']." </td>";
  $table.= "<td>".$row['course_time']." </td>";
  $table.= "<td>".$row['course_date']." </td>";
  $table.= "<td> <a href='".$row['material_link']."'> ".$row['material_link']." </td>";
  $table.= "<td>".$row['bld_name']."_".$row['room_id']."</td>";
  $table.= "<td>

     <!-- Button trigger modal -->
          <button name='edit' id='$c_id' class='btn btn-success edit_data_btn' style='width:48%;'><i class='fas fa-edit'></i>
         Edit
        </button>


        <button name='view' id='$c_id' class='btn btn-info view_data_btn' style='width:48%;'><i class='fas fa-eye'></i>
         View
        </button>

                  </td>
                 </tr>";

                 $c++;
 

}}
return $table;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Teached Courses </title>
    <link rel="icon" href="../img/L1.jpeg">
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
            <h1>Dashboard <small>Teached Course View</small></h1>
            <ol class="breadcrumb">
              <li class="active"><i class="fa fa-dashboard"></i> Teached Course Information </li>
            </ol>
            <div class="alert alert-success alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              Welcome <?php echo $_SESSION['staff_user'];?> <a class="alert-link" href="#">Start </a>
            </div>
          </div>
        </div><!-- /.row -->

 <!-- Fetch Stafssssssssssssssssssssssssssssssssssssssss-->

        <div class="row">

          <div class="col-lg-12">
            <div class="panel panel-success">
              <div class="panel-heading">
                <h3 class="panel-title"><i class="fas fa-chalkboard-teacher"></i> Teached Course</h3>
              </div>
              <div class="panel-body">
                <div id="morris-chart-area"></div>


          <div class="col-lg-12">
            <h2>View Teached Course</h2>
            </div>
            <div class="table-responsive">
              <div class="form-group has-success"> <label for="exampleInputEmail1">Search here </label> <input id="searchdata" type="text" name="searchdata" class="form-control " autocomplete="off" autofocus="autofocus">
                <br>
              <table class="table table-bordered table-hover table-striped tablesorter">
                <thead>
                  <tr>
                    <th>#</th>

                    <th>Course</th>

                    <th>Time</th>
            
                    <th>Date</th>

                    <th>Material Link</th>

                    <th>Location</th>

                    <th>Action</th>


                  </tr>
                </thead>
                <tbody id="table"> <?php echo course_info($conn); ?> </tbody>
              </table>
            </div>
          </div>
        </div><!-- /.row -->



 
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
<?php include "footers.php"; ?>
  </body>




  <script>
    $(document).ready(function(){
        $('#searchdata').keyup(function(){
            var search_key = $(this).val() ;
            $.ajax({

                url:"load_search_teachedcourse.php", 
                method:"POST",
                data:{search_key:search_key},
                success:function(data){
                    $('#table').html(data);
                }
            });

        });
    });
</script>




</html>

<!-- view Modal -->
<style type="text/css" media="print">
  @media print
  {
    /*Hide Element */
    .row , .modal-footer , #remove {display: none;}
    /*Specifics */
    .modal-body {font-size: 16pt  ;width: 100% ; height: 100%;}
    .panel-success > .panel-heading { background-color: #339966 !important; }
    a { color:blue !important; padding: 0; }
    #view ,.modal-content ,div ,.table-responsive { border: none; overflow: hidden; }    
  }
</style>



 <div id="view" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header" id="remove">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Course Details</h4>  
                </div>  
                <div class="modal-body" id="course_detail">  
                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-info btn-lg btn-block" onclick="window.print();"><i class="fas fa-print"> Print</i></button>  
                </div>  
           </div>  
      </div>  
 </div>  



 <script>
    $(document).ready(function(){
         $(document).on('click', '.view_data_btn', function(){  
           var course_id = $(this).attr("id");  
           if(course_id != '')  
           {  
                $.ajax({  
                     url:"view_selected_teachedcourse.php",  
                     method:"POST",  
                     data:{course_id:course_id},  
                     success:function(data){  
                          $('#course_detail').html(data);  
                          $('#view').modal('show');  
                     }  
                });  
           }            
      });  
    });
</script>



<!-- end view modal-->


<!--Edit modal-->


 <div id="edit" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Edit Course Information </h4>  
                </div>  
                <div class="modal-body" id="course_detail">
                  <form action="teachedcourse_save_changes.php" method="post">
                    <div id="edit_form">
                    </div><br>
                     <input type="submit" name="edit_btn" value="Save Changes" class="btn btn-success btn-lg btn-block">
                  </form>
                </div>  
                <div class="modal-footer">  
                </div>  
           </div>  
      </div>  
 </div>  


 <script>
    $(document).ready(function(){
         $(document).on('click', '.edit_data_btn', function(){  
           var course_id = $(this).attr("id");  
           if(course_id != '')  
           {  
                $.ajax({  
                     url:"edit_selected_teachedcourse.php",  
                     method:"POST",  
                     data:{course_id:course_id},  
                     success:function(data){  
                          $('#edit_form').html(data);  
                          $('#edit').modal('show');  
                     }  
                });  
           }            
      });  
    });
</script>


