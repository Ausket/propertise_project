<?php
require('../dbconnect.php');

$id = $_GET["id"];
$ptype = $_POST['ptype'];
$project_name = $_POST['project_name'];
$bedroom = $_POST['bedroom'];
$bathroom = $_POST['bathroom'];
$parking = $_POST['parking'];
$price = $_POST['price'];
$space_area = $_POST['space_area'];
$facility=implode(",",$_POST["facility"]);

$house_no = $_POST['house_no'];
$village_no = $_POST['village_no'];
$lane = $_POST['lane'];
$road = $_POST['road'];
$amphure = $_POST['amphure_id'];
$district = $_POST['district_id'];
$province = $_POST['province_id'];
$postal_code = $_POST['postal_code'];


$file = $_FILES['img']['name'];
//แต่งชื่อไฟล์
$files_v = strrev($file);
$files_r = strrchr($files_v, ".");
$files = strrev($files_r);

$nameDate = date('Ymd'); //เก็บวันที่
$path = "../image/p_img/"; //สร้างไฟล์สำหรับเก็บไฟล์ใหม่
date_default_timezone_set('Asia/Bangkok');
$numrand = (mt_rand(1000, 9999));

if ($file != '') {
    $type = strrchr($file, "."); //ตัดชื่อไฟล์เหลือแต่นามสกุล
    $newname = $files . $nameDate . $numrand . $type; //ประกอบเป็นชื่อใหม่
    $path_copy = $path . $newname; //กำหนด path ในการเก็บ

    move_uploaded_file($_FILES['img']['tmp_name'], $path_copy);

    if (isset($_POST['submit'])) {
               
            $sql2 = "UPDATE location_property SET house_no='$house_no',village_no='$village_no',lane='$lane',road='$road',amphure_id='$amphure',district_id='$district',province_id='$province',postal_code='$postal_code' WHERE l_id = $id ";
            $result2 = mysqli_query($con, $sql2);
            
         

            $sql = "UPDATE property_detail SET ptype_id='$ptype',project_name='$project_name',bedroom='$bedroom',bathroom='$bathroom',parking='$parking',price='$price',img_video='$newname',space_area='$space_area',facility='$facility' WHERE l_id = $id ";
            $result = mysqli_query($con, $sql);
           
            echo '<script> window.location.href = "../page/propertise.php";alert("แก้ไขข้อมูลเรียบร้อย") </script>';
          
           
    }
}

    if ($file == '') {
    
        if (isset($_POST['submit'])) {
                   
            $sql2 = "UPDATE location_property SET house_no='$house_no',village_no='$village_no',lane='$lane',road='$road',amphure_id='$amphure',district_id='$district',province_id='$province',postal_code='$postal_code' WHERE l_id = $id ";
            $result2 = mysqli_query($con, $sql2);
    
                $sql = "UPDATE property_detail SET ptype_id='$ptype',project_name='$project_name',bedroom='$bedroom',bathroom='$bathroom',parking='$parking',price='$price',space_area='$space_area',facility='$facility' WHERE l_id = $id ";
                $result = mysqli_query($con, $sql);
               
                echo '<script> window.location.href = "../page/propertise.php";alert("แก้ไขข้อมูลเรียบร้อย") </script>';

              
               
        }
    
    }

