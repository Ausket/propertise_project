<?php
require('../dbconnect.php');

$id = $_SESSION['u_id'];
$ptype = $_POST['ptype'];
$project_name = $_POST['project_name'];
$bedroom = $_POST['bedroom'];
$bathroom = $_POST['bathroom'];
$parking = $_POST['parking'];
$price = $_POST['price'];
$space_area = $_POST['space_area'];

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
$path = "../p_img/"; //สร้างไฟล์สำหรับเก็บไฟล์ใหม่
date_default_timezone_set('Asia/Bangkok');
$numrand = (mt_rand(1000, 9999));

// --------------------------------------------------------

$date = $_POST['date'];
$nameDateT = date('Ymd'); //เก็บวันที่
$pathT = "../file/"; //สร้างไฟล์สำหรับเก็บไฟล์ใหม่
$numrandT = (mt_rand(1000, 9999));


if ($file != '') {
    $type = strrchr($file, "."); //ตัดชื่อไฟล์เหลือแต่นามสกุล
    $newname = $files . $nameDate . $numrand . $type; //ประกอบเป็นชื่อใหม่
    $path_copy = $path . $newname; //กำหนด path ในการเก็บ

    move_uploaded_file($_FILES['img']['tmp_name'], $path_copy);

    if (isset($_POST['submit'])) {

        $sql2 = "INSERT INTO location_property(house_no,village_no,lane,road,district_id,amphure_id,province_id,postal_code,u_id) VALUES('$house_no','$village_no','$lane','$road','$district','$amphure','$province','$postal_code','$id') ";
        $result2 = mysqli_query($con, $sql2);

        $sql3 = "SELECT * FROM location_property ORDER BY l_id DESC LIMIT 1";
        $result3 = mysqli_query($con, $sql3);
        $row3 = mysqli_fetch_assoc($result3);
        $l_id = $row3['l_id'];

        $sql = "INSERT INTO property_detail(ptype_id,l_id,project_name,bedroom,bathroom,parking,price,img_video,space_area,u_id) VALUES('$ptype','$l_id','$project_name','$bedroom','$bathroom','$parking','$price','$newname','$space_area','$id') ";
        $result = mysqli_query($con, $sql) or die(mysqli_error($con));;

        if ($_FILES["file"]["name"][0] == "") {
            echo "<script type='text/javascript'>";
            echo "alert('กรุณาเลือกเพิ่มไฟล์');";
            echo "window.location = '../page/addpropertise.php';";
            echo "</script>";
        } else {
            for ($i = 0; $i < count($_FILES["file"]["name"]); $i++) {
                if ($_FILES["file"]["name"][$i] !== '') {
                    $fileT[$i] = $_FILES["file"]["name"][$i];
                    $filesT[$i] = pathinfo($fileT[$i], PATHINFO_FILENAME);

                    $typeT[$i] = strrchr($_FILES['file']['name'][$i], "."); //ตัดชื่อไฟล์เหลือแต่นามสกุล
                    $newnameT[$i] = $filesT[$i] . $nameDateT . $numrandT . $typeT[$i]; //ประกอบเป็นชื่อใหม่
                    $path_copyT[$i] = $pathT . $newnameT[$i]; //กำหนด path ในการเก็บ

                    move_uploaded_file($_FILES['file']['tmp_name'][$i], $path_copyT[$i]);

                    $sql = "INSERT INTO file (f_name,f_date,pd_id) 
                               VALUES ('$newnameT[$i]','$date','$l_id' )";
                    $insert = mysqli_query($con, $sql) or die(mysqli_error($con));
                }
            }
        }

        echo '<script> window.location.href = "../page/propertise.php";alert("เพิ่มข้อมูลสำเร็จ")</script>';
    }
} else {
    if (isset($_POST['submit'])) {

        $sql2 = "INSERT INTO location_property(house_no,village_no,lane,road,district_id,amphure_id,province_id,postal_code,u_id) VALUES('$house_no','$village_no','$lane','$road','$district','$amphure','$province','$postal_code','$id') ";
        $result2 = mysqli_query($con, $sql2);

        $sql3 = "SELECT * FROM location_property ORDER BY l_id DESC LIMIT 1";
        $result3 = mysqli_query($con, $sql3);
        $row3 = mysqli_fetch_assoc($result3);
        $l_id = $row3['l_id'];

        $sql = "INSERT INTO property_detail(ptype_id,l_id,project_name,bedroom,bathroom,parking,price,img_video,space_area,u_id) VALUES('$ptype','$l_id','$project_name','$bedroom','$bathroom','$parking','$price','home.png','$space_area','$id') ";
        $result = mysqli_query($con, $sql) or die(mysqli_error($con));

        if ($_FILES["file"]["name"][0] == "") {
            echo "<script type='text/javascript'>";
            echo "alert('กรุณาเลือกเพิ่มไฟล์');";
            echo "window.location = '../page/addpropertise.php';";
            echo "</script>";
        } else {

            for ($i = 0; $i < count($_FILES["file"]["name"]); $i++) {
                if ($_FILES["file"]["name"][$i] !== '') {
                    $fileT[$i] = $_FILES["file"]["name"][$i];
                    $filesT[$i] = pathinfo($fileT[$i], PATHINFO_FILENAME);

                    $typeT[$i] = strrchr($_FILES['file']['name'][$i], "."); //ตัดชื่อไฟล์เหลือแต่นามสกุล
                    $newnameT[$i] = $filesT[$i] . $nameDateT . $numrandT . $typeT[$i]; //ประกอบเป็นชื่อใหม่
                    $path_copyT[$i] = $pathT . $newnameT[$i]; //กำหนด path ในการเก็บ

                    move_uploaded_file($_FILES['file']['tmp_name'][$i], $path_copyT[$i]);

                    $sql = "INSERT INTO file (f_name,f_date,pd_id) 
                           VALUES ('$newnameT[$i]','$date','$l_id' )";
                    $insert = mysqli_query($con, $sql) or die(mysqli_error($con));
                }
            }
        }
        echo '<script> window.location.href = "../page/propertise.php";alert("เพิ่มข้อมูลสำเร็จ")</script>';
    }
}
