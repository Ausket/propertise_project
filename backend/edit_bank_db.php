<?php
//เชื่อมต่อฐานข้อมูล
require_once('../dbconnect.php');

//รับค่าที่ส่งมาจากฟอร์มลงในตัวแปร
$id = $_GET["id"];
$name = $_POST["name"];
$loan_amount = $_POST["loan_amount"];
$interest_rate = $_POST["interest_rate"];
$mrr_mlr = $_POST["mrr_mlr"];
$max_loan_amount = $_POST["max_loan_amount"];
$contact = $_POST["contact"];

$file = $_FILES['img']['name'];
//แต่งชื่อไฟล์
$files_v = strrev($file);
$files_r = strrchr($files_v, ".");
$files = strrev($files_r);

$nameDate = date('Ymd'); //เก็บวันที่
$path = "../b_img/"; //สร้างไฟล์สำหรับเก็บไฟล์ใหม่
date_default_timezone_set('Asia/Bangkok');
$numrand = (mt_rand(1000, 9999));

if ($file != '') {
    $type = strrchr($file, "."); //ตัดชื่อไฟล์เหลือแต่นามสกุล
    $newname = $files . $nameDate . $numrand . $type; //ประกอบเป็นชื่อใหม่
    $path_copy = $path . $newname; //กำหนด path ในการเก็บ
    

    move_uploaded_file($_FILES['img']['tmp_name'], $path_copy);
    
    $sql = "UPDATE bank SET b_name='$name',loan_amount= '$loan_amount',interest_rate='$interest_rate',mrr_mlr='$mrr_mlr',max_loan_amount='$max_loan_amount',contact='$contact',img='$newname' WHERE b_id = $id";
    $result = mysqli_query($con, $sql);
    
    header("Location:../page/bank.php");
}
if ($file == '') {
    
    $sql = "UPDATE bank SET b_name='$name',loan_amount= '$loan_amount',interest_rate='$interest_rate',mrr_mlr='$mrr_mlr',max_loan_amount='$max_loan_amount',contact='$contact' WHERE b_id = $id";
    $result = mysqli_query($con, $sql);
    
    header("Location:../page/bank.php");
}



