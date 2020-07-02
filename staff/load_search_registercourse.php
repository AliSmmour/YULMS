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
		$sql="SELECT crs.course_id,course_name,course_time,course_date,bld_name,loc.room_id,capacity,staff_name FROM teach_in_relation tr,course_table crs,faculty_table fac,location_table loc,staff_table stf WHERE crs.course_id=tr.course_id AND loc.room_id=tr.room_id AND loc.f_id=fac.f_id AND course_status=1 AND crs.staff_id=stf.staff_id AND crs.staff_id !=$staff_id AND crs.course_id not in (SELECT course_id from take_relation where staff_id=$staff_id)
          AND (course_name Like '%$sdata%' || course_date like  '%$sdata%'|| course_time like  '%$sdata%'|| staff_name like  '%$sdata%' ||loc.room_id like  '%$sdata%'|| bld_name like  '%$sdata%' ) ORDER BY course_date DESC ,course_date DESC";
	}
	else
	{
		$sql = "SELECT crs.course_id,course_name,course_time,course_date,bld_name,loc.room_id,capacity,staff_name FROM teach_in_relation tr,course_table crs,faculty_table fac,location_table loc,staff_table stf WHERE crs.course_id=tr.course_id AND loc.room_id=tr.room_id AND loc.f_id=fac.f_id AND course_status=1 AND crs.staff_id=stf.staff_id AND crs.staff_id !=$staff_id AND crs.course_id not in (SELECT course_id from take_relation where staff_id=$staff_id) ORDER BY course_date DESC ,course_date DESC";
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
  { $c_id=$row['course_id'];
  $Trainee=0;
  $num = "SELECT COUNT(*) as Num FROM take_relation WHERE staff_id!=$staff_id and course_id = $c_id ";
  $num_result = mysqli_query($conn,$num) ; 
  while ($num_row=mysqli_fetch_assoc($num_result))
   {
    $Trainee=$num_row['Num'];
   }
   if ($Trainee>=$row['capacity'])
   {
     $table.="<tr style='background-color:#ff6767'>";
   
  $table.= "<td>".$c." </td>";
  $table.= "<td>".$row['course_name']." </td>";
  $table.= "<td>".$row['course_time']." </td>";
  $table.= "<td>".$row['course_date']." </td>";
  $table.= "<td>".$row['bld_name']." ".$row['room_id']."</td>";
  $table.= "<td>".$Trainee."/".$row['capacity']."</td>";
  $table.= "<td>".$row['staff_name']." </td>";
  $table.= "<td>

        <button name='view' id='$c_id' class='btn btn-defult view_data_btn btn-block' ><i class='fas fa-eye'></i>
         View
        </button>

                  </td>
                 </tr>";
  }else
  {
    $table.="<tr>";
   
  $table.= "<td>".$c." </td>";
  $table.= "<td>".$row['course_name']." </td>";
  $table.= "<td>".$row['course_time']." </td>";
  $table.= "<td>".$row['course_date']." </td>";
  $table.= "<td>".$row['bld_name']." ".$row['room_id']."</td>";
  $table.= "<td>".$Trainee."/".$row['capacity']."</td>";
  $table.= "<td>".$row['staff_name']." </td>";
  $table.= "<td>

     <!-- Button trigger modal -->
           <a  class='btn btn-warning register_data_btn' style='width:48%;' href='regcourse.php?c_id=$c_id'><i class='fas fa-plus-circle'></i>
         Register
        </a>


        <button name='view' id='$c_id' class='btn btn-info view_data_btn' style='width:48%;'><i class='fas fa-eye'></i>
         View
        </button>

                  </td>
                 </tr>";
  }
 
                 $c++;
 

 
}}
     echo $table;
}
?>