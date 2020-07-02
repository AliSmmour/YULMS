<?php

if (empty($_SESSION['ID']))
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
          <a class="navbar-brand" style="font-family: 'Do Hyeon', sans-serif;" href="AdmIndex.php">

                <img src="img/L4.png"  alt="" style="height: 5rem; width: 5rem;">
                 <span>Admin YU LMS </span>
                    </a>
                    
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav side-nav">
            <li  class=""><a href="AdmIndex.php">       <i class="fa fa-dashboard"></i> Dashboard</a></li>

            <li><a href="Trainers.php">       <i class='fas fa-chalkboard-teacher'></i> Trainers</a></li>
      
            <li><a href="Trainee.php">      <i class="fas fa-user-graduate"></i> Trainee </a></li>

            <li><a href="addStaff.php">    <i class="fas fa-user-plus"></i> Add Staff</a></li>

            <li><a href="Course.php">     <i class="fas fa-book"></i> Course </a></li>

            <li><a href="Addcourse.php">    <i class="fas fa-book-medical"></i> Add Course</a></li>
     
            <li><a href="Reportview.php">      <i class="fas fa-scroll"></i> Report</a></li>

            <li><a href="Message.php">    <i class="fas fa-envelope-open"></i> Message</a></li>

            <li><a href="Calendar.php">    <i class="fa fa-calendar"></i> Calendar</a></li> 

           


              

            


          </ul>

          <ul class="nav navbar-nav navbar-right navbar-user">
              <li class="dropdown user-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user "></i> <?php echo $_SESSION['txtuser'];?>
                 <b class="caret"></b></a>
              <ul class="dropdown-menu">
              <li><a href="AdmIndex.php"><i class="fa fa-dashboard"></i> Dashboard </a> </li>
              <li><a href="profile.php"><i class="fas fa-user-circle"></i> Edit My Profile </a> </li>
              <li><a href="Calendar.php">    <i class="fa fa-calendar"></i> Calendar</a></li> 
              <li><a href="logout.php"><i class="fa fa-power-off"></i> Log Out</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </nav>
