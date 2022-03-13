<?php
require_once('../dbconnect.php');

$sql = "SELECT *
FROM advertise
LEFT JOIN location_property ON advertise.l_id = location_property.l_id
LEFT JOIN property_detail ON advertise.pd_id = property_detail.pd_id
INNER  JOIN provinces ON location_property.province_id = provinces.id
INNER  JOIN amphures ON location_property.amphure_id = amphures.id
INNER JOIN districts ON location_property.district_id = districts.id 
WHERE advertise.ad_status = '1' ";

 $objQuery = mysqli_query($con,$sql);

 $resultArray = array();

 while($objResult = mysqli_fetch_assoc($objQuery))
 
 {

    array_push($resultArray,$objResult);
 }

 echo json_encode($resultArray);
