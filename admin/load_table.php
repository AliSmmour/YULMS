<?php 
include"connect.php";

if (isset($_POST['Mopt'])and isset($_POST['Sopt'])) 
{     
	$output='';
#SELECT COURSE AS MAIN TOPIC AND SELECT STATUS IN SUB TOPIC
	if ($_POST['Mopt']=="crs" and ($_POST['Sopt']=="1" or $_POST['Sopt']=="2" or $_POST['Sopt']=="3") )
	{
		$status= $_POST['Sopt'];
		$sql = "SELECT crs.course_id,course_name,course_time,course_date,bld_name,loc.room_id ,staff_name FROM teach_in_relation tr,course_table crs,faculty_table fac,location_table loc,staff_table stf WHERE crs.course_id=tr.course_id AND loc.room_id=tr.room_id AND loc.f_id=fac.f_id AND course_status=$status AND crs.staff_id=stf.staff_id ORDER BY course_name ASC";

		$result=mysqli_query($conn,$sql);

	if (mysqli_num_rows($result)>=1) 
	{		$c=1;
		$output.=" <thead> <tr> <th>#</th><th>Course Name</th><th>Course Time</th><th>Course Date</th><th>Location </th><th>Trainer</th> </thead>";	
	    while($row=mysqli_fetch_assoc($result)) 
	    {
          $output.="<tbody><tr>";
  		  $output.= "<td>".$c." </td>";
 	      $output.= "<td>".$row['course_name']." </td>";
 	      $output.= "<td>".$row['course_time']." </td>";
 	      $output.= "<td>".$row['course_date']." </td>";
 	      $output.= "<td>".$row['bld_name']." ".$row['room_id']."</td>";
 	      $output.= "<td>".$row['staff_name']." </td> <tr> </tbody>"; 
 	      $c+=1;

	    }
	}

	}
	#SELECT COURSE AS MAIN TOPIC AND SELECT Complet last month IN SUB TOPIC
	elseif ($_POST['Mopt']=="crs" and $_POST['Sopt']=="LM" )
	{

		$sql = "SELECT crs.course_id,course_name,course_time,course_date,bld_name,loc.room_id ,staff_name FROM teach_in_relation tr,course_table crs,faculty_table fac,location_table loc,staff_table stf WHERE crs.course_id=tr.course_id AND loc.room_id=tr.room_id AND loc.f_id=fac.f_id AND course_status=2 AND crs.staff_id=stf.staff_id
			AND MONTH(course_date)=MONTH(CURRENT_DATE - INTERVAL 1 MONTH)
		    ORDER BY course_name ASC";

		$result=mysqli_query($conn,$sql);

	if (mysqli_num_rows($result)>=1) 
	{		$c=1;
		$output.=" <thead> <tr> <th>#</th><th>Course Name</th><th>Course Time</th><th>Course Date</th><th>Location </th><th>Trainer</th> </thead>";	
	    while($row=mysqli_fetch_assoc($result)) 
	    {
          $output.="<tbody><tr>";
  		  $output.= "<td>".$c." </td>";
 	      $output.= "<td>".$row['course_name']." </td>";
 	      $output.= "<td>".$row['course_time']." </td>";
 	      $output.= "<td>".$row['course_date']." </td>";
 	      $output.= "<td>".$row['bld_name']." ".$row['room_id']."</td>";
 	      $output.= "<td>".$row['staff_name']." </td> <tr> </tbody>"; 
 	      $c+=1;

	    }
	}

	}
#SELECT COURSE AS MAIN TOPIC AND SELECT Complet last year IN SUB TOPIC
	elseif ($_POST['Mopt']=="crs" and $_POST['Sopt']=="LY" )
	{

		$sql = "SELECT crs.course_id,course_name,course_time,course_date,bld_name,loc.room_id ,staff_name FROM teach_in_relation tr,course_table crs,faculty_table fac,location_table loc,staff_table stf WHERE crs.course_id=tr.course_id AND loc.room_id=tr.room_id AND loc.f_id=fac.f_id AND course_status=2 AND crs.staff_id=stf.staff_id AND YEAR(course_date)=YEAR(CURRENT_DATE - INTERVAL 1 YEAR)
		    ORDER BY course_name ASC";

		$result=mysqli_query($conn,$sql);

	if (mysqli_num_rows($result)>=1) 
	{		$c=1;
		$output.=" <thead> <tr> <th>#</th><th>Course Name</th><th>Course Time</th><th>Course Date</th><th>Location </th><th>Trainer</th> </thead>";	
	    while($row=mysqli_fetch_assoc($result)) 
	    {
          $output.="<tbody><tr>";
  		  $output.= "<td>".$c." </td>";
 	      $output.= "<td>".$row['course_name']." </td>";
 	      $output.= "<td>".$row['course_time']." </td>";
 	      $output.= "<td>".$row['course_date']." </td>";
 	      $output.= "<td>".$row['bld_name']." ".$row['room_id']."</td>";
 	      $output.= "<td>".$row['staff_name']." </td> <tr> </tbody>"; 
 	      $c+=1;

	    }
	}

	}
	#SELECT COURSE AS MAIN TOPIC AND SELECT TRAINER IN SUB TOPIC
	elseif ($_POST['Mopt']=="crs" and filter_var($_POST['Sopt'],FILTER_VALIDATE_EMAIL))
	 {
		$staff= $_POST['Sopt'];
		$sql = "SELECT crs.course_id,course_name,course_time,course_date,course_status,bld_name,loc.room_id ,semester FROM teach_in_relation tr,course_table crs,faculty_table fac,location_table loc,staff_table stf WHERE crs.course_id=tr.course_id AND loc.room_id=tr.room_id AND loc.f_id=fac.f_id AND staff_email='$staff' AND crs.staff_id=stf.staff_id ORDER BY course_status ASC,course_name ASC";

		$result=mysqli_query($conn,$sql);

	if (mysqli_num_rows($result)>=1) 
	{		$c=1;
		 $output.="<thead><tr> <th>#</th><th>Course Name</th><th>Semester</th><th>Course status</th><th>Course Time</th><th>Course Date</th><th>Location </th></thead>";	

	    while($row=mysqli_fetch_assoc($result)) 
	    {
	    	
	     
          $output.="<tbody><tr>";
  		  $output.= "<td>".$c." </td>";
 	      $output.= "<td>".$row['course_name']." </td>";
 	      $output.= "<td>".$row['semester']." </td>";
 	      $output.= "<td>".$row['course_status']." </td>";
 	      $output.= "<td>".$row['course_time']." </td>";
 	      $output.= "<td>".$row['course_date']." </td>";
 	      $output.= "<td>".$row['bld_name']." ".$row['room_id']."</td> <tr></tbody>"; 
 	      $c+=1;

	    }
	}
	 }



	 #SELECT USER AS MAIN TOPIC AND SELECT GENDER IN SUB TOPIC
	 elseif ($_POST['Mopt']=="user" and ($_POST['Sopt']=="M" or $_POST['Sopt']=="F"))
	 {
		$gender= $_POST['Sopt'];
		$sql = "SELECT staff_id,staff_name,staff_email,staff_address,staff_phone_num,bld_name
				FROM staff_table stf ,faculty_table fac
				WHERE fac.f_id = stf.f_id and staff_gender='$gender' ORDER BY staff_name asc";

		$result=mysqli_query($conn,$sql);

	if (mysqli_num_rows($result)>=1) 
	{		$c=1;
		$output.="<thead><tr> <th>#</th><th>Name</th><th>Email</th><th>Addreess</th><th>Phone</th><th>Faculty </th></thead>";	
	    while($row=mysqli_fetch_assoc($result)) 
	    {
	    	
          $output.="<tbody><tr>";
  		  $output.= "<td>".$c." </td>";
 	      $output.= "<td>".$row['staff_name']." </td>";
 	      $output.= "<td>".$row['staff_email']." </td>";
 	      $output.= "<td>".$row['staff_address']." </td>";
 	      $output.= "<td>".$row['staff_phone_num']." </td>";
 	      $output.= "<td>".$row['bld_name']."</td> <tr></tbody>"; 
 	      $c+=1;

	    }
	}
	 }
	 #SELECT USER AS MAIN TOPIC AND SELECT Lateset 5 User IN SUB TOPIC
	 elseif ($_POST['Mopt']=="user" and $_POST['Sopt']=="L5")
	 {
		$sql = "SELECT staff_id,staff_name,staff_email,staff_address,staff_phone_num,bld_name
				FROM staff_table stf ,faculty_table fac
				WHERE fac.f_id = stf.f_id 
			    ORDER BY staff_id DESC LIMIT 5";

		$result=mysqli_query($conn,$sql);

	if (mysqli_num_rows($result)>=1) 
	{		$c=1;
		$output.="<thead><tr> <th>#</th><th>Name</th><th>Email</th><th>Addreess</th><th>Phone</th><th>Faculty </th></thead>";	
	    while($row=mysqli_fetch_assoc($result)) 
	    {
	    	
          $output.="<tbody><tr>";
  		  $output.= "<td>".$c." </td>";
 	      $output.= "<td>".$row['staff_name']." </td>";
 	      $output.= "<td>".$row['staff_email']." </td>";
 	      $output.= "<td>".$row['staff_address']." </td>";
 	      $output.= "<td>".$row['staff_phone_num']." </td>";
 	      $output.= "<td>".$row['bld_name']."</td> <tr></tbody>"; 
 	      $c+=1;

	    }
	}
	 }
	 #SELECT USER AS MAIN TOPIC AND SELECT USER NAME IN SUB TOPIC
	 elseif ($_POST['Mopt']=="user" and filter_var($_POST['Sopt'],FILTER_VALIDATE_EMAIL))
	 {
		$staff= $_POST['Sopt'];
		$sql = "SELECT staff_id,staff_name,staff_email,staff_address,staff_phone_num,bld_name,staff_gender
				FROM staff_table stf ,faculty_table fac
				WHERE fac.f_id = stf.f_id and staff_email='$staff' ORDER BY staff_name asc";

		$result=mysqli_query($conn,$sql);

	if (mysqli_num_rows($result)>=1) 
	{		$c=1;
	    while($row=mysqli_fetch_assoc($result)) 
	    {
          $output .= '  
                <tr>  
                     <td><label>Trainee Name</label></td>  
                     <td>  : '.$row["staff_name"].'</td>  
                </tr>  
                <tr>  
                     <td><label>Trainee Email</label></td>  
                     <td>  : '.$row["staff_email"].'</td>  
                </tr>  
                <tr>  
                     <td><label>Trainee Phone</label></td>  
                     <td>  : '.$row["staff_phone_num"].'</td>
                </tr>
                <tr>  
                     <td><label>Trainee Address </label></td>  
                     <td>  :' .$row["staff_address"].'</a></td>
                </tr>
                
                <tr>  
                     <td><label>Trainee Gender</label></td>  
                     <td>  : '.$row["staff_gender"].'</td>  
                </tr>  

                <tr>  
                     <td><label>Faculty</label></td>  
                     <td>  : '.$row["bld_name"].'</td>  
                </tr>  
           ';  
 	      $c+=1;

	    }
	}
	$query2 = "SELECT course_name FROM staff_table stf , course_table crs Where stf.staff_id = crs.staff_id and staff_email='$staff'";  
      $result2 = mysqli_query($conn, $query2);  
      $output .= '  
                <tr>  
                     <td><label>Teached Courses : </label></td> 
                     <td> <br>
                 ';
 while($row2 = mysqli_fetch_assoc($result2))  
      {  
           $output .= '  '.$row2["course_name"].'<br/>              
           ';  
      }  
      $output .= ' 
      </td> 
      </tr>';

   $query3 = "SELECT course_name 
FROM course_table crs , take_relation tr,staff_table stf
WHERE crs.course_id=tr.course_id and staff_email='$staff' and tr.staff_id = stf.staff_id";  
      $result3 = mysqli_query($conn, $query3);  
      $output .= '  
                <tr>  
                     <td><label>Courses that taken  : </label></td> 
                     <td> <br>
                 ';
 while($row3 = mysqli_fetch_assoc($result3))  
      {  
           $output .= '  '.$row3["course_name"].'<br/>              
           ';  
      }  
      $output .= ' 
      </td> 
      </tr> ';


}
#SELECT FACULTY  AS MAIN TOPIC AND SELECT COURSES IN SUB TOPIC
elseif ($_POST['Sopt']=="crsF")
 {
	$f_id= $_POST['Mopt'];
		$sql = "SELECT crs.course_id,course_name,course_status,course_time,course_date,staff_name FROM teach_in_relation tr,course_table crs,location_table loc,staff_table stf WHERE crs.course_id=tr.course_id AND loc.room_id=tr.room_id AND loc.f_id=$f_id AND crs.staff_id=stf.staff_id ORDER BY course_status ASC,course_name ASC";

		$result=mysqli_query($conn,$sql);

	if (mysqli_num_rows($result)>=1) 
	{		$c=1;
		 $output.="<thead><tr> <th>#</th><th>Course Name</th><th>Course status</th><th>Course Time</th><th>Course Date</th><th>Trainer</th></thead>";	
	    while($row=mysqli_fetch_assoc($result)) 
	    {
          $output.="<tbody><tr>";
  		  $output.= "<td>".$c." </td>";
 	      $output.= "<td>".$row['course_name']." </td>";
 	       $output.= "<td>".$row['course_status']." </td>";
 	      $output.= "<td>".$row['course_time']." </td>";
 	      $output.= "<td>".$row['course_date']." </td>";
 	      $output.= "<td>".$row['staff_name']." </td> <tr></tbody>"; 
 	      $c+=1;

	    }
	}
 }
#SELECT FACULTY  AS MAIN TOPIC AND SELECT USERES IN SUB TOPIC
 elseif ($_POST['Sopt']=="uF")
 {
		$f_id= $_POST['Mopt'];
		$sql = "SELECT staff_id,staff_name,staff_email,staff_address,staff_phone_num
				FROM staff_table stf ,faculty_table fac
				WHERE fac.f_id = stf.f_id and fac.f_id=$f_id ORDER BY staff_name asc";

		$result=mysqli_query($conn,$sql);

	if (mysqli_num_rows($result)>=1) 
	{		$c=1;
		$output.="<thead><tr> <th>#</th><th>Name</th><th>Email</th><th>addreess</th><th>Phone</th></thead>";	
	    while($row=mysqli_fetch_assoc($result)) 
	    {
          $output.="<tbody><tr>";
  		  $output.= "<td>".$c." </td>";
 	      $output.= "<td>".$row['staff_name']." </td>";
 	      $output.= "<td>".$row['staff_email']." </td>";
 	      $output.= "<td>".$row['staff_address']." </td>";
 	      $output.= "<td>".$row['staff_phone_num']." </td> <tr></tbody>"; 
 	      $c+=1;

	    }
	}
 }

      echo $output;

}


?>