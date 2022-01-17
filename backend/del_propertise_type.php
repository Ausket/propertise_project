<?php

 require('../dbconnect.php');

$id= $_GET['id'];

$sql = "DELETE FROM property_type WHERE ptype_id = $id";

$result = mysqli_query($con,$sql);

if($result){
    header("Location:../page/propertise_type.php");
    exit(0);
}else{
    echo "เกิดข้อผิดพลาดขึ้น";
} 

?>