<?php
session_start();
include"connect.php";
$cid=$_GET['c_id'];
$sql="DELETE FROM take_relation WHERE course_id= $cid;" ; 
$sql.="DELETE FROM teach_in_relation WHERE course_id= $cid;" ; 
$sql.="DELETE FROM course_table WHERE course_id= $cid;" ;

$result =mysqli_multi_query($conn,$sql) ; 
if ($result)
{
	 $_SESSION['msg']=1 ; 
    header('Location:Course.php'); 
}
else
{
	$_SESSION['err'] = mysqli_error($conn); 
	 $_SESSION['msg']=2 ; 
    header('Location:Course.php'); 
}

?>