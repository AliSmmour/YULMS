<?php  
 if(isset($_POST["course_id"]))  
 { 
    include"connect.php";
      $output = '';  
      $query = "SELECT * FROM course_table crs, staff_table stf  WHERE course_id = '".$_POST["course_id"]."' and crs.staff_id = stf.staff_id";  
      $result = mysqli_query($conn, $query);  
      $output .= '  
      <div class="table-responsive">  
           <table>';  
       while($row = mysqli_fetch_assoc($result))  
      {  
           $output .= '  
                <tr>  
                     <td width="30%"><label>Course Name</label></td>  
                     <td width="70%">  : '.$row["course_name"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>course_description</label></td>  
                     <td width="70%">  : '.$row["course_description"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Trainer </label></td>  
                     <td width="70%">  : '.$row["staff_name"].'</td>
                </tr>
                <tr>  
                     <td width="30%"><label>Trainer Email </label></td>  
                     <td width="70%">  :' .$row["staff_email"].'</a></td>
                </tr>
                
                <tr>  
                     <td width="30%"><label>material_link</label></td>  
                     <td width="70%">  : <a href="'.$row["material_link"].'">'.$row["material_link"].' </a></td>  
                </tr>  
           ';  
      }  

 $query2 = "SELECT tr.room_id,bld_name,loc.capacity
FROM teach_in_relation tr ,location_table loc,faculty_table fac
WHERE tr.room_id = loc.room_id and loc.f_id=fac.f_id and tr.course_id='".$_POST["course_id"]."'";  
      $result2 = mysqli_query($conn, $query2);  

 while($row2 = mysqli_fetch_assoc($result2))  
      {  
           $output .= '  
                <tr>  
                     <td width="30%"><label>Location</label></td>  
                     <td width="70%">  : '.$row2["room_id"].' - '.$row2["bld_name"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Capacity</label></td>  
                     <td width="70%">  : '.$row2["capacity"].'</td>  
                </tr>  
                  
           ';  
      }  

 $query3 = "SELECT capacity-COUNT(tr.course_id) as Available
FROM take_relation tr , teach_in_relation tinr, location_table loc
WHERE tr.course_id = tinr.course_id and loc.room_id=tinr.room_id and tr.course_id='".$_POST["course_id"]."'";  
      $result3 = mysqli_query($conn, $query3);  

 while($row3 = mysqli_fetch_assoc($result3))  
      {  
           $output .= '  
                <tr>  
                     <td width="30%"><label>Available</label></td>  
                     <td width="70%">  : '.$row3["Available"].'</td>  
                </tr>  
                  
           ';  
      }  

     $query4 = "SELECT staff_name 
FROM staff_table stf , take_relation tr
WHERE stf.staff_id=tr.staff_id and course_id='".$_POST["course_id"]."'";  
      $result4 = mysqli_query($conn, $query4);  
      $output .= '  
                <tr>  
                     <td width="30%"><label>The Trainee : </label></td> 
                     <td width="70%"> <br>
                 ';
 while($row4 = mysqli_fetch_assoc($result4))  
      {  
           $output .= '  '.$row4["staff_name"].'<br/>       ';  
      }  
      $output .= ' 
      </td> 
      </tr> 
           </table>  
      </div>  
      ';  
 
      echo $output;  
 }  
 ?>