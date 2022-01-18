<?php

require('../dbconnect.php');

$id = $_GET['id'];

$sql2 = "SELECT * FROM article WHERE a_id = $id";
$result2 = mysqli_query($con, $sql2) ;
$row2= mysqli_fetch_assoc($result2);
$utype = $row2['a_type'];


$sql = "DELETE FROM article WHERE a_id = $id";
$result = mysqli_query($con, $sql) or die(mysqli_error($con));


if ($utype == 'รีวิว') {

    header("Location:../page/reviews.php");
}
if ($utype == 'บทความ') {

    header("Location:../page/articles.php");
}
if ($utype == 'โปรโมชั่น') {

    header("Location:../page/promotion.php");
}
