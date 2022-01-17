
<?php

require('../dbconnect.php');

$type = $_POST['type'];


$sql = "INSERT INTO advertise_type (type)
VALUES ('$type' )"; 

$result = mysqli_query($con,$sql) or die ;

if($result){
    echo '<script> window.location.href = "../page/advertise_type.php";alert("Insert success")</script>';

}



?>