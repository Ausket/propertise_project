<?php

require_once('../../dbconnect.php');
// echo '222';
$id = $_POST['pack'];

$sql = "SELECT * FROM package_type WHERE packtype_id = $id ";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);
$price = $row['price'];

echo $price ; 

?>