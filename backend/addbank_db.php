<?php
require('../dbconnect.php');

$name = $_POST['name'];
$loan_amount = $_POST['loan_amount'];
$interest_rate = $_POST['interest_rate'];
$mrr_mlr = $_POST['mrr_mlr'];
$max_loan_amount = $_POST['max_loan_amount'];
$contact = $_POST['contact'];

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

  $sql = "INSERT INTO bank(b_name,loan_amount,interest_rate,mrr_mlr,max_loan_amount,contact,img) VALUES('$name','$loan_amount','$interest_rate','$mrr_mlr','$max_loan_amount','$contact','$newname') ";
  $result = mysqli_query($con, $sql) or die;
}else{
  echo '<script> window.location.href = "../page/bank.php";alert("เพิ่มข้อมูลสำเร็จ")</script>';
}

if ($file == '') {

  $sql2 = "INSERT INTO bank(b_name,loan_amount,interest_rate,mrr_mlr,max_loan_amount,contact,img) VALUES('$name','$loan_amount','$interest_rate','$mrr_mlr','$max_loan_amount','$contact','bank.png') ";
  $result2 = mysqli_query($con, $sql2) or die;
}else{
  echo '<script> window.location.href = "../page/bank.php";alert("เพิ่มข้อมูลสำเร็จ")</script>';
}



