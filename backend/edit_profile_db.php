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


//แก้ไขข้อมูล

$sql = "UPDATE users SET name='$name',email= '$email',tel='$tel',address='$address',id_card='$id_card',company='$company',birth_date='$birth_date' WHERE u_id = $id";
$result = mysqli_query($con, $sql) or die(mysqli_error($con));

$sql2 = "SELECT * FROM users WHERE u_id = $id";
$result2 = mysqli_query($con, $sql2) or die(mysqli_error($con));
$row2 = mysqli_fetch_assoc($result2);
$utype = $row2['utype'];

if ($utype == 'admin') {
    echo '<script> alert("แก้ไขข้อมูลเรียบร้อย") </script>';
    header("Location:../page/profile.php");
}
if ($utype == 'staff') {
    echo '<script> alert("แก้ไขข้อมูลเรียบร้อย") </script>';
    header("Location:../page/profile.php");
}
if($utype == 'member'){
    echo '<script> alert("แก้ไขข้อมูลเรียบร้อย") </script>';
    header("Location:../page/user/profile.php");
}
if($utype == 'agent'){
    echo '<script> alert("แก้ไขข้อมูลเรียบร้อย") </script>';
    header("Location:../page/user/profile.php");
}
