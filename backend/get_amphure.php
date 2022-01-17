<?php

require_once('../dbconnect.php');

$id = $_POST['province'];

$sql = "SELECT * FROM amphures WHERE province_id = $id ";
$result = mysqli_query($con, $sql);

echo '<option value="" selected disabled class="text-center">เลือกอำเภอ</option>';

while($row = mysqli_fetch_array($result)){

    echo '<option value="'.$row["id"].'" class="text-center">'.$row["aname_th"].'</option>';
    
 
} 

?>
