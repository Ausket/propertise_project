<?php
//เชื่อมต่อฐานข้อมูล
require_once('../dbconnect.php');

//รับค่าที่ส่งมาจากฟอร์มลงในตัวแปร
$id = $_GET["id"];

$title = $_POST['title'];
$note = $_POST['note'];
$a_type = $_POST['type'];

$file = $_FILES['img']['name'];
//แต่งชื่อไฟล์
$files_v = strrev($file);
$files_r = strrchr($files_v, ".");
$files = strrev($files_r);

$nameDate = date('Ymd'); //เก็บวันที่
$path = "../a_img/"; //สร้างไฟล์สำหรับเก็บไฟล์ใหม่
date_default_timezone_set('Asia/Bangkok');
$numrand = (mt_rand(1000, 9999));

if ($file != '') {
    $type = strrchr($file, "."); //ตัดชื่อไฟล์เหลือแต่นามสกุล
    $newname = $files . $nameDate . $numrand . $type; //ประกอบเป็นชื่อใหม่
    $path_copy = $path . $newname; //กำหนด path ในการเก็บ
    

    move_uploaded_file($_FILES['img']['tmp_name'], $path_copy);
    
    $sql = "UPDATE article SET a_title='$title',a_note= '$note',at_id='$a_type',a_img='$newname' WHERE a_id = $id";
    $result = mysqli_query($con, $sql) or die(mysqli_error($con)) ;

    echo '<script> window.location.href = "../page/articles.php";alert("แก้ไขข้อมูลสำเร็จ")</script>';
   
   
}
if ($file == '') {

    $sql = "UPDATE article SET a_title='$title',a_note= '$note',at_id='$a_type' WHERE a_id = $id";
    $result = mysqli_query($con, $sql) or die(mysqli_error($con)) ;
    
     echo '<script> window.location.href = "../page/articles.php";alert("แก้ไขข้อมูลสำเร็จ")</script>';
   
}



