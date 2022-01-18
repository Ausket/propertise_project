<?php

 require('../dbconnect.php');

$id= $_GET['id'];

$sql = "DELETE FROM bank WHERE b_id = $id";

$result = mysqli_query($con,$sql) or die(mysqli_error($con));

header("Location:../page/bank.php");
   

?>