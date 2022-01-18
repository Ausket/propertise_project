<?php
require('../dbconnect.php');

$title = $_POST['title'];
$note = $_POST['note'];
$a_type = $_POST['type'];


$file = $_FILES['img']['name'];
//แต่งชื่อไฟล์
$files_v = strrev($file);
$files_r = strrchr($files_v, ".");
$files = strrev($files_r);

$nameDate = date('Ymd'); //เก็บวันที่
$path = "../p_img/"; //สร้างไฟล์สำหรับเก็บไฟล์ใหม่
date_default_timezone_set('Asia/Bangkok');
$numrand = (mt_rand(1000, 9999));


if ($file != '') {
    $type = strrchr($file, "."); //ตัดชื่อไฟล์เหลือแต่นามสกุล
    $newname = $files . $nameDate . $numrand . $type; //ประกอบเป็นชื่อใหม่
    $path_copy = $path . $newname; //กำหนด path ในการเก็บ

    move_uploaded_file($_FILES['img']['tmp_name'], $path_copy);

    $sql = "INSERT INTO article(a_title,a_note,a_type,a_img) VALUES('$title','$note','$a_type','$newname') ";
    $result = mysqli_query($con, $sql) or die(mysqli_error($con));

    $sql2 = "SELECT * FROM article ORDER BY a_id DESC LIMIT 1";
    $result2 = mysqli_query($con, $sql2) or die(mysqli_error($con));
    $row2 = mysqli_fetch_assoc($result2);
    $utype = $row2['a_type'];

    if ($utype == 'รีวิว') {
        echo '<script> window.location.href = "../page/reviews.php";alert("เพิ่มข้อมูลสำเร็จ")</script>';
    } else if ($utype == 'บทความ') {
        echo '<script> window.location.href = "../page/articles.php";alert("เพิ่มข้อมูลสำเร็จ")</script>';
    } else {
        echo '<script> window.location.href = "../page/promotion.php";alert("เพิ่มข้อมูลสำเร็จ")</script>';
    }
}


if ($file == '') {

    $sql2 = "INSERT INTO article(a_title,a_note,a_type,a_img) VALUES('$title','$note','$a_type','home.png') ";
    $result2 = mysqli_query($con, $sql2) or die(mysqli_error($con));

    $sql2 = "SELECT * FROM article  ORDER BY a_id DESC LIMIT 1";
    $result2 = mysqli_query($con, $sql2) or die(mysqli_error($con));
    $row2 = mysqli_fetch_assoc($result2);
    $utype = $row2['a_type'];

    if ($utype == 'รีวิว') {
        echo '<script> window.location.href = "../page/reviews.php";alert("เพิ่มข้อมูลสำเร็จ")</script>';
    } else if ($utype == 'บทความ') {
        echo '<script> window.location.href = "../page/articles.php";alert("เพิ่มข้อมูลสำเร็จ")</script>';
    } else {
        echo '<script> window.location.href = "../page/promotion.php";alert("เพิ่มข้อมูลสำเร็จ")</script>';
    }
}
