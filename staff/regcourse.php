<?php
session_start();
include 'connect.php';
$c_id=$_GET['c_id'];
$staff_id=$_SESSION['staff_ID'];
?>
<?php              
$sql="(SELECT course_date FROM course_table where staff_id=$staff_id AND course_status=1 AND course_date = (SELECT course_date FROM course_table where course_id=$c_id))
 
      UNION

      (SELECT course_date FROM course_table crs , take_relation tk 
      where tk.staff_id=$staff_id AND  crs.course_id=tk.course_id AND course_status=1 AND  course_date = (SELECT course_date FROM course_table where course_id=$c_id))";

$result=mysqli_query($conn,$sql);
if (mysqli_num_rows($result)>=1) 
{
	$_SESSION['err']="Conflict with  another Course";
	$_SESSION['msg']=2;
	header('Location:RegisterCourses.php'); 
}
else

{

	$INS="INSERT INTO take_relation(staff_id,course_id)
	       Values($staff_id,$c_id)";
	  $result2=mysqli_query($conn,$INS);
	  if ($result2) 
	  {
	  	$_SESSION['msg']=1;
	    header('Location:RegisterCourses.php'); 
	  	
	  }
	  else
	  {
         $_SESSION['err']=mysqli_error($conn);
	     $_SESSION['msg']=2;
         header('Location:RegisterCourses.php'); 

	  }

}


























?>