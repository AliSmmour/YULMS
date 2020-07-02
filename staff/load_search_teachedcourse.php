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
		$sql="SELECT crs.course_id,course_name,course_time,course_date,material_link,bld_name,loc.room_id
          FROM teach_in_relation tr,course_table crs,faculty_table fac,location_table loc
          WHERE crs.course_id=tr.course_id AND loc.room_id=tr.room_id AND loc.f_id=fac.f_id AND course_status=1 AND staff_id=$staff_id
          AND (course_name Like '%$sdata%' || course_date like  '%$sdata%'|| course_time like  '%$sdata%'|| material_link like  '%$sdata%' ||
                   loc.room_id like  '%$sdata%'|| bld_name like  '%$sdata%')
          ORDER BY course_id desc" ;
	}
	else
	{
		$sql = "SELECT crs.course_id,course_name,course_time,course_date,material_link,bld_name,loc.room_id
          FROM teach_in_relation tr,course_table crs,faculty_table fac,location_table loc
          WHERE crs.course_id=tr.course_id AND loc.room_id=tr.room_id AND loc.f_id=fac.f_id AND course_status=1 AND staff_id=$staff_id
          ORDER BY course_id desc";
	}
	$serv=$_SERVER['PHP_SELF'];
	 $result = mysqli_query($conn,$sql) ; 
	 if(mysqli_num_rows($result)<1)
	 {
	 	$table.='<tr> <th colspan="8" class="text-center"> NO DATA FOUND </th> </tr> ' ;
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
  $table.= "<td>

     <!-- Button trigger modal -->
         <button name='edit' id='$c_id' class='btn btn-success  edit_data_btn' style='width:48%;'><i class='fas fa-edit'></i>
         Edit
        </button>

      

        <button name='view' id='$c_id' class='btn btn-info  view_data_btn' style='width:48%;'><i class='fas fa-eye'></i>
         View
        </button>

                  </td>
                 </tr>";

                 $c++;
 

}}
     echo $table;
}
?>