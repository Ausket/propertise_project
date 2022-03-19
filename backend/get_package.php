<?php

require_once('../dbconnect.php');

$id = $_POST['id'];

$sql = "SELECT * FROM pay_status 
LEFT JOIN package_type ON pay_status.pack_name = package_type.pack_name 
WHERE id = $id ";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);

echo $row['images'];
