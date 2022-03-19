<?php

 require('../dbconnect.php');

$id= $_GET['id'];

$sql = "UPDATE advertise SET ad_status = '3' WHERE a_id = $id";

$result = mysqli_query($con,$sql) or die(mysqli_error($con)) ;
   

    echo "<script>";
    echo " alert('เปลี่ยนสถานะเป็นขายแล้ว')";
    echo " </script>";
    header('Refresh:0; url=../frontend/dashboard-properties.php');
