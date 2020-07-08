<?php session_start();

include"connect.php";?>



<?php 
function message_info($conn)
{
$table='';
$records="SELECT msg_id,msg_text,msg_link FROM message_table msg ORDER BY  msg_id DESC";
$serv=$_SERVER['PHP_SELF'];
$result = mysqli_query($conn,$records);
if(mysqli_num_rows($result)>0)
{
while($row=mysqli_fetch_assoc($result))
{
  $msg_id=$row['msg_id'];

  $table.="<tr>";
  $table.= "<td>".$row['msg_id']." </td>";
  $table.= "<td>".$row['msg_text']." </td>";
  $table.= "<td><a href='".$row['msg_link']."'>".$row['msg_link']."</a> </td>  ";
  $table.= "<td>

     <!-- Button trigger modal -->
          <button name='reply' id='$msg_id' class='btn btn-block btn-warning reply_data_btn'>
          <i class='fa fa-reply'></i> Reply
        </button>
 </td></tr> ";
                


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

    <title>Message </title>
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

echo '<script> swal( "" ,  "Send Message" ,  "success" ); </script>';
   $_SESSION['msg']=0 ;
  }elseif ($_SESSION['msg']==2) {
    $err= $_SESSION['err'] ;
echo ' <script> swal( "Error" ,  "Try later !" ,  "error" );  </script>';
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
            <h1>Dashboard <small>Message View</small></h1>
            <ol class="breadcrumb">
              <li class="active"><i class="fa fa-dashboard"></i>  Message Information </li>
            </ol>
            <div class="alert alert-success alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              Welcome<?php echo $_SESSION['staff_user'];?> <a class="alert-link" href="#">Start </a>
            </div>
          </div>
        </div><!-- /.row -->

 <!-- Fetch Stafssssssssssssssssssssssssssssssssssssssss-->

        <div class="row">

          <div class="col-lg-12">
            <div class="panel panel-success">
              <div class="panel-heading">
                <h3 class="panel-title"><i class="fas fa-envelope-open"></i> Message</h3>
              </div>
              <div class="panel-body">
                <div id="morris-chart-area"></div>


          <div class="col-lg-12">
            <h2>View Message</h2>
            </div>
            <div class="table-responsive">
              <div class="form-group has-success"> <label for="exampleInputEmail1">Search here </label> <input id="searchdata" type="text" name="searchdata" class="form-control " autocomplete="off" autofocus="autofocus">
                <br>
              <table class="table table-bordered table-hover table-striped tablesorter">
                <thead>
                  <tr>
                    <th>ID</th>

                    <th>Mesasge</th>

                    <th>Message Link</th>

                    <th>Action</th>

                  </tr>
                </thead>
                <tbody id="table"> <?php echo message_info($conn); ?> </tbody>
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

                url:"load_search_MSG.php", 
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


<!--reply modal-->


 <div id="reply" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Reply</h4>  
                </div>  
                <div class="modal-body">
                  <form action="MSG_send.php" method="post">
                    <div id="reply_form">
                    </div><br>
                     <button name='send_btn' class='btn btn-block btn-success btn-lg'type="submit"><i class='fas fa-paper-plane'></i>
                      Send  </button>

                  </form>
                </div>  
                <div class="modal-footer">  
                </div>  
           </div>  
      </div>  
 </div>  


 <script>
    $(document).ready(function(){
         $(document).on('click', '.reply_data_btn', function(){  
           var msg_id = $(this).attr("id");  
           if(msg_id != '')  
           {  
                $.ajax({  
                     url:"MSG_reply.php",  
                     method:"POST",  
                     data:{msg_id:msg_id},  
                     success:function(data){  
                          $('#reply_form').html(data);  
                          $('#reply').modal('show');  
                     }  
                });  
           }            
      });  
    });
</script>



