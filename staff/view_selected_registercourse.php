<?php  
 if(isset($_POST["course_id"]))  
 { 
    include"connect.php";
      $output = '';  
      $query = "SELECT * FROM course_table crs, staff_table stf  WHERE course_id = '".$_POST["course_id"]."' and crs.staff_id = stf.staff_id";  
      $result = mysqli_query($conn, $query);  
      $output .= '  
      <div class="table-responsive"> 
      <div class="panel panel-success">
              <div class="panel-heading">
             <center> <img src="img/L4.png"  alt="" style="width: 7rem; height:7rem;"> </center>
              </div>
              <div class="panel-body">
                <div id="morris-chart-area"></div> 
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

     $output.='
           </table>  
      </div> 
      </div>
      </div>  
      ';  
 
      echo $output;  
 }  
 ?>