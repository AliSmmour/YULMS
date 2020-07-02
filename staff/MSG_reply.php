<?php  

// mail(to,subject,message)
 if(isset($_POST["msg_id"]))  
 { 
    include"connect.php";

    
    



      $output = '';  
      $query = "SELECT msg_id , admin_email  FROM message_table msg,admin_table adm 
      WHERE msg.admin_id = adm.admin_id and msg_id='".$_POST["msg_id"]."'";  
      $result = mysqli_query($conn, $query);
     while($row = mysqli_fetch_assoc($result))  
      {  
           $output.= '  <div class="table-responsive"> 
      <div class="panel panel-success">
              <div class="panel-heading">
             <center> <img src="img/L4.png"  alt="" style="width: 7rem; height:7rem;"> </center>
              </div>
              <div class="panel-body">
                <div id="morris-chart-area"></div> 
        
        <div >
        <label> TO </label>
        <input type="text" name="to" class="form-control" placeholder="Admin_Email" value="'.$row["admin_email"].'" readonly="readonly" />
        </div>
        <div >
        <label> Subject </label>
        <input type="text" name="subject" class="form-control" placeholder="Subject" value="Replay to message #'.$row["msg_id"].'" readonly="readonly" />
        </div>

        <div >
        <label>Description</label>
        <textarea name="message" class="form-control" placeholder="Write you Message here .... " required="required"></textarea>
        </div>';
        $output.='</div> 
      </div>
      </div>  ';
      }  




     echo $output;
     
 }     
 ?>

