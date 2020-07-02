<?php
include"connect.php";
$table = '' ;
$c = 1; 
if(isset($_POST["search_key"]))
{
	$sdata=$_POST["search_key"];
	if ($_POST['search_key'] !='')
	{
		$sql="SELECT admin_name,msg_id,msg_text,msg_link FROM message_table msg ,admin_table adm
          WHERE msg.admin_id=adm.admin_id 
          AND (msg_id like '%$sdata%'|| msg_text like '%$sdata%'||msg_link like '%$sdata%'||admin_name like '%$sdata%') ORDER BY  msg_id DESC" ;
	}
	else
	{
		$sql = "SELECT admin_name,msg_id,msg_text,msg_link FROM message_table msg ,admin_table adm
          WHERE msg.admin_id=adm.admin_id 
           ORDER BY  msg_id DESC";
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
  $msg_id=$row['msg_id'];

  $table.="<tr>";
  $table.= "<td>".$row['msg_id']." </td>";
  $table.= "<td>".$row['msg_text']." </td>";
  $table.= "<td><a href='".$row['msg_link']."'>".$row['msg_link']."</a> </td>";
  $table.= "<td>".$row['admin_name']." </td>";
  $table.= "<td>


      
       <!-- trigger modal -->
 
         <a  class='btn btn-danger btn-block' name='btnDelete' href='deleteMSG.php?msg_id=$msg_id'>
         <i class='fas fa-trash-alt'></i>
         Delete
        </a>

                  </td>
                 </tr>";

                
 

}}
     echo $table;
}
?>