<?php
if(!isset($_SESSION)) { 
    session_start(); 
} 
// require('../base_require.php');
require('../config.php');
// require('../connect.php');
require('../dbconnect.php');

$id= $_GET['id'];

$sql = "DELETE FROM pay_status WHERE id = $id";

$result = mysqli_query($con,$sql) or die(mysqli_error($con));

header("Location: ".$base_url."payment_status.php");
   
?>