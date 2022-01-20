
<?php

require('../dbconnect.php');

$id = $_GET['id'];
$type = $_POST['type'];


$sql = "UPDATE article_type
                SET a_type = '$type'
                 WHERE at_id = '$id' ";
$result = mysqli_query($con, $sql) or die(mysqli_error($con));

echo '<script> window.location.href = "../page/article_type.php";alert("แก้ไขข้อมูลเรียบร้อย") </script>';



?>