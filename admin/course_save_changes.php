<?php 
session_start();
include"connect.php";



if (isset($_POST['edit_btn']))
{ 

$cr_id=$_POST['id'];
$cr_name=$_POST['course_name'];
$cr_desc=$_POST['course_description'];
$cr_seme=$_POST['semester'];
$cr_date=$_POST['course_date'];
$cr_time=$_POST['course_time'];
$cr_material=$_POST['course_material'];
$cr_status=$_POST['course_status'];
$cr_trainer=$_POST['course_trainer'];
$cr_faculty=$_POST['fac'];
$cr_room=$_POST['room'];

$admin_id=$_SESSION['ID'];
$same=0;


        
// Fetch current  date before Change 
$current_course_date = '';
$sql = "SELECT course_date FROM course_table WHERE course_id = $cr_id" ; 
$result = mysqli_query($conn,$sql);
while ($row = mysqli_fetch_assoc($result))
 {
  $current_course_date = $row['course_date'];
 }

if ($cr_date == $current_course_date)
   {
    $same=1;
   }
    

$trainer_conflict="(SELECT course_date FROM course_table WHERE staff_id=$cr_trainer AND course_status=1 and  course_date =str_to_date('$cr_date','%Y-%m-%d')  and course_id!=$cr_id )
      UNION
      (SELECT course_date FROM course_table crs , take_relation tk 
      WHERE tk.staff_id=$cr_trainer AND  crs.course_id=tk.course_id AND course_status=1 and  course_date =str_to_date('$cr_date','%Y-%m-%d') and tk.course_id!=$cr_id )";

  $trainer_conflict_result = mysqli_query($conn,$trainer_conflict) ; 
  
  if (mysqli_num_rows($trainer_conflict_result)>0)
  {
     $_SESSION['err'] = "Conflict with trainer dates !"; 
      $_SESSION['msg']=2 ; 
      header('Location:Course.php'); 
  }else
  {
      $room_conflict= "SELECT course_date FROM course_table crs,teach_in_relation tir where  crs.course_id=tir.course_id AND room_id=$cr_room AND course_date =str_to_date('$cr_date','%Y-%m-%d') and tir.course_id !=$cr_id" ;
      $room_conflict_result = mysqli_query($conn,$room_conflict) ; 
      if (mysqli_num_rows($room_conflict_result)>0)
    {
       $_SESSION['err'] = "The room is reserved on this date";
       $_SESSION['msg']=2 ; 
        header('Location:Course.php'); 
    }else
    {

        $update_crs = "UPDATE course_table
         SET course_description='$cr_desc',semester='$cr_seme',course_date='$cr_date',
         course_time='$cr_time',material_link='$cr_material',staff_id=$cr_trainer,course_status='$cr_status',
         admin_id=$admin_id
          WHERE course_id= $cr_id;"; 

         $update_crs_result = mysqli_query($conn,$update_crs);

         if(!$update_crs_result)
          {
            $_SESSION['err'] = mysqli_error($conn); 
           $_SESSION['msg']=2 ; 
           header('Location:Course.php'); 
    
          }

          $update_room = "UPDATE teach_in_relation SET room_id='$cr_room' WHERE course_id = $cr_id;"; 

         $update_room_result = mysqli_query($conn,$update_room);

         if(!$update_room_result)
          {
          $_SESSION['err'] = mysqli_error($conn); 
           $_SESSION['msg']=2 ; 
           header('Location:Course.php'); 
    
          }



// TO AVOID CONFLICT 

  
          if (!$same) //( Change on date filed occure )
          {

            $del = "DELETE FROM take_relation WHERE course_id = $cr_id";
            $del_result =mysqli_query($conn,$del) ;

            if(!$del_result)
          {
            $_SESSION['err'] = mysqli_error($conn) ." Delete course or make it canceled "; 
           $_SESSION['msg']=2 ; 
           header('Location:Course.php'); 
    
          }

            $msg_txt = 'YULMS made an update On '.$cr_name ; 
            $msg_link = 'RegisterCourses.php?c_name="'.$cr_name.'"';

           $msg="INSERT INTO `message_table` (`msg_text`, `msg_link`, `admin_id`) 
            VALUES ('$msg_txt', '$msg_link', '$admin_id');";

          $msg_result =mysqli_query($conn,$msg) ;

           if(!$msg_result)
          {
            $_SESSION['err'] = mysqli_error($conn) ." Write New Message  "; 
           $_SESSION['msg']=2 ; 
           header('Location:Course.php'); 
    
          }

           
         
          }

          $_SESSION['msg']=1 ; 
           header('Location:Course.php'); 

    }



}

         
}

?>