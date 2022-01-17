<?php
//เชื่อมต่อฐานข้อมูล
require_once('../dbconnect.php');

//รับค่าที่ส่งมาจากฟอร์มลงในตัวแปร
$id = $_GET["id"];
$pack_name = $_POST["pack_name"];
$images = $_POST["images"];
$videos = $_POST["videos"];
$period = $_POST["period"];
$page = $_POST["page"];
$boots = $_POST["boots"];
$price = $_POST["price"];

if (isset($_POST['submit'])) {

    //แก้ไขข้อมูล
    $sql = "UPDATE package_type SET pack_name='$pack_name',images= '$images',video='$videos',period='$period',page='$page',boots='$boots',price='$price' WHERE packtype_id = $id";

    $result = mysqli_query($con, $sql);
}
if ($result) {
    echo '<script> alert("แก้ไขข้อมูลเรียบร้อย") </script>';
    header("Location:../page/package_type.php");
} else {
    echo mysqli_error($con);
}
