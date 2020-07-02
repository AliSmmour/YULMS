<?php  
 if(isset($_POST["staff_id"]))  
 { 
    include"connect.php";


      $output = '';  
      $query = "SELECT Distinct staff_id,staff_name , staff_email , staff_password ,staff_phone_num , staff_address , staff_gender ,bld_name ,fac.f_id
                FROM staff_table stf , faculty_table fac
                WHERE stf.f_id = fac.f_id and staff_id = '".$_POST["staff_id"]."'";  

                
      $result = mysqli_query($conn, $query);
     while($row = mysqli_fetch_assoc($result))  
      {  
        $gender=$row["staff_gender"];
           $output.= '  
        <div >
        <input type="hidden" name="id" class="form-control" value="'.$row["staff_id"].'" />
        </div>

        <div >
        <label> Trainer Name</label>
        <input type="text" name="staff_name" class="form-control" placeholder="Staff Name" value="'.$row["staff_name"].'" readonly="readonly" />
        </div>

        <div >
        <label>Trainer Email</label>
         <input type="text" name="staff_email" class="form-control" placeholder="Staff Email" value="'.$row["staff_email"].'" readonly="readonly" />
        </div>

         <div >
        <label> Staff password </label>
        <input type="text" name="staff_password" class="form-control" placeholder="staff password" value="'.$row["staff_password"].'" required="required"  />
        </div>

        <div >
        <label> Staff Phone</label>
        <input type="number" name="staff_phone" class="form-control" placeholder="staff phone" value="'.$row["staff_phone_num"].'"   required="required"/>
        </div>

        <div >
        <label> Trainer Address </label>
         <input 
              type="text" name="address" class="form-control" placeholder="Address" list="city" value="'.$row["staff_address"].'"  required="required"/>
              <datalist id="city" >
              <option value="Amman" />
              <option value="Irbid" />
              <option value="Aqaba" />
              <option value="Az-Zarqa" />
              <option value="Jerash" />
              <option value="Ajloun" />
              <option value="Madaba" />
              <option value="Al-Karak" />
              <option value="Al-Mafrak" />
              <option value="Al-Balqa" />
              <option value="Maan" />
              <option value="Al-Tafilah" />
          </datalist>
        </div>

         <div >
            <label>Male</label>
              <input 
              type="radio" 
              name="gender"
              value="M"  
              required="required" ' ; 
              if($gender=="M")
              {
               $output.=' checked';
              }
            $output.='/>
            <label>Female</label>
              <input 
              type="radio" 
              name="gender"
              value="F" 
            required="required" ';
            if($gender=="F")
            {
              $output.=' checked';
            } 
            
           $output.='/> 
          </div>
         <div >
        <label> Faculty </label>
        <select name="staff_faculty" class="form-control" required="required" >
          <option value="'.$row["f_id"].'">  '.$row["bld_name"].'  </option> ';
        
      $staff = "SELECT DISTINCT f_id , bld_name FROM faculty_table WHERE f_id NOT IN
       (SELECT f_id FROM staff_table WHERE staff_id=".$_POST["staff_id"].")";  
      $stf_list = mysqli_query($conn, $staff) ; 
      while ($stf_row=mysqli_fetch_assoc($stf_list))
       {
        $output.= ' <option value="'.$stf_row["f_id"].'" > '.$stf_row["bld_name"].'</option>';
       }


        $output.='</select>
        </div>   ';  
      }  




     echo $output;
     
 }     
 ?>

