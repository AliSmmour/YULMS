<?php session_start();
include"connect.php";?>



<?php 
function staff_info($conn)
{
$table='';
$records="SELECT DISTINCT staff_id,staff_name,staff_email,staff_address,staff_phone_num,staff_gender,fac.f_id,bld_name
FROM staff_table stf ,faculty_table fac
WHERE fac.f_id = stf.f_id and stf.staff_id   IN  (SELECT staff_id FROM take_relation)ORDER BY staff_name asc";


$serv=$_SERVER['PHP_SELF'];
$result = mysqli_query($conn,$records);
$c = 1; 
if(mysqli_num_rows($result)>0)
{
while($row=mysqli_fetch_assoc($result))
{
  $s_id=$row['staff_id'];

   $table.="<tr>";
  $table.= "<td>".$c." </td>";
  $table.= "<td>".$row['staff_name']." </td>";
  $table.= "<td>".$row['staff_email']." </td>";
  $table.= "<td>".$row['staff_phone_num']." </td>";
  $table.= "<td>".$row['staff_address']." </td>";
  $table.= "<td>".$row['staff_gender']." </td>";
  $table.= "<td>".$row['bld_name']." </td>";
  $table.= "<td>

     <!-- Button trigger modal -->
          <button name='edit' id='$s_id' class='btn btn-success edit_data_btn'><i class='fas fa-edit'></i>
         Edit
        </button>

      

       <!-- trigger modal -->
 
         <a  class='btn btn-danger' name='btnDelete' href='deletetrainee.php?s_id=$s_id'>
         <i class='fas fa-trash-alt'></i>
         Delete
        </a>


        <button name='view' id='$s_id' class='btn btn-info view_data_btn'><i class='fas fa-eye'></i>
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

    <title>Trainees</title>
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
 <?php include 'sidNav.php';?>
         
  

      
      <div id="page-wrapper">

        <div class="row">
          <div class="col-lg-12">
            <h1>Dashboard <small>Trainee View</small></h1>
            <ol class="breadcrumb">
              <li class="active"><i class="fa fa-dashboard"></i>  Trainee Information </li>
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
            <div class="panel panel-success">
              <div class="panel-heading">
                <h3 class="panel-title"><i class="fas fa-user-graduate"></i> Trainee </h3>
              </div>
              <div class="panel-body">
                <div id="morris-chart-area"></div>


          <div class="col-lg-12">
            <h2>View Trainee </h2>
            </div>
            <div class="table-responsive">
              <div class="form-group has-success"> <label for="exampleInputEmail1">Search here </label> <input id="searchdata" type="text" name="searchdata" class="form-control " autocomplete="off" autofocus="autofocus">
                <br>
              <table class="table table-bordered table-hover table-striped tablesorter">
                <thead>
                  <tr>
                    <th>#</th>

                    <th>Name</th>

                    <th>Email</th>

                    <th>Phone</th>

                    <th>Address</th>

                    <th>Gender</th>

                    <th>Faculty</th>

                    <th>Action</th>


                  </tr>
                </thead>
                <tbody id="table"> <?php echo staff_info($conn); ?> </tbody>
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
    //   $(document).ready     when load page 
    // $()   // variable declaration 
    $(document).ready(function(){      
        $('#searchdata').keyup(function(){    // event 
            var search_key = $(this).val() ;    // this #searchdata 
            $.ajax({          // code ajax    (1-new page (Direct )  , 2- post / get , 3- data to be send to new page , 4- the place where result return )

                url:"load_search_trainees.php", 
                method:"POST",
                data:{search_key:search_key},   //    =  X    ->    : 
                success:function(data){
                    $('#table').html(data);
                }
            });

        });
    });
</script>



<!---------------------------------Start view modal-------------------------------------->
</html>
<style type="text/css" media="print">
  @media print
  {
    /*Hide Element */
    .row , .modal-footer , #remove {display: none;}
    /*Specifics */
    .modal-body {font-size: 16pt  ;width: 100% ; height: 100%;}
    .panel-success > .panel-heading { background-color: #339966 !important; }
    a { color:blue !important; padding: 0; }
    #view ,.modal-content ,div ,.table-responsive{ border: none; overflow: hidden; }    
  }
</style>



 <div id="view" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header" id="remove">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Trainee Details</h4>  
                </div>  
                <div class="modal-body" id="staff_detail">  
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
           var staff_id = $(this).attr("id");  
           if(staff_id != '')  
           {  
                $.ajax({  
                     url:"view_selected_trainees.php",  
                     method:"POST",  
                     data:{staff_id:staff_id},  
                     success:function(data){  
                          $('#staff_detail').html(data);  
                          $('#view').modal('show');  
                     }  
                });  
           }            
      });  
    });
</script>
<!---------------------------------End view modal-------------------------------------->


<!---------------------------------Start Edit modal------------------------------------>


 <div id="edit" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Edit staff Information </h4>  
                </div>  
                <div class="modal-body" id="staff_detail">
                  <form action="trainee_save_changes.php" method="post">
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
           var staff_id = $(this).attr("id");  
           if(staff_id != '')  
           {  
                $.ajax({  
                     url:"edit_selected_staff.php",  
                     method:"POST",  
                     data:{staff_id:staff_id},  
                     success:function(data){  
                          $('#edit_form').html(data);  
                          $('#edit').modal('show');  
                     }  
                });  
           }            
      });  
    });
</script>
<!---------------------------------End Edit modal------------------------------------>

