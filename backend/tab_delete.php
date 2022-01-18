<?php

require('../dbconnect.php');

$id = $_GET['id'];

echo $id;

$sql ="DELETE FROM users_role WHERE p_id = $id";
$result = mysqli_query($con,$sql) or die(mysqli_error($con));


    echo '<script> window.location.href = "../page/control.php";</script>';



?>
