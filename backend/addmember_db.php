<?php
require('../dbconnect.php');

$email = $_POST['email'];
$password = $_POST['password'];
$name = $_POST['name'];
$tel = $_POST['tel'];
$address = $_POST['address'];
$birth_date = $_POST['birth_date'];
$id_card = $_POST['id_card'];

$x = "";
$check = "SELECT * FROM users";
$result = mysqli_query($con, $check);
$file = $_FILES['file']['name'];
//แต่งชื่อไฟล์
$files_v = strrev($file);
$files_r = strrchr($files_v, ".");
$files = strrev($files_r);

$nameDate = date('Ymd'); //เก็บวันที่
$path = "../m_img/"; //สร้างไฟล์สำหรับเก็บไฟล์ใหม่
date_default_timezone_set('Asia/Bangkok');
$numrand = (mt_rand(1000, 9999));

if ($file != '') {
    $type = strrchr($file, "."); //ตัดชื่อไฟล์เหลือแต่นามสกุล
    $newname = $files . $nameDate . $numrand . $type; //ประกอบเป็นชื่อใหม่
    $path_copy = $path . $newname; //กำหนด path ในการเก็บ

    move_uploaded_file($_FILES['file']['tmp_name'], $path_copy);

    if (isset($_POST['submit'])) {
        while ($row = mysqli_fetch_array($result)) {
            if ($_POST['email'] == $row['email']) {
                echo "<script>";
                echo "alert(\" email นี้ถูกใช้ไปแล้ว\");";
                echo "</script>";
                header('Refresh:0; url=../page/addmember.php');
                $x = 1;
            }
            if ($_POST['tel'] == $row['tel']) {
                echo "<script>";
                echo "alert(\" เบอร์นี้ถูกใช้ไปแล้ว\");";
                echo "</script>";
                header('Refresh:0; url=../page/addmember.php');
                $x = 1;
            }
            if ($_POST['id_card'] == $row['id_card']) {
                echo "<script>";
                echo "alert(\" เลขบัตรประชาชนนี้ถูกใช้ไปแล้ว\");";
                echo "</script>";
                header('Refresh:0; url=../page/addmember.php');
                $x = 1;
            }
        }
        if ($x !== 1) {
            $sql = "INSERT INTO users(email,password,name,tel,address,utype,img,birth_date,id_card) VALUES('$email','$password','$name','$tel','$address','member','$newname','$birth_date','$id_card') ";

            $result2 = mysqli_query($con, $sql)or die(mysqli_error($con));
            header("Location:../page/members.php");
        }

    }
} else {
    if (isset($_POST['submit'])) {
        while ($row = mysqli_fetch_array($result)) {
            if ($_POST['email'] == $row['email']) {
                echo "<script>";
                echo "alert(\" email นี้ถูกใช้ไปแล้ว\");";
                echo "</script>";
                header('Refresh:0; url=../page/addmember.php');
                $x = 1;
            }
            if ($_POST['tel'] == $row['tel']) {
                echo "<script>";
                echo "alert(\" เบอร์นี้ถูกใช้ไปแล้ว\");";
                echo "</script>";
                header('Refresh:0; url=../page/addmember.php');
                $x = 1;
            }
            if ($_POST['id_card'] == $row['id_card']) {
                echo "<script>";
                echo "alert(\" เลขบัตรประชาชนนี้ถูกใช้ไปแล้ว\");";
                echo "</script>";
                header('Refresh:0; url=../page/addmember.php');
                $x = 1;
            }
        }
        if ($x !== 1) {
            $sql2 = "INSERT INTO users(email,password,name,tel,address,utype,img,birth_date,id_card) VALUES('$email','$password','$name','$tel','$address','member','user.png','$birth_date','$id_card') ";

            $result2 = mysqli_query($con, $sql2)or die(mysqli_error($con));
            header("Location:../page/members.php");
            
        }
       
    }
}
