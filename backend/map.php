<?php
require_once('../dbconnect.php');

 $sql  = "SELECT * FROM map";
 $objQuery = mysqli_query($con,$sql);

 $resultArray = array();

 while($objResult = mysqli_fetch_assoc($objQuery))
 
 {

    array_push($resultArray,$objResult);
 }

 echo json_encode($resultArray);



?>