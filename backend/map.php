<?php
require_once('../dbconnect.php');

if (isset($_SESSION['a_id'])) {
   $aid = implode(",", $_SESSION['a_id']);
   $sqlb = "SELECT advertise.a_id,advertise.title,advertise.note,advertise.view,advertise_type.type,advertise_type.color,property_detail.project_name,property_detail.bedroom,property_detail.bathroom,property_detail.parking,
property_detail.price,property_detail.space_area,property_detail.img_video,location_property.house_no, location_property.l_id,property_detail.pd_id,advertise.date,
location_property.village_no,location_property.lane,location_property.road,location_property.province_id,location_property.district_id,advertise.ad_status,
location_property.amphure_id,location_property.postal_code,location_property.lat,location_property.lng,property_type.p_type,property_detail.price,property_detail.facility
FROM ((((advertise
LEFT JOIN advertise_type ON advertise.atype_id = advertise_type.atype_id)
LEFT JOIN location_property ON advertise.l_id = location_property.l_id)
LEFT JOIN property_detail ON advertise.pd_id = property_detail.pd_id)
LEFT JOIN property_type ON advertise.ptype_id = property_type.ptype_id)
WHERE advertise.a_id in ($aid) AND advertise.ad_status = '1' ";

   $objQuery = mysqli_query($con, $sqlb);

   $resultArray = array();

   while ($objResult = mysqli_fetch_assoc($objQuery)) {

      array_push($resultArray, $objResult);
   }

   echo json_encode($resultArray);
}
