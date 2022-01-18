<?php

 require('../dbconnect.php');

$id= $_GET['id'];

$sql = "DELETE FROM property_type WHERE ptype_id = $id";

$result = mysqli_query($con,$sql) or die(mysqli_error($con)) ;

header("Location:../page/propertise_type.php");
   

?>