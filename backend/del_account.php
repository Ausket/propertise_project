<?php

require('../dbconnect.php');

$id = $_GET['id'];

$sql = "DELETE FROM users WHERE u_id = $id";
$result = mysqli_query($con, $sql) or die(mysqli_error($con));

echo "<script>";
echo " alert('ลบข้อมูลเรียบร้อย')";
echo " </script>";
header('Refresh:0; url=../index.php');

session_destroy();
