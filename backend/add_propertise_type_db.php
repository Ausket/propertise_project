
<?php

require('../dbconnect.php');

$type = $_POST['type'];


$sql = "INSERT INTO property_type (p_type)
VALUES ('$type' )"; 

$result = mysqli_query($con,$sql) or die ;

if($result){
    echo '<script> window.location.href = "../page/propertise_type.php";alert("เพิ่มข้อมูลสำเร็จ")</script>';

}



?>