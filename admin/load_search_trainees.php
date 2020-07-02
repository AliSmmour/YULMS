<?php
include"connect.php";
$table = '' ;
$c = 1; 
if(isset($_POST["search_key"]))
{
	$sdata=$_POST["search_key"];
	if ($_POST['search_key'] !='')
	{
		$sql="SELECT DISTINCT staff_id,staff_name,staff_email,staff_address,staff_phone_num,staff_gender,fac.f_id,bld_name
FROM staff_table stf ,faculty_table fac
WHERE fac.f_id = stf.f_id and stf.staff_id   IN  (SELECT staff_id FROM take_relation) and (staff_name like '%$sdata%'|| staff_email like '%$sdata%'||staff_phone_num like                '%$sdata%'||staff_address like '%$sdata%'||staff_gender like '%$sdata%'||bld_name like '%$sdata%')
          ORDER BY staff_name asc" ;
	}
	else
	{
		$sql = "SELECT DISTINCT staff_id,staff_name,staff_email,staff_address,staff_phone_num,staff_gender,fac.f_id,bld_name
FROM staff_table stf ,faculty_table fac
WHERE fac.f_id = stf.f_id and stf.staff_id   IN  (SELECT staff_id FROM take_relation)ORDER BY staff_name asc";
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
   $s_id=$row['staff_id'];

   $table.="<tr>";
  $table.= "<td>".$c." </td>";
  $table.= "<td>".$row['staff_name']." </td>";
  $table.= "<td>".$row['staff_email']." </td>";
  $table.= "<td>".$row['staff_phone_num']." </td>";
  $table.= "<td>".$row['staff_address']." </td>";
  $table.= "<td>".$row['staff_gender']." </td>";
  $table.= "<td>".$row['bld_name']." </td>";
  $table.= "<td>

     <!-- Button trigger modal -->
         <button name='edit' id='$s_id' class='btn btn-success edit_data_btn'><i class='fas fa-edit'></i>
         Edit
        </button>

      

       <!-- Button trigger modal -->
 
          <a  class='btn btn-danger' name='btnDelete' href='deletestaff.php?s_id=$s_id'>
         <i class='fas fa-trash-alt'></i>
         Delete
        </a>



        <button name='view' id='$s_id' class='btn btn-info view_data_btn'><i class='fas fa-eye'></i>
         View
        </button>

                  </td>
                 </tr>";

                 $c++;
 

}}
     echo $table;
}
?>