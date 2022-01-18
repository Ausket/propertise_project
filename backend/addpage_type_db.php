
<?php

require('../dbconnect.php');

$type = $_POST['type'];
$icon = $_POST['icon'];

$sql = "INSERT INTO user_role_type (name,type_icon)
        VALUES ('$type','$icon' )";

$result = mysqli_query($con, $sql) or die(mysqli_error($con));

if ($result) {
    echo '<script> window.location.href = "../page/page_type.php";alert("เพิ่มข้อมูลสำเร็จ")</script>';
}




?>