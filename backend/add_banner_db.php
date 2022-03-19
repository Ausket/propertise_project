<?php
require('../dbconnect.php');

$title = $_POST['title'];
$note = $_POST['note'];
// $a_type = $_POST['type'];


$file = $_FILES['img']['name'];
//แต่งชื่อไฟล์
$files_v = strrev($file);
$files_r = strrchr($files_v, ".");
$files = strrev($files_r);

$nameDate = date('Ymd'); //เก็บวันที่
$path = "../image/a_img/"; //สร้างไฟล์สำหรับเก็บไฟล์ใหม่
date_default_timezone_set('Asia/Bangkok');
$numrand = (mt_rand(1000, 9999));


if ($file != '') {
    $type = strrchr($file, "."); //ตัดชื่อไฟล์เหลือแต่นามสกุล
    $newname = $files . $nameDate . $numrand . $type; //ประกอบเป็นชื่อใหม่
    $path_copy = $path . $newname; //กำหนด path ในการเก็บ

    move_uploaded_file($_FILES['img']['tmp_name'], $path_copy);


    $sql = "INSERT INTO article(a_title,a_note,at_id,a_img) VALUES('$title','$note','8','$newname') ";
    $result = mysqli_query($con, $sql) or die(mysqli_error($con));


    echo '<script> window.location.href = "../page/banner.php";alert("เพิ่มข้อมูลสำเร็จ")</script>';
} else {

    $sql = "INSERT INTO article(a_title,a_note,at_id) VALUES('$title','$note','8') ";
    $result = mysqli_query($con, $sql) or die(mysqli_error($con));


    echo '<script> window.location.href = "../page/banner.php";alert("เพิ่มข้อมูลสำเร็จ")</script>';
}
