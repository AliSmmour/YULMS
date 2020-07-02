<?php 
session_start();

if (isset($_POST['send_btn']))
{ 

$to=$_POST['to'];
$sub=$_POST['subject'];
$msg=$_POST['message'];
$from= $_SESSION['staff_email'];
$header=$header= "From: $from";
$result= mail($to, $sub, $msg,$header);
   if ($result)
   {
    $_SESSION['msg']=1 ; 
    header('Location:Message.php'); 
    
     

   }else
   {
    $_SESSION['msg']=2 ; 
    header('Location:Message.php'); 
    
   }
}

?>