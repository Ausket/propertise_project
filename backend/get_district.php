<?php

require_once('../dbconnect.php');

$id = $_POST['amphure'];

$sql = "SELECT * FROM districts WHERE amphure_id = $id ";
$result = mysqli_query($con, $sql);

echo '<option value="" selected disabled >เลือกตำบล</option>';

while($row = mysqli_fetch_array($result)){

    echo '<option value="'.$row["id"].'" >'.$row["dname_th"].'</option>';
    
 
} 

?>
