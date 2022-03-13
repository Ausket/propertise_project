<?php

require('../dbconnect.php');

$id = $_GET['id'];
$type = $_POST['type'];
$color = $_POST['color'];
$x = "";
$check = "SELECT type,color FROM advertise_type ";
$qr = mysqli_query($con, $check) or die(mysqli_error($con));
while ($row = mysqli_fetch_array($qr)) {

    if ($row['type'] == $type) {
        echo '<script> window.location.href = "../page/edit_advertise_type.php?id='.$id.'";alert("ชื่อหมวดหมู่นี้ซ้ำ")</script>';
        $x = 1;
    }
    if ($row['color'] == $color) {
        echo '<script> window.location.href = "../page/edit_advertise_type.php?id='.$id.'";alert("สีนี้ถูกใช้ไปแล้ว")</script>';
        $x = 1;
    }
}
if ($x !== 1) {

    $sql = "UPDATE advertise_type
                SET type = '$type', color = '$color'
                 WHERE atype_id = '$id' ";
    $result = mysqli_query($con, $sql) or die(mysqli_error($con));

    echo '<script> window.location.href = "../page/advertise_type.php";alert("แก้ไขข้อมูลเรียบร้อย") </script>';
}
