<?php  
 if(isset($_POST["course_id"]))  
 { 
    include"connect.php";

    
    



      $output = '';  
      $query = "SELECT crs.course_id,course_name,course_description,semester,material_link,course_status,course_date,course_time,stf.staff_id,staff_name,tr.room_id ,bld_name,fac.f_id,capacity
        from course_table crs ,staff_table stf , teach_in_relation tr , faculty_table fac, location_table loc
        WHERE crs.course_id = tr.course_id and stf.staff_id=crs.staff_id and tr.room_id = loc.room_id and loc.f_id = fac.f_id and crs.course_id='".$_POST["course_id"]."'";  
      $result = mysqli_query($conn, $query);
     while($row = mysqli_fetch_assoc($result))  
      {  
        $state = $row['course_status'] ;
           $output.= '  
        <div >
        <input type="hidden" name="id" class="form-control" value="'.$row["course_id"].'" />
        </div>

        <div >
        <label> Course Name</label>
        <input type="text" name="course_name" class="form-control" placeholder="Course_Name" value="'.$row["course_name"].'" readonly="readonly" />
        </div>

        <div >
        <label>Description</label>
        <textarea name="course_description" class="form-control" placeholder="Description " required="required">'.$row["course_description"].'</textarea>
        </div>

        <div >
        <label> Semester</label>
        <input type="text" name="semester" class="form-control" placeholder="Semester" maxlength="15"  value="'.$row["semester"].'"  required="required" />
        </div>

        <div >
        <label> Date </label>
        <input type="date" name="course_date" class="form-control" placeholder="Date" value="'.$row["course_date"].'" required="required" />
        </div>

        <div >
        <label> Time </label>
        <input type="time" name="course_time" class="form-control" title="Time from 9:00 to 16:00"  value="'.$row['course_time'].'" min="9:00" max="16:00" step="600" required="required"  />
        </div>

        <div >
        <label>Material Link</label>
        <textarea name="course_material" class="form-control" placeholder="Material Link" required="required">'.$row["material_link"].'</textarea>
        </div>

          <div >
        <label> Status </label>
        <select name="course_status" class="form-control"  required="required">
          <option value="1" ';
          if($state==1){
            $output.=' selected="selected" ';
            }
            $output.='> In-process </option>          
          <option value="2" ';
           if($state==2){
            $output.=' selected="selected" ';
            }
            $output.='> Completed </option>
          <option value="3" ';
          if($state==3){
            $output.=' selected="selected" ';
            }
            $output.=' >Canceled </option>
            </select>
        </div>

         <div >
        <label> Trainer </label>
        <select name="course_trainer" class="form-control" required="required">
          <option value="'.$row["staff_id"].'">'.$row["staff_name"].'</option>';
        
      $staff = "SELECT DISTINCT staff_id , staff_name FROM staff_table WHERE staff_id NOT IN
       (SELECT staff_id FROM course_table WHERE course_id=".$_POST["course_id"].")";  
      $stf_list = mysqli_query($conn, $staff) ; 
      while ($stf_row=mysqli_fetch_assoc($stf_list))
       {
        $output.='<option value="'.$stf_row["staff_id"].'">'.$stf_row["staff_name"].'</option>' ;  
       }



        $output.='</select>
        </div>   ';  


       $output.=' <div >
        <label> Location </label>
        <select name="fac" class="form-control" required="required" id="faculty" required="required">
        <option value="'.$row["f_id"].'">'.$row["bld_name"].'</option>';

     
      $fac = "SELECT DISTINCT f_id , bld_name FROM faculty_table 
      WHERE f_id!=0 and f_id NOT IN 
      (SELECT f_id FROM location_table loc,teach_in_relation tir WHERE tir.room_id=loc.room_id and course_id=".$_POST["course_id"].")   ";  //faculty
      $fac_list = mysqli_query($conn, $fac) ; 
      while ($fac_row=mysqli_fetch_assoc($fac_list))
       {
        $output.= '<option value="'.$fac_row["f_id"].'">'.$fac_row["bld_name"].'</option>';
       }


        $output.='</select>
        </div>   ';  


$output.=' <div >
        <label> Room </label>
        <select name="room" class="form-control" required="required" id="room" required="required">
          <option value="'.$row["room_id"].'"> Room# '.$row["room_id"] .' |  '.$row["capacity"].'Seats </option>
        </select>
        </div>   ';  



      }  





     echo $output;
     
 }     
 ?>
<script>
    $(document).ready(function(){
        $('#faculty').click(function(){
            var fid = $(this).val() ;
            $.ajax({

                url:"load_room.php",
                method:"POST",
                data:{fid:fid},
                success:function(data){
                    $('#room').html(data);
                }
            });

        });
    });
</script>