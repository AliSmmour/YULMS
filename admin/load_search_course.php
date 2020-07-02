<?php
include"connect.php";
$table = '' ;
$c = 1; 
if(isset($_POST["search_key"]))
{
	$sdata=$_POST["search_key"];
	if ($_POST['search_key'] !='')
	{
		$sql="SELECT course_id ,course_name,semester,course_date,course_time,course_status,staff_name

          FROM course_table crs,staff_table stf

          WHERE crs.staff_id=stf.staff_id and (course_name like '%$sdata%'|| semester like '%$sdata%'||course_date like '%$sdata%'||course_date like '%$sdata%'||course_time like '%$sdata%'||course_status like '%$sdata%'||staff_name like '%$sdata%')
          ORDER BY course_status ASC ,course_id desc" ;
	}
	else
	{
		$sql = "SELECT course_id ,course_name,semester,course_date,course_time,course_status,staff_name

          FROM course_table crs,staff_table stf

          WHERE crs.staff_id=stf.staff_id
          ORDER BY course_status ASC ,course_id desc";
	}
	$serv=$_SERVER['PHP_SELF'];
	 $result = mysqli_query($conn,$sql) ; 
	 if(mysqli_num_rows($result)<1)
	 {
	 	$table.='<tr> <th colspan="8" class="text-center"> NO DATA FOUND </th> </tr> ' ;
	 }else
	 {
	while($row=mysqli_fetch_assoc($result))
{
  $c_id=$row['course_id'];

   $table.="<tr>";
  $table.= "<td>".$c." </td>";
  $table.= "<td>".$row['course_name']." </td>";
  $table.= "<td>".$row['semester']." </td>";
  $table.= "<td>".$row['course_date']." </td>";
  $table.= "<td>".$row['course_time']." </td>";
  $table.= "<td>".$row['course_status']." </td>";
  $table.= "<td>".$row['staff_name']." </td>";
  $table.= "<td>

     <!-- Button trigger modal -->
         <button name='edit' id='$c_id' class='btn btn-success edit_data_btn'><i class='fas fa-edit'></i>
         Edit
        </button>

      

       <!-- Button trigger modal -->
 
           <a  class='btn btn-danger' name='btnDelete' href='deleteCourse.php?c_id=$c_id'>
         <i class='fas fa-trash-alt'></i>
         Delete
        </a>


        <button name='view' id='$c_id' class='btn btn-info view_data_btn'><i class='fas fa-eye'></i>
         View
        </button>

                  </td>
                 </tr>";

                 $c++;
 

}}
     echo $table;
}
?>