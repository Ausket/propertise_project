<?php

require_once('../dbconnect.php');

$id = $_POST['id'];

$sql = "SELECT COUNT(advertise.pack_id) , package_type.num_ad FROM pay_status
LEFT JOIN advertise ON pay_status.id = advertise.pack_id 
LEFT JOIN package_type ON pay_status.pack_name = package_type.pack_name
WHERE pay_status.id= $id ";

$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);
$all = $row['num_ad'];
$num = $row['COUNT(advertise.pack_id)'];
$remain = $all - $num;

echo $remain;
