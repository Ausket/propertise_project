<?php

 require('../dbconnect.php');

$id= $_GET['id'];

$sql = "DELETE FROM package_type WHERE packtype_id = $id";

$result = mysqli_query($con,$sql) or die(mysqli_error($con)) ;

header("Location:../page/package_type.php");
  


?>