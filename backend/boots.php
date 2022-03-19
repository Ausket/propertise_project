<?php

require('../dbconnect.php');

$id = $_POST['id'];

date_default_timezone_set('asia/bangkok');
$date = date('Y-m-d H:i:s');

$sql = "UPDATE advertise
                SET date = '$date',num_boots=num_boots+1
                 WHERE a_id = '$id' ";
$result = mysqli_query($con, $sql) or die(mysqli_error($con));

// echo '<script> window.location.href = "../frontend/dashboard-properties.php";alert("ดันประกาศเรียบร้อย") </script>';
