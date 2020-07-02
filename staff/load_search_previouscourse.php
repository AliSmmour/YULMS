<?php
session_start();
include"connect.php";
$table = '' ;
$c = 1; 
$staff_id=$_SESSION['staff_ID'];
if(isset($_POST["search_key"]))
{
  $sdata=$_POST["search_key"];
  if ($_POST['search_key'] !='')
  {

    $table.= "<tr><th colspan=7 class='text-center'>AS Trainer </th> </tr>";
    $sql = "SELECT crs.course_id , course_name,material_link,semester,staff_name
         FROM course_table crs, staff_table stf 
         WHERE course_status=2 AND crs.staff_id=$staff_id  and crs.staff_id=stf.staff_id
          and (course_name Like '%$sdata%' ||  material_link like  '%$sdata%' || semester like  '%$sdata%' || staff_name  like  '%$sdata%')";

   $result = mysqli_query($conn,$sql) ; 
   if(mysqli_num_rows($result)<1)
   {
    $table.='<tr> <th colspan="7" class="text-center"> NO DATA FOUND </th> </tr> ' ;
   }else
   {
     $c = 1; 
    while($row=mysqli_fetch_assoc($result))
    {
      $c_id=$row['course_id'];
      $table.= "<tr><td>".$c." </td>";
      $table.= "<td>".$row['course_name']." </td>";
      $table.= "<td>".$row['semester']." </td>";
      $table.= "<td> <a href='".$row['material_link']."'> ".$row['material_link']." </td>";
      
        $table.= "<td></td>";
        $table.= "<td width='20%'>


    <a class='btn btn-warning' width='48%' href='printCerti.php?c_id=$c_id&role=1'>
          <i class='fas fa-print'> Print Certificate </i>
        </a>
      
        <button name='view' id='$c_id' class='btn btn-info view_data_btn ' width='48%'><i class='fas fa-eye'></i>
         View
        </button>

                  </td>
                 </tr>";

                 $c++;

       }
 }

 $table.= "<tr><th colspan=7 class='text-center'>AS Trainee </th> </tr>";
    $sql2 = "SELECT crs.course_id,course_name,material_link,semester,staff_name
          FROM course_table crs,staff_table stf , take_relation tk
          WHERE course_status=2 and tk.staff_id=$staff_id  and crs.course_id = tk.course_id AND crs.staff_id = stf.staff_id
           and (course_name Like '%$sdata%' ||  material_link like  '%$sdata%' || semester like  '%$sdata%' || staff_name  like  '%$sdata%')";

   $result2 = mysqli_query($conn,$sql2) ; 
   if(mysqli_num_rows($result2)<1)
   {
    $table.='<tr> <th colspan="7" class="text-center"> NO DATA FOUND </th> </tr> ' ;
   }else
   {
     $c = 1; 
    while($row2=mysqli_fetch_assoc($result2))
    {
      $c_id=$row2['course_id'];
      $table.= "<tr><td>".$c." </td>";
      $table.= "<td>".$row2['course_name']." </td>";
      $table.= "<td>".$row2['semester']." </td>";
      $table.= "<td> <a href='".$row2['material_link']."'> ".$row2['material_link']." </td>";
      
        $table.= "<td>".$row2['staff_name']."</td>";
         $table.= "<td width='20%'>

      
        <a class='btn btn-warning' width='48%' href='printCerti.php?c_id=$c_id&role=2'>
          <i class='fas fa-print'> Print Certificate </i>
        </a>
      
        <button name='view' id='$c_id' class='btn btn-info view_data_btn ' width='48%'><i class='fas fa-eye'></i>
         View
        </button>

                  </td>
                 </tr>";
                 $c++;

       }
 }




  }
  else
  {


    $table.= "<tr><th colspan=7 class='text-center'>AS Trainer </th> </tr>";
    $sql = "SELECT crs.course_id , course_name,material_link,semester,staff_name
         FROM course_table crs, staff_table stf 
         WHERE course_status=2 AND crs.staff_id=$staff_id  and crs.staff_id=stf.staff_id
          ";

   $result = mysqli_query($conn,$sql) ; 
   if(mysqli_num_rows($result)<1)
   {
    $table.='<tr> <th colspan="7" class="text-center"> NO DATA FOUND </th> </tr> ' ;
   }else
   {
     $c = 1; 
    while($row=mysqli_fetch_assoc($result))
    {
      $c_id=$row['course_id'];
      $table.= "<tr><td>".$c." </td>";
      $table.= "<td>".$row['course_name']." </td>";
      $table.= "<td>".$row['semester']." </td>";
      $table.= "<td> <a href='".$row['material_link']."'> ".$row['material_link']." </td>";
      
        $table.= "<td></td>";
         $table.= "<td width='20%'>


    <a class='btn btn-warning' width='48%' href='printCerti.php?c_id=$c_id&role=1'>
          <i class='fas fa-print'> Print Certificate </i>
        </a>
      
        <button name='view' id='$c_id' class='btn btn-info view_data_btn ' width='48%'><i class='fas fa-eye'></i>
         View
        </button>

                  </td>
                 </tr>";
                 $c++;

       }
 }

 $table.= "<tr><th colspan=7 class='text-center'>AS Trainee </th> </tr>";
    $sql2 = "SELECT crs.course_id,course_name,material_link,semester,staff_name
          FROM course_table crs,staff_table stf , take_relation tk
          WHERE course_status=2 and tk.staff_id=$staff_id  and crs.course_id = tk.course_id AND crs.staff_id = stf.staff_id
          ";

   $result2 = mysqli_query($conn,$sql2) ; 
   if(mysqli_num_rows($result2)<1)
   {
    $table.='<tr> <th colspan="7" class="text-center"> NO DATA FOUND </th> </tr> ' ;
   }else
   {
     $c = 1; 
    while($row2=mysqli_fetch_assoc($result2))
    {
      $c_id=$row2['course_id'];
      $table.= "<tr><td>".$c." </td>";
      $table.= "<td>".$row2['course_name']." </td>";
      $table.= "<td>".$row2['semester']." </td>";
      $table.= "<td> <a href='".$row2['material_link']."'> ".$row2['material_link']." </td>";
      
        $table.= "<td>".$row2['staff_name']."</td>";
          $table.= "<td width='20%'>

      
        <a class='btn btn-warning' width='48%' href='printCerti.php?c_id=$c_id&role=2'>
          <i class='fas fa-print'> Print Certificate </i>
        </a>
      
        <button name='view' id='$c_id' class='btn btn-info view_data_btn ' width='48%'><i class='fas fa-eye'></i>
         View
        </button>

                  </td>
                 </tr>";

                 $c++;

       }
     }



 
}
     echo $table;
}
?>