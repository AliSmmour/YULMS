<?php 
include"connect.php";

if (isset($_POST['fid'])) 
{     
	$output='';
	$sql="SELECT room_id,capacity FROM location_table
	      WHERE f_id=".$_POST["fid"]."";

	$result=mysqli_query($conn,$sql);

	if (mysqli_num_rows($result)>=1) 
	{
	    while($row=mysqli_fetch_assoc($result)) 
	    {
	    	
         $output.='<option value="'.$row["room_id"].'"> Room# '.$row["room_id"] .' | Capacity '.$row["capacity"].' </option>' ; 

	    }
	}
    else 
   
      {

        $output.='<option disabled="true" selected="selected">No Room In this Faculty</option>';
 
    	}


      echo $output;

}






















?>