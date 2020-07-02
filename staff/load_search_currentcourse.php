<?php
session_start();
include"connect.php";
$table = '' ;
$c = 1; 
$staff_id=$_SESSION['staff_ID'];
if(isset($_POST["search_key"]))
{
	$sdata=$_POST["search_key"];
	if ($_POST['search_key'] !='')
	{
		$sql="SELECT crs.course_id,course_name,course_time,course_date,material_link,bld_name,loc.room_id , staff_name
          FROM teach_in_relation tr,course_table crs,faculty_table fac,location_table loc,staff_table stf , take_relation tk
          WHERE crs.course_id=tr.course_id AND loc.room_id=tr.room_id AND loc.f_id=fac.f_id AND course_status=1 and tk.staff_id=$staff_id and crs.course_id = tk.course_id AND crs.staff_id = stf.staff_id 
          AND (course_name Like '%$sdata%' || course_date like  '%$sdata%'|| course_time like  '%$sdata%'|| material_link like  '%$sdata%' ||
                   loc.room_id like  '%$sdata%'|| bld_name like  '%$sdata%' || staff_name like  '%$sdata%')
          ORDER BY course_id desc" ;
	}
	else
	{
		$sql = "SELECT crs.course_id,course_name,course_time,course_date,material_link,bld_name,loc.room_id , staff_name
          FROM teach_in_relation tr,course_table crs,faculty_table fac,location_table loc,staff_table stf , take_relation tk
          WHERE crs.course_id=tr.course_id AND loc.room_id=tr.room_id AND loc.f_id=fac.f_id AND course_status=1 and tk.staff_id=$staff_id and crs.course_id = tk.course_id AND crs.staff_id = stf.staff_id 
          ORDER BY course_id desc";
	}
	$serv=$_SERVER['PHP_SELF'];
	 $result = mysqli_query($conn,$sql) ; 
	 if(mysqli_num_rows($result)<1)
	 {
	 	$table.='<tr> <th colspan="9" class="text-center"> NO DATA FOUND </th> </tr> ' ;
	 }else
	 {
  $c = 1; 
while($row=mysqli_fetch_assoc($result))
{
  $c_id=$row['course_id'];

  $table.="<tr>";
  $table.= "<td>".$c." </td>";
  $table.= "<td>".$row['course_name']." </td>";
  $table.= "<td>".$row['course_time']." </td>";
  $table.= "<td>".$row['course_date']." </td>";
  $table.= "<td> <a href='".$row['material_link']."'> ".$row['material_link']." </td>";
  $table.= "<td>".$row['bld_name']."_".$row['room_id']."</td>";
  $table.= "<td>".$row['staff_name']." </td>";
  $table.= "<td>

       <a  class='btn btn-danger' name='btnDelete' style='width:48%;' href='DropCourse.php?c_id=$c_id'>
         <i class='fas fa-times-circle'></i>
         Drop
        </a>


        <button name='view' id='$c_id' style='width:48%;' class='btn btn-info view_data_btn'><i class='fas fa-eye'></i>
         View
        </button>

                  </td>
                 </tr>";

                 $c++;
 

}}
     echo $table;
}
?>