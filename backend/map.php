<?php

session_start();
 $con=mysqli_connect("localhost","root","123456","propertise") or die("เชื่อมต่อผิดพลาด"); 
/* $con=mysqli_connect("localhost","fininsure_pond","gU7kxBrBX9","fininsure_pond") or die("เชื่อมต่อผิดพลาด");
 */

 $sql  = "SELECT * FROM location_property";
 $objQuery = mysqli_query($con,$sql);

 $resultArray = array();

 while($objResult = mysqli_fetch_assoc($objQuery))
 
 {

    array_push($resultArray,$objResult);
 }

 echo json_encode($resultArray);



?>