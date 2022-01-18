
<?php

require('../dbconnect.php');

$name = $_POST['name'];
$file = $_POST['file'];
$icon = 'nav-icon'." ".$_POST['icon'];
$type = $_POST['ptype'];


$sql = "INSERT INTO users_role (page, link, icon , type)
VALUES ('$name', '$file', '$icon', '$type')"; 

$result = mysqli_query($con,$sql) or die ;


echo '<script> window.location.href = "../page/control.php";alert("เพิ่มข้อมูลสำเร็จ")</script>';





?>