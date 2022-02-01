<?php 

require_once('../dbconnect.php');

$u_id = $_POST['u_id'];
 
$ida = $_POST['ida'];

$sql = "SELECT * FROM favourite WHERE a_id = $ida";
$result = mysqli_query($con,$sql) or die ;
$num_row = mysqli_num_rows($result);

    if($num_row == 0){
      
   $sql2 = "INSERT INTO `favourite`(`a_id`, `u_id`) 
   VALUES ('$ida','$u_id')"; 

$result2 = mysqli_query($con,$sql2) or die ;     

echo 1;
    }else{

   $sql3 = "DELETE FROM favourite WHERE a_id = $ida";
   $result3 = mysqli_query($con,$sql3) or die ; 
echo 2;
    }


?>
