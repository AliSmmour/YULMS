<?php
include 'connect.php';
$sql = "SELECT * FROM message_table";
$result = mysqli_query($conn,$sql);

echo mysqli_num_rows($result);

?>