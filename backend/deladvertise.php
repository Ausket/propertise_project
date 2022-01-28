<?php

 require('../dbconnect.php');

$ida = $_SESSION['u_id'];
$id= $_GET['id'];

$sql = "DELETE FROM advertise WHERE a_id = $id";

$result = mysqli_query($con,$sql) or die(mysqli_error($con)) ;
   
$sql6 = "SELECT * FROM users WHERE u_id = $ida";
$result6 = mysqli_query($con, $sql6) or die(mysqli_error($con));
$row6 = mysqli_fetch_assoc($result6);
$utype = $row6['utype'];

if ($utype == 'admin') {
    echo "<script>";
    echo " alert('ลบข้อมูลเรียบร้อย')";
    echo " </script>";
    header('Refresh:0; url=../page/advertise.php');
}
if ($utype == 'staff') {
    echo "<script>";
    echo " alert('ลบข้อมูลเรียบร้อย')";
    echo " </script>";
    header('Refresh:0; url=../page/advertise.php');
}
if ($utype == 'member') {
    echo "<script>";
    echo " alert('ลบข้อมูลเรียบร้อย')";
    echo " </script>";
    header('Refresh:0; url=../frontend/dashboard-properties.php');
}
if ($utype == 'agent') {
    echo "<script>";
    echo " alert('ลบข้อมูลเรียบร้อย')";
    echo " </script>";
    header('Refresh:0; url=../frontend/dashboard-properties.php');
}         

?>