<?php 
session_start();
include"connect.php";



if (isset($_POST['edit_btn']))
{ 

$stf_id=$_POST['id'];
$stf_phone=$_POST['staff_phone'];
$stf_add=$_POST['address'];
$stf_g=$_POST['gender'];
$stf_password=$_POST['staff_password'];
$stf_faculty=$_POST['staff_faculty'];

  $update_stf = "UPDATE `staff_table` 
  SET `staff_password`='$stf_password',`staff_address`='$stf_add',`staff_gender`='$stf_g',`staff_phone_num`='$stf_phone',`f_id`=$stf_faculty
   WHERE  staff_id= $stf_id "; 

   $result = mysqli_query($conn,$update_stf);
   if ($result)
   {
    $_SESSION['msg']=1 ; 
    header('Location:Trainee.php'); 
    
     

   }else
   {
    $_SESSION['msg']=2 ;
    header('Location:Trainee.php'); 
   }
}

?>
