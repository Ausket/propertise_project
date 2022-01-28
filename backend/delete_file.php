<?php
require_once('../dbconnect.php');

$submit = $_GET['submit'];

if ($submit == "DEL") {
    $sql = "DELETE FROM file WHERE f_id='" . $_GET["id"] . "'";
    $result = mysqli_query($con, $sql) or die(mysqli_error($con));


    echo '<script> alert("ลบข้อมูลเรียบร้อย") </script>';
    header("Location:../page/advertise.php");

}
