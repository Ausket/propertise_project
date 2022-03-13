
<?php

require('../dbconnect.php');

$type = $_POST['type'];
$icon = $_POST['icon'];
$x = "";
$check = "SELECT name FROM user_role_type ";
$qr = mysqli_query($con, $check) or die(mysqli_error($con));
while ($row = mysqli_fetch_array($qr)) {

    if ($row['name'] == $type) {
        echo '<script> window.location.href = "../page/addpage_type.php";alert("ชื่อหมวดหมู่นี้ซ้ำ")</script>';
        $x = 1;
    }
}
if ($x !== 1) {
    $sql = "INSERT INTO user_role_type (name,type_icon)VALUES ('$type','$icon' )";

    $result = mysqli_query($con, $sql) or die(mysqli_error($con));

    if ($result) {
        echo '<script> window.location.href = "../page/page_type.php";alert("เพิ่มข้อมูลสำเร็จ")</script>';
    }
}


?>