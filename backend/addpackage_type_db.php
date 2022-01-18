<?php
require('../dbconnect.php');

$pack_name = $_POST['pack_name'];
$images = $_POST['images'];
$videos = $_POST['videos'];
$period = $_POST['period'];
$page = $_POST['page'];
$boots = $_POST['boots'];
$price = $_POST['price'];

if (isset($_POST['submit'])) {
    $sql = "INSERT INTO package_type(pack_name,images,video,period,page,boots,price) VALUES('$pack_name','$images','$videos','$period','$page','$boots','$price') ";

    $result = mysqli_query($con, $sql) or die(mysqli_error($con));

    echo '<script> window.location.href = "../page/package_type.php";alert("เพิ่มข้อมูลสำเร็จ")</script>';
}


    
   
