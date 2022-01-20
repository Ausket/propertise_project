<?php
require_once('../dbconnect.php');

$ida = $_SESSION['u_id'];
$submit = $_GET['submit'];

if ($submit == "DEL") {
    $sql = "DELETE FROM file WHERE f_id='" . $_GET["id"] . "'";
    $result = mysqli_query($con, $sql) or die(mysqli_error($con));

    $sql6 = "SELECT * FROM users WHERE u_id = $ida";
    $result6 = mysqli_query($con, $sql6) or die(mysqli_error($con));
    $row6 = mysqli_fetch_assoc($result6);
    $utype = $row6['utype'];

    if ($utype == 'admin') {
        echo '<script> alert("แก้ไขข้อมูลเรียบร้อย") </script>';
        header("Location:../page/advertise.php");
    }
    if ($utype == 'staff') {
        echo '<script> alert("แก้ไขข้อมูลเรียบร้อย") </script>';
        header("Location:../page/advertise.php");
    }
    if ($utype == 'member') {
        echo '<script> alert("แก้ไขข้อมูลเรียบร้อย") </script>';
        header("Location:../page/user/advertise.php");
    }
    if ($utype == 'agent') {
        echo '<script> alert("แก้ไขข้อมูลเรียบร้อย") </script>';
        header("Location:../page/user/advertise.php");
    }
}
