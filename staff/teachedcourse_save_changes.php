<?php 
session_start();
include"connect.php";



if (isset($_POST['edit_btn']))
{ 

$cr_id=$_POST['id'];
$cr_name=$_POST['course_name'];
$cr_desc=$_POST['course_description'];
$cr_material=$_POST['course_material'];
$cr_status=$_POST['course_status'];
  $update_crs = "UPDATE `course_table` SET `course_description`='$cr_desc',`material_link`='$cr_material',`course_status`='$cr_status'
   WHERE course_id= $cr_id; "; 

   $result = mysqli_query($conn,$update_crs);
   if ($result)
   {
    $_SESSION['msg']=1 ; 
    header('Location:TeachedCourses.php'); 
    
     

   }else
   {
    $_SESSION['err'] = mysqli_error($conn); 
    $_SESSION['msg']=2 ; 
    header('Location:TeachedCourses.php'); 
    
   }
}

?>
