<?php 

require_once('../dbconnect.php');

 echo $ida = $_POST['ida'];

   $sql = "DELETE FROM favourite WHERE a_id = $ida";
   $result = mysqli_query($con,$sql) or die ;



   ?>