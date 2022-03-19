<?php

require('../dbconnect.php');

$id = $_GET['id'];

$check = "SELECT * FROM article WHERE a_id = $id";
$result2 = mysqli_query($con, $check) or die(mysqli_error($con));
$row = mysqli_fetch_array($result2);
$at = $row['at_id'];

$sql = "DELETE FROM article WHERE a_id = $id";
$result = mysqli_query($con, $sql) or die(mysqli_error($con));

if ($at == '8') {
    header("Location:../page/banner.php");
} else {
    header("Location:../page/articles.php");
}
