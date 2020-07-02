<?php

if (empty($_SESSION['staff_ID']))
{
  header('location:index.php');
exit();
}


?>
 
<style type="text/css">
  .navbar-inverse .navbar-nav>li>a:focus, .navbar-inverse .navbar-nav>li>a:hover {
    color: darkgray;
    background-color: transparent;
}



}
</style>





 <!-- Sidebar -->
  <div id="wrapper">
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  
             
                  
          
            
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" style="font-family: 'Do Hyeon', sans-serif;" href="StfIndex.php">

                <img src="img/L4.png"  alt="" style="height: 5rem; width: 5rem;">
                 <span>User YU LMS </span>
                    </a>
                    
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav side-nav">

            <li  class=""><a href="StfIndex.php">       <i class="fa fa-dashboard"></i> Dashboard</a></li>

            <li><a data-toggle="collapse" data-parent="#accordion" href="#collapse1" class="collapsed"><i class="fas fa-book"></i> Course  <i class="caret"></i></a></li>
            <li>
             <ul id="collapse1" class="panel-collapse collapse" style="list-style-type:none;"> 
                   <li><a href="TeachedCourses.php">     <i class="fas fa-chalkboard-teacher"></i> Teached Course </a></li>
                   <li><a href="CurrentCourses.php">     <i class="fas fa-book"></i> Currunt Course </a></li>
                   <li><a href="PreviousCourses.php">     <i class="fas fa-book-reader"></i> Previous Course </a></li>
                   <li><a href="RegisterCourses.php">     <i class="fas fa-plus-circle"></i> Register Course </a></li>
            </ul></li>

           <li><a href="Trainee.php">    <i class="fas fa-user-graduate"></i> My Trainee</a></li> 

            <li><a href="Message.php">    <i class="fas fa-envelope-open"></i> Message</a></li>

            <li><a href="Calendar.php">    <i class="fa fa-calendar"></i> Calendar</a></li> 


            <li><a href="" data-toggle="modal" data-target="#support"><i class="fas fa-question-circle"></i> Help and Support</a></li>
  
          </ul>










            
           <ul class="nav navbar-nav navbar-right navbar-user">
              <li class="dropdown user-dropdown" style="margin-right:-50px;"> 
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"></i>
             <i class="fas fa-bell" aria-hidden="true" id="noti_number"></i></a>
          
              <ul class="dropdown-menu">
                <li><a href="Message.php"><i class="fas fa-envelope"></i> Message  </a> </li>
              <?php 
              $sql = "SELECT * FROM message_table ORDER BY msg_id DESC LIMIT 5";
              $result = mysqli_query($conn,$sql);
              echo mysqli_num_rows($result);
           if (mysqli_num_rows($result) > 0) 
             {
    
             while($row=mysqli_fetch_assoc($result)) 
               {
                  $msg_id=$row["msg_id"];
                  $msg_text=$row["msg_text"];
                  $msg_link=$row["msg_link"];
                  echo "<li> <a href='$msg_link'> ".$msg_id." - ".$msg_text."</a> </li>";
               }


            } 
else 
{
    echo "<li>0 results </li>";
}

                ?>  
              </ul>
            </li>















         <ul class="nav navbar-nav navbar-right navbar-user">
              <li class="dropdown user-dropdown"> 
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"></i>
             <i class="fa fa-user "> </i> <?php echo $_SESSION['staff_user'];?>
                 <b class="caret"></b></a>
              <ul class="dropdown-menu">
              <li><a href="StfIndex.php"><i class="fa fa-dashboard"></i> Dashboard </a> </li>
              <li><a href="profile.php"><i class="fas fa-user-circle"></i> Edit My Profile </a> </li>
              <li><a href="Message.php"><i class="fas fa-envelope"></i> Message  </a> </li>
              <li><a href="Calendar.php">    <i class="fa fa-calendar"></i> Calendar</a></li> 
              <li><a href="logout.php"><i class="fa fa-power-off"></i> Log Out</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </nav>



<script type="text/javascript">
 function loadDoc() {
  
  setInterval(function(){

   var xhttp = new XMLHttpRequest();
   xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     document.getElementById("noti_number").innerHTML = this.responseText;
    }
   };
   xhttp.open("GET", "data.php", true);
   xhttp.send();

  },1000);


 }
 loadDoc();
</script>








<div class="modal fade" id="support" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-question-circle"></i> Help and Support</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
         </div>
                <div class="modal-body">
                  <form action="MSG_send.php" method="post">
                    <div class="table-responsive"> 
                     <div class="panel panel-success">
              <div class="panel-heading">
             <center> <img src="img/L4.png"  alt="" style="width: 7rem; height:7rem;"> </center>
              </div>
              <div class="panel-body">
                <div id="morris-chart-area"></div> 
        
        <div >
        <label> TO </label>
        <SELECT  name="to" class="form-control" placeholder="TO" >
                <?php 

    $output ='';
    $sql = "SELECT * FROM admin_table";
    $res = mysqli_query($conn,$sql) ; 
     while ($row=mysqli_fetch_assoc($res))
     {
        $output.='<option value="'.$row["admin_email"].'">'.$row["admin_name"].'</option>' ;  
     }

     echo  $output ;


                ?>  
             </SELECT>
        </div>
        <div >
        <label> Subject </label>
        <input type="text" name="subject" class="form-control" placeholder="Subject" required="required" />
        </div>

        <div >
        <label>Description</label>
        <textarea name="message" class="form-control" placeholder="Write you Message here .... " required="required"></textarea>
        </div>
        <br>
            <button name='send_btn' class='btn btn-block btn-success btn-lg'type="submit"><i class='fas fa-paper-plane'></i>
                      Send  </button>

        </div> 
      </div>

      </div> 

                  </form>
                </div>  
                <div class="modal-footer">  
                </div>  
           </div>  
      </div>  
 </div>  

 <!--End Support Model -->