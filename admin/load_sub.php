<?php 
include"connect.php";

if (isset($_POST['opt'])) 
{     
	$output='';
	if ($_POST['opt']=="crs")
	{
		$output.='<option class="options" disabled="true" selected="selected">Status</option>
		<option value="1" > In-process </option>
		<option value="3" > Canceled </option>
		<option value="2" > Completed Ever </option>
		<option value="LM" >  Completed last month </option>
	    <option value="LY" >  Completed last Year </option>';


		$output.='<option class="options" disabled="true" >Trainer</option>';

		$sql="SELECT staff_id,staff_name,staff_email,staff_address,staff_phone_num,staff_gender,fac.f_id,bld_name
			  FROM staff_table stf ,faculty_table fac
		   	  WHERE fac.f_id = stf.f_id and stf.staff_id  in (SELECT staff_id FROM course_table)ORDER BY staff_name asc";

	$result=mysqli_query($conn,$sql);

	if (mysqli_num_rows($result)>=1) 
	{
	    while($row=mysqli_fetch_assoc($result)) 
	    {
	    	
         $output.='<option value="'.$row["staff_email"].'">'.$row["staff_name"] .' </option>' ; 

	    }
	}


	}elseif ($_POST['opt']=="user")
	 {
		$output.='<option class="options" disabled="true" selected="selected">Gender</option>
		<option value="M" > Male </option>
		<option value="F" > Female </option>
		<option value="L5">The latest five users</option>';
		$output.='<option class="options" disabled="true" >Users</option>';
		$sql="SELECT * FROM staff_table ORDER BY staff_name ASC";

	$result=mysqli_query($conn,$sql);

	if (mysqli_num_rows($result)>=1) 
	{
	    while($row=mysqli_fetch_assoc($result)) 
	    {
	    	
         $output.='<option value="'.$row["staff_email"].'">'.$row["staff_name"] .' </option>' ; 

	    }
	}

	 }else
	  {
	  	$output.='<option value="crsF">Courses</option>
		<option value="uF" > Useres </option>';

	  }
	

      echo $output;

}


?>