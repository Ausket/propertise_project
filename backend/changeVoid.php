<?php

require('../dbconnect.php');

echo $id = $_POST['id'];
echo $note = $_POST['note'];

$sql = "UPDATE pay_status SET void_note='$note',void ='1' WHERE referenceNo = '$id'";
$result = mysqli_query($con, $sql) or die(mysqli_error($con));

// echo json_encode($result);
