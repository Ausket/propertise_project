<?php

 require('../dbconnect.php');

$id= $_GET['id'];

$sql = "DELETE FROM property_detail WHERE l_id = $id";
$sql2 = "DELETE FROM location_property WHERE l_id = $id";

$result = mysqli_query($con,$sql);
$result2 = mysqli_query($con,$sql2);

header("Location:../page/propertise.php");
   


?>