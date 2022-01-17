<?php

 require('../dbconnect.php');

$id= $_GET['id'];

$sql = "DELETE FROM advertise WHERE a_id = $id";

$result = mysqli_query($con,$sql);

header("Location:../page/advertise.php");
   


?>