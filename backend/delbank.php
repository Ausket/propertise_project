<?php

 require('../dbconnect.php');

$id= $_GET['id'];

$sql = "DELETE FROM bank WHERE b_id = $id";

$result = mysqli_query($con,$sql);

if($result){
    header("Location:../page/bank.php");
    exit(0);
}else{
    echo "เกิดข้อผิดพลาดขึ้น";
} 

?>