<?php

require('../dbconnect.php');

$id = $_GET['id'];

echo $id;

$sql ="DELETE FROM users_role WHERE p_id = $id";
$result = mysqli_query($con,$sql);

if($result){
    echo '<script> window.location.href = "../page/control.php";</script>';

} 

?>
