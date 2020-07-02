<?php  
 if(isset($_POST["course_id"]))  
 { 
    include"connect.php";

    
    



      $output = '';  
      $query = "SELECT course_id,course_name,course_description,material_link,course_status
                from course_table 
                WHERE course_id='".$_POST["course_id"]."'";  
      $result = mysqli_query($conn, $query);
     while($row = mysqli_fetch_assoc($result))  
      {  
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
        <textarea name="course_description" class="form-control" placeholder="Description ">'.$row["course_description"].'</textarea>
        </div>

       
        <div >
        <label>Material Link</label>
        <textarea name="course_material" class="form-control" placeholder="Material Link  ">'.$row["material_link"].'</textarea>
        </div>

          <div >
        <label> Status </label>
        <select name="course_status" class="form-control" >
          <option value="1">  In process  </option> 
          <option value="2">  Completed   </option> ';

        $output.='</select>
        </div>';   

        
        }
     




     echo $output;
     
 }     
 ?>
