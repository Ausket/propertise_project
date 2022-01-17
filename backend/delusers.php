<?php

require('../dbconnect.php');

$id = $_GET['id'];

$sql2 = "SELECT * FROM users WHERE u_id = $id";
$result2 = mysqli_query($con, $sql2) ;
$row2= mysqli_fetch_assoc($result2);
$utype = $row2['utype'];


$sql = "DELETE FROM users WHERE u_id = $id";
$result = mysqli_query($con, $sql) or die(mysqli_error($con));


if ($utype == 'member') {

    header("Location:../page/members.php");
}
if ($utype == 'staff') {

    header("Location:../page/staffs.php");
}
if ($utype == 'agent') {

    header("Location:../page/agents.php");
}
