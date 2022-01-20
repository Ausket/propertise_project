<?php

require('../dbconnect.php');

$id = $_GET['id'];


$sql = "DELETE FROM article WHERE a_id = $id";
$result = mysqli_query($con, $sql) or die(mysqli_error($con));

header("Location:../page/articles.php");
