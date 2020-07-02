<?php
session_start();
include"connect.php";
$msg_id=$_GET['msg_id'];
$sql="DELETE FROM message_table WHERE msg_id= $msg_id" ; 
$result =mysqli_query($conn,$sql) ; 
if ($result)
{
	 $_SESSION['msg']=1 ; 
    header('Location:Message.php'); 
}
else
{
	$_SESSION['err'] = mysqli_error($conn); 
	 $_SESSION['msg']=2 ; 
    header('Location:Message.php'); 
}

?>