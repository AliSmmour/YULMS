<?php
session_start();
include"connect.php";
$cid=$_GET['c_id'];
$staff_id=$_SESSION['staff_ID'];
$sql="DELETE FROM take_relation WHERE course_id= $cid and staff_id = $staff_id" ; 
$result =mysqli_query($conn,$sql) ; 
if ($result)
{
	 $_SESSION['msg']=1 ; 
    header('Location:CurrentCourses.php'); 
}
else
{
	$_SESSION['err'] = mysqli_error($conn); 
	 $_SESSION['msg']=2 ; 
    header('Location:CurrentCourses.php'); 
}

?>