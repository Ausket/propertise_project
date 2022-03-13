
<?php

require('../dbconnect.php');

$type = $_POST['type'];
$x = "";
$check = "SELECT p_type FROM property_type ";
$qr = mysqli_query($con, $check) or die(mysqli_error($con));
while ($row = mysqli_fetch_array($qr)) {

    if ($row['p_type'] == $type) {
        echo '<script> window.location.href = "../page/add_propertise_type.php";alert("ชื่อหมวดหมู่นี้ซ้ำ")</script>';
        $x = 1;
    }
}
if ($x !== 1) {
    $sql = "INSERT INTO property_type (p_type) VALUES ('$type' )";

    $result = mysqli_query($con, $sql) or die;

    if ($result) {
        echo '<script> window.location.href = "../page/propertise_type.php";alert("เพิ่มข้อมูลสำเร็จ")</script>';
    }
}


?>