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

//------------------------------------featching staff Name---------------------------------------------------//
function staff_list($conn)
  {
    $output ='';
    $sql = "SELECT * FROM staff_table";
    $res = mysqli_query($conn,$sql) ; 
     while ($row=mysqli_fetch_assoc($res))
     {
        $output.='<option value="'.$row["staff_id"].'">'.$row["staff_name"].'</option>' ;  
     }

     return $output ;
  }
?>

<!DOCTYPE html>
<html>

<head>
  <title>Add New Course</title>
  <link rel="icon" href="../img/L1.jpeg">
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
</head>
<body >
  <?php include "sidNav.php";?>

  <div class="container">
    <br><br>
<div id="page-wrapper">

        <div class="row">
          <div class="col-lg-12">
           
            <div class="alert alert-success alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              Welcome Admin  <a class="alert-link" href="#">Start </a>
            </div>
          </div>
        </div><!-- /.row -->
<!-------------------------------Form Add Course--------------------------------------------------->
 <div class="row">

          <div class="col-lg-12">
            <div class="panel panel-success">
              <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-book" ></i> Add New Course </h3>
              </div>
              <div class="panel-body">
                <div id="morris-chart-area"></div>

        <form class="login" action="#" method="post">

        <div class="has-success">
        <label> Course Name</label>
        <input type="text" name="course_name" class="form-control" placeholder="Course_Name"/>
        </div>
        
          <div class="has-success">
            <label>Description</label>
        <textarea name="course_description" class="form-control" placeholder="Description " required="required"></textarea>
          </div>  
        
          <div class="has-success">
            <label> Semester</label>
        <input type="text" name="semester" class="form-control" placeholder="Semester" required="required"  maxlength="15" />
             </div>
            
          <div class="has-success">
           <label> Date </label>
        <input type="date" name="course_date" class="form-control" placeholder="Date" required="required" />
             </div>

             <div class="has-success">
              <label>Time</label>
          <input type="time" name="course_time" class="form-control" placeholder="Time from 9:00 to 16:00 "min="9:00" max="16:00" step="600" required="required"  />
             </div>

             <div class="has-success">
           <label>Material Link</label>
        <textarea name="course_material" class="form-control" placeholder="Material Link  " required="required"></textarea>
             </div>

           
             <div class="has-success">
            <label>Trainer</label>
              <SELECT  name="Trainer" class="form-control" placeholder="Trainer" >
                <option selected="selected" disabled="true">Select Trainer</option>
                <?php echo staff_list($conn);?>  
             </SELECT>
             </div>

          <div class="has-success">
            <label>Location</label>
             <SELECT name="fac" class="form-control" required="required" id="faculty" required="required">
                <option selected="selected" disabled="true">Faculty</option>
                <?php echo faculty_list($conn);?>  
             </SELECT>
             </div>
             
               <div class="has-success">
            <label> Room </label>
          <SELECT id="room" name="room" class="form-control" required="required"  required="required">
            <option selected="selected" disabled="true">Room# | Capacity</option>
             </SELECT>
             </div>

        <div class="modal-footer">
          <input type="submit" name="btnAdd" class="btn btn-info btn-lg btn-block"  value="Add ">
         
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

   <?php include "footers.php"; ?>

</body>
</html>
<!-- To load room   -->
<script>
    $(document).ready(function(){
        $('#faculty').change(function(){
            var fid = $(this).val() ;
            $.ajax({

                url:"load_room.php",
                method:"POST",
                data:{fid:fid},
                success:function(data){
                    $('#room').html(data);
                }
            });

        });
    });
</script>

<?php
if (isset($_POST['btnAdd']))
{
  $cr_name = $_POST['course_name'];
  $cr_desc = $_POST['course_description'];
  $cr_semester = $_POST['semester'];
  $cr_date = $_POST['course_date'];
  $cr_time = $_POST['course_time'];
  $cr_ML = $_POST['course_material'];
  $cr_status = 1;
  $cr_trainer = $_POST['Trainer'];
  $cr_faculty = $_POST['fac'];
  $cr_room = $_POST['room'];

  $admin_id=$_SESSION['ID'];
  $cr_id='';

  $trainer_conflict="(SELECT course_date FROM course_table where staff_id=$cr_trainer AND course_status=1 and  course_date =str_to_date('$cr_date','%Y-%m-%d') )
      UNION
      (SELECT course_date FROM course_table crs , take_relation tk 
      where tk.staff_id=$cr_trainer AND  crs.course_id=tk.course_id AND course_status=1 and  course_date =str_to_date('$cr_date','%Y-%m-%d') )";
  $trainer_conflict_result = mysqli_query($conn,$trainer_conflict) ; 
  
  if (mysqli_num_rows($trainer_conflict_result)>=1)
  {
     echo ' <script> swal( "Error" ,  "Conflict with Trainer Dates" ,  "error" );  </script>';
  }



  else
  {
      $room_conflict= "SELECT course_date FROM course_table crs,teach_in_relation tir where  crs.course_id=tir.course_id AND room_id=$cr_room AND course_date =str_to_date('$cr_date','%Y-%m-%d')" ;
      $room_conflict_result = mysqli_query($conn,$room_conflict) ; 
      if (mysqli_num_rows($room_conflict_result)>=1)
    {
       echo ' <script> swal( "Error" ,  "The room is reserved on this date" ,  "error" );  </script>';
    }
    


    else
    {
      $sql = "INSERT INTO course_table (course_name, course_description, semester, course_date, course_time,material_link, course_status, admin_id, staff_id) VALUES ('$cr_name','$cr_desc','$cr_semester','$cr_date','$cr_time','$cr_ML','$cr_status',$admin_id,$cr_trainer);";
      $result = mysqli_query($conn,$sql);

      if($result)
      {
        $c_id = "SELECT course_id from course_table ORDER BY course_id DESC LIMIT 1" ;
        $c_id_result= mysqli_query($conn,$c_id) ;
        while ($row=mysqli_fetch_assoc($c_id_result))
         {
          $cr_id=$row['course_id'] ;
         }
        $tir = "INSERT INTO teach_in_relation(course_id, room_id) VALUES ($cr_id,$cr_room)";
        $result_tir=mysqli_query($conn,$tir) ; 
      if ($result_tir)
    { 
      $msg_txt = 'New course about '.$cr_name ; 
      $msg_link = 'RegisterCourses.php?c_name="'.$cr_name.'"';

       $msg="INSERT INTO `message_table` (`msg_text`, `msg_link`, `admin_id`) 
            VALUES ('$msg_txt', '$msg_link', '$admin_id');";

          $msg_result =mysqli_query($conn,$msg) ;

          if ($msg_result)
          {
            echo '<script> swal( "" ,  "Add successfully!" ,  "success" ); </script>';
          }else
          {
            $err=mysqli_error($conn);
          echo ' <script> swal( "Error when write a message" ,  "'.$err.' go to message section and write new message " ,  "error" );  </script>';
          }


    }else
    {
      $err=mysqli_error($conn);
          echo ' <script> swal( "Error when assign room" ,  "'.$err.' edit room number in course section " ,  "error" );  </script>';
    }
      }else
      {
        $err=mysqli_error($conn);
          echo ' <script> swal( "Error" ,  "'.$err.'" ,  "error" );  </script>';
      }



    }

  
}


}

?>