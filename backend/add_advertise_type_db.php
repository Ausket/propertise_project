
<?php

require('../dbconnect.php');

$type = $_POST['type'];
$color= $_POST['color'];

$sql = "INSERT INTO advertise_type (type,color)
VALUES ('$type','$color' )"; 

$result = mysqli_query($con,$sql) or die ;

if($result){
    echo '<script> window.location.href = "../page/advertise_type.php";alert("เพิ่มข้อมูลสำเร็จ")</script>';

}



?>