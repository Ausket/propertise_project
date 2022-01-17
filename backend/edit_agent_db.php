<?php
//เชื่อมต่อฐานข้อมูล
require_once('../dbconnect.php');

//รับค่าที่ส่งมาจากฟอร์มลงในตัวแปร
$id = $_GET["id"];
$name = $_POST["name"];
$email = $_POST["email"];
$tel = $_POST["tel"];
$address = $_POST["address"];
$id_card = $_POST["id_card"];
$company = $_POST["company"];
$birth_date = $_POST["birth_date"];

$file = $_FILES['file']['name'];
//แต่งชื่อไฟล์
$files_v = strrev($file);
$files_r = strrchr($files_v, ".");
$files = strrev($files_r);

$nameDate = date('Ymd'); //เก็บวันที่
$path = "../m_img/"; //สร้างไฟล์สำหรับเก็บไฟล์ใหม่
date_default_timezone_set('Asia/Bangkok');
$numrand = (mt_rand(1000, 9999));
 
//แก้ไขข้อมูล
if ($file != '' ) {
    $type = strrchr($file, "."); //ตัดชื่อไฟล์เหลือแต่นามสกุล
    $newname = $files . $nameDate . $numrand . $type; //ประกอบเป็นชื่อใหม่
    $path_copy = $path . $newname; //กำหนด path ในการเก็บ
    move_uploaded_file($_FILES['file']['tmp_name'], $path_copy);
    

    if (isset($_POST['submit'])) {

        $sql = "UPDATE users SET name='$name',email= '$email',tel='$tel',address='$address',id_card='$id_card',company='$company',birth_date='$birth_date',img='$newname' WHERE u_id = $id";
        
        $result = mysqli_query($con, $sql) or die(mysqli_error($con));

        echo '<script> alert("แก้ไขข้อมูลเรียบร้อย") </script>';
        header("Location:../page/agents.php");
    }
}
if ($file == '' ) {

    if (isset($_POST['submit'])) {

        $sql = "UPDATE users SET name='$name',email= '$email',tel='$tel',address='$address',id_card='$id_card',company='$company',birth_date='$birth_date' WHERE u_id = $id";
        $result = mysqli_query($con, $sql) or die(mysqli_error($con));

        echo '<script> alert("แก้ไขข้อมูลเรียบร้อย") </script>';
        header("Location:../page/agents.php");
    }
}
