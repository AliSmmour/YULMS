<?php
session_start();
include"connect.php";
$sid=$_GET['s_id'];
$sql="UPDATE course_table SET staff_id=0 WHERE staff_id=$sid;";
$sql.="DELETE FROM take_relation WHERE staff_id= $sid;" ; 
$sql.="DELETE FROM staff_table WHERE staff_id= $sid;" ; 
$result =mysqli_multi_query($conn,$sql) ; 
if ($result)
{
	 $_SESSION['msg']=1 ; 
    header('Location:Trainee.php'); 
}
else
{
	$_SESSION['err'] = mysqli_error($conn); 
	 $_SESSION['msg']=2 ; 
    header('Location:Trainee.php'); 
}

?>