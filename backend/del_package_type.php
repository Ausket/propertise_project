<?php

 require('../dbconnect.php');

$id= $_GET['id'];

$sql = "DELETE FROM package_type WHERE packtype_id = $id";

$result = mysqli_query($con,$sql);

if($result){
    header("Location:../page/package_type.php");
    exit(0);
}else{
    echo "เกิดข้อผิดพลาดขึ้น";
} 

?>