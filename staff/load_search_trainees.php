<?php
session_start();
include"connect.php";
$table = '' ;
$staff_id=$_SESSION['staff_ID'];
$c = 1; 
if(isset($_POST["search_key"]))
{
	$sdata=$_POST["search_key"];
	if ($_POST['search_key'] !='')
	{
		$sql="SELECT  staff_name,staff_email,staff_phone_num,course_name
          From staff_table stf , take_relation tr,course_table crs
          WHERE stf.staff_id=tr.staff_id and crs.course_id=tr.course_id AND tr.course_id in 
          (SELECT course_id FROM course_table WHERE staff_id=$staff_id and course_status=1)
          AND 
          (stf.staff_name like '%$sdata%'  || stf.staff_email like  '%$sdata%'  || stf.staff_phone_num like  '%$sdata%' || 
          crs.course_name like  '%$sdata%')
          ORDER BY course_name,staff_name asc" ;
	}
	else
	{
		$sql = "SELECT  staff_name,staff_email,staff_phone_num,course_name
          From staff_table stf , take_relation tr,course_table crs
          WHERE stf.staff_id=tr.staff_id and crs.course_id=tr.course_id AND tr.course_id in 
          (SELECT course_id FROM course_table WHERE staff_id=$staff_id and course_status=1)
          ORDER BY course_name,staff_name asc";
	}
	$serv=$_SERVER['PHP_SELF'];
	 $result = mysqli_query($conn,$sql) ; 
	 if(mysqli_num_rows($result)<1)
	 {
	 	$table.='<tr> <th colspan="5" class="text-center"> NO DATA FOUND </th> </tr> ' ;
	 }else
	 {
	while($row=mysqli_fetch_assoc($result))
{

  $table.="<tr>";
  $table.= "<td>".$c." </td>";
  $table.= "<td>".$row['staff_name']." </td>";
  $table.= "<td>".$row['staff_email']." </td>";
  $table.= "<td>".$row['staff_phone_num']." </td>";
  $table.= "<td>".$row['course_name']." </td>";
  $table.= "</tr>";

                 $c++;
 

}}
     echo $table;
}
?>