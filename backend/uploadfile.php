<?php
require_once('../dbconnect.php');

if (isset($_GET['File']) == 1) {//เพิ่มไฟล์สำหรับหน้าเอกสาร

$id = $_POST['id'];
$date = $_POST['date'];
date_default_timezone_set('Asia/Bangkok');
$nameDate = date('Ymd'); //เก็บวันที่
$path = "file/"; //สร้างไฟล์สำหรับเก็บไฟล์ใหม่

date_default_timezone_set('Asia/Bangkok');
$numrand = (mt_rand(1000, 9999));

if ($_FILES["file"]["name"][0] == "") {
  echo "<script type='text/javascript'>";
  echo "alert('กรุณาเลือกเพิ่มไฟล์');";
  echo "window.location = '../page/addpropertise.php';";
  echo "</script>";
} else {
  for ($i = 0; $i < count($_FILES["file"]["name"]); $i++) {
    if ($_FILES["file"]["name"][$i] != "") {
      $file[$i] = $_FILES["file"]["name"][$i];
      $files_v[$i] = strrev($file[$i]);
      $files_r[$i] = strrchr($files_v[$i], ".");
      $files[$i] = strrev($files_r[$i]);

      $type[$i] = strrchr($_FILES['file']['name'][$i], "."); //ตัดชื่อไฟล์เหลือแต่นามสกุล
      $newname[$i] = $nameDate . $numrand. $files[$i] . $type[$i]; //ประกอบเป็นชื่อใหม่
      $path_copy[$i] = $path . $newname[$i]; //กำหนด path ในการเก็บ
      move_uploaded_file($_FILES['file']['tmp_name'][$i], $path_copy[$i]);
      $sql = "INSERT INTO file (f_name,f_date,pd_id) 
                   VALUES ('$newname[$i]','$date','$id' )";
      $insert = mysqli_query($con, $sql);
    }
  }

  if ($insert) {

    echo "<script type='text/javascript'>";
    echo "alert('เพิ่มข้อมูลสำเร็จ');";
    echo "window.location = '../page/addpropertise.php';";
    echo "</script>";
  } else {
    echo "มีบางอย่างผิดพลาด!! กรุณาลองใหม่อีกครั้ง";
  }
}
}