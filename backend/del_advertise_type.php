<?php

 require('../dbconnect.php');

$id= $_GET['id'];

$sql = "DELETE FROM advertise_type WHERE atype_id = $id";

$result = mysqli_query($con,$sql);

if($result){
    header("Location:../page/advertise_type.php");
    exit(0);
}else{
    echo "เกิดข้อผิดพลาดขึ้น";
} 

?>