
<?php

require('../dbconnect.php');

$type = $_POST['type'];
$color = $_POST['color'];
$x = "";
$check = "SELECT type,color FROM advertise_type ";
$qr = mysqli_query($con, $check) or die(mysqli_error($con));
while ($row = mysqli_fetch_array($qr)) {

    if ($row['type'] == $type) {
        echo '<script> window.location.href = "../page/add_advertise_type.php";alert("ชื่อหมวดหมู่นี้ซ้ำ")</script>';
        $x = 1;
    }
    if ($row['color'] == $color) {
        echo '<script> window.location.href = "../page/add_advertise_type.php";alert("สีนี้ถูกใช้ไปแล้ว")</script>';
        $x = 1;
    }
}
if ($x !== 1) {
    $sql = "INSERT INTO advertise_type (type,color)
VALUES ('$type','$color' )";

    $result = mysqli_query($con, $sql) or die;

    if ($result) {
        echo '<script> window.location.href = "../page/advertise_type.php";alert("เพิ่มข้อมูลสำเร็จ")</script>';
    }
}

?>