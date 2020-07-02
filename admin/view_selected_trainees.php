<?php  
 if(isset($_POST["staff_id"]))  
 { 
    include"connect.php";
      $output = '';  
      $query = "SELECT DISTINCT staff_id,staff_name,staff_email,staff_address,staff_phone_num,staff_gender,fac.f_id,bld_name
FROM staff_table stf ,faculty_table fac
WHERE fac.f_id = stf.f_id and  staff_id = '".$_POST["staff_id"]."'";  
      $result = mysqli_query($conn, $query);  
      $output .= '  
      <div class="table-responsive"> 
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
                     <td width="30%"><label>Trainee Name</label></td>  
                     <td width="70%">  : '.$row["staff_name"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Trainee Email</label></td>  
                     <td width="70%">  : '.$row["staff_email"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Trainee Phone</label></td>  
                     <td width="70%">  : '.$row["staff_phone_num"].'</td>
                </tr>
                <tr>  
                     <td width="30%"><label>Trainee Address </label></td>  
                     <td width="70%">  :' .$row["staff_address"].'</a></td>
                </tr>
                
                <tr>  
                     <td width="30%"><label>Trainee Gender</label></td>  
                     <td width="70%">  : '.$row["staff_gender"].'</td>  
                </tr>  

                <tr>  
                     <td width="30%"><label>Faculty</label></td>  
                     <td width="70%">  : '.$row["bld_name"].'</td>  
                </tr>  
           ';  
      }  

 $query2 = "SELECT course_name 
            FROM course_table crs , take_relation tr
            WHERE crs.course_id=tr.course_id and tr.staff_id='".$_POST["staff_id"]."'";  
      $result2 = mysqli_query($conn, $query2);  
      $output .= '  
                <tr>  
                     <td width="30%"><label>Courses that taken  : </label></td> 
                     <td width="70%"> <br>
                 ';
 while($row2 = mysqli_fetch_assoc($result2))  
      {  
           $output .= '  '.$row2["course_name"].'<br/>              
           ';  
      }  
      $output .= ' 
      </td> 
      </tr> 
           </table>  
      </div>  
      </div>
      </div>
      ';  
      echo $output;  
 }  
 ?>