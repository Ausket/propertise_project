<?php

 require('../dbconnect.php');

$id= $_GET['id'];

$sql = "DELETE FROM advertise WHERE a_id = $id";

$result = mysqli_query($con,$sql) or die(mysqli_error($con)) ;

header("Location:../page/advertise.php");
   


?>