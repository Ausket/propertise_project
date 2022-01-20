
<?php

require('../dbconnect.php');

$type = $_POST['type'];


$sql = "INSERT INTO article_type (a_type)
VALUES ('$type' )"; 

$result = mysqli_query($con,$sql) or die ;

if($result){
    echo '<script> window.location.href = "../page/article_type.php";alert("เพิ่มข้อมูลสำเร็จ")</script>';

}



?>