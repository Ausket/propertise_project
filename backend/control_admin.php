<?php
//เชื่อมต่อฐานข้อมูล
require('../dbconnect.php');

$id = $_POST['status_id'];



$sql ="SELECT * FROM users_role WHERE p_id = '$id' ";
$result = mysqli_query($con, $sql);
while ($row = mysqli_fetch_array($result)){

if($row['admin'] == '1'){
        
        $sql2 = "UPDATE users_role SET admin = '0' WHERE p_id =  '$id'";

        $result2 = mysqli_query($con, $sql2) ;
        
       

}else{             
        $sql3 = "UPDATE users_role SET admin = '1' WHERE p_id =  '$id'";

        $result3 = mysqli_query($con, $sql3) ;
} 

}
