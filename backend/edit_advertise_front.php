<?php
require('../dbconnect.php');

$id = $_GET['id'];
$ids = $_SESSION['u_id'];
$ptype = $_POST['ptype'];
$project_name = $_POST['project_name'];
$bedroom = $_POST['bedroom'];
$bathroom = $_POST['bathroom'];
$parking = $_POST['parking'];
$price = $_POST['price'];
$space_area = $_POST['space_area'];
$facility = implode(",", $_POST["facility"]);

$house_no = $_POST['house_no'];
$village_no = $_POST['village_no'];
$lane = $_POST['lane'];
$road = $_POST['road'];
$district = $_POST['district_id'];
$amphure = $_POST['amphure_id'];
$province = $_POST['province_id'];
$postal_code = $_POST['postal_code'];

$atype = $_POST['atype'];
$title = $_POST['title'];
$describe = $_POST['describe'];

$file = $_FILES['img']['name'];
//แต่งชื่อไฟล์
$files_v = strrev($file);
$files_r = strrchr($files_v, ".");
$files = strrev($files_r);

$nameDate = date('Ymd'); //เก็บวันที่
$path = "../image/p_img/"; //สร้างไฟล์สำหรับเก็บไฟล์ใหม่
date_default_timezone_set('Asia/Bangkok');
$numrand = (mt_rand(1000, 9999));

// --------------------------------------------------------

$nameDateT = date('Ymd'); //เก็บวันที่
$pathT = "../file/"; //สร้างไฟล์สำหรับเก็บไฟล์ใหม่
$numrandT = (mt_rand(1000, 9999));
$date = $_POST['date'];


if ($file != '') {
    $type = strrchr($file, "."); //ตัดชื่อไฟล์เหลือแต่นามสกุล
    $newname = $files . $nameDate . $numrand . $type; //ประกอบเป็นชื่อใหม่
    $path_copy = $path . $newname; //กำหนด path ในการเก็บ

    move_uploaded_file($_FILES['img']['tmp_name'], $path_copy);

    if (isset($_POST['submit1'])) {

        $sql5 = "SELECT * FROM advertise WHERE a_id =$id";
        $result5 = mysqli_query($con, $sql5);
        $row5 = mysqli_fetch_assoc($result5);
        $l_id = $row5['l_id'];
        $p_id = $row5['pd_id'];

        $sql2 = "UPDATE location_property SET house_no='$house_no',village_no='$village_no',lane='$lane',road='$road',district_id='$district',amphure_id='$amphure',province_id='$province',postal_code='$postal_code' WHERE l_id = $l_id ";
        $result2 = mysqli_query($con, $sql2);


        $sql = "UPDATE property_detail SET ptype_id='$ptype',project_name='$project_name',bedroom='$bedroom',bathroom='$bathroom',parking='$parking',price='$price',img_video='$newname',space_area='$space_area',facility='$facility' WHERE l_id = $l_id ";
        $result = mysqli_query($con, $sql);


        $sql4 = "UPDATE advertise SET atype_id='$atype',ptype_id='$ptype',pd_id='$p_id',l_id='$l_id',title='$title',note='$describe',ad_status ='2' WHERE a_id = $id ";
        $result4 = mysqli_query($con, $sql4) or die(mysqli_error($con));;


        if (isset($_FILES["file"])) {

            for ($i = 0; $i < count($_FILES["file"]["name"]); $i++) {
                if (isset($_FILES["file"]["name"][$i]) !== '') {
                    $fileT[$i] = $_FILES["file"]["name"][$i];
                    $filesT[$i] = pathinfo($fileT[$i], PATHINFO_FILENAME);

                    $typeT[$i] = strrchr($_FILES['file']['name'][$i], "."); //ตัดชื่อไฟล์เหลือแต่นามสกุล
                    $newnameT[$i] = $filesT[$i] . $nameDateT . $numrandT . $typeT[$i]; //ประกอบเป็นชื่อใหม่
                    $path_copyT[$i] = $pathT . $newnameT[$i]; //กำหนด path ในการเก็บ

                    move_uploaded_file($_FILES['file']['tmp_name'][$i], $path_copyT[$i]);

                    $sql = "INSERT INTO file (f_name,f_date,pd_id) 
                               VALUES ('$newnameT[$i]','$date','$p_id')";
                    $insert = mysqli_query($con, $sql) or die(mysqli_error($con));
                }
            }


            echo "<script>";
            echo "alert(\"แก้ไขข้อมูลเรียบร้อย\")";
            echo "</script>";
            header('Refresh:0; url=../frontend/dashboard-properties.php');
        }
    } else {
        $sql5 = "SELECT * FROM advertise WHERE a_id =$id";
        $result5 = mysqli_query($con, $sql5);
        $row5 = mysqli_fetch_assoc($result5);
        $l_id = $row5['l_id'];
        $p_id = $row5['pd_id'];

        $sql2 = "UPDATE location_property SET house_no='$house_no',village_no='$village_no',lane='$lane',road='$road',district_id='$district',amphure_id='$amphure',province_id='$province',postal_code='$postal_code' WHERE l_id = $l_id ";
        $result2 = mysqli_query($con, $sql2);


        $sql = "UPDATE property_detail SET ptype_id='$ptype',project_name='$project_name',bedroom='$bedroom',bathroom='$bathroom',parking='$parking',price='$price',img_video='$newname',space_area='$space_area',facility='$facility' WHERE l_id = $l_id ";
        $result = mysqli_query($con, $sql);


        $sql4 = "UPDATE advertise SET atype_id='$atype',ptype_id='$ptype',pd_id='$p_id',l_id='$l_id',title='$title',note='$describe',ad_status='0' WHERE a_id = $id ";
        $result4 = mysqli_query($con, $sql4) or die(mysqli_error($con));;


        if (isset($_FILES["file"])) {

            for ($i = 0; $i < count($_FILES["file"]["name"]); $i++) {
                if (isset($_FILES["file"]["name"][$i]) !== '') {
                    $fileT[$i] = $_FILES["file"]["name"][$i];
                    $filesT[$i] = pathinfo($fileT[$i], PATHINFO_FILENAME);

                    $typeT[$i] = strrchr($_FILES['file']['name'][$i], "."); //ตัดชื่อไฟล์เหลือแต่นามสกุล
                    $newnameT[$i] = $filesT[$i] . $nameDateT . $numrandT . $typeT[$i]; //ประกอบเป็นชื่อใหม่
                    $path_copyT[$i] = $pathT . $newnameT[$i]; //กำหนด path ในการเก็บ

                    move_uploaded_file($_FILES['file']['tmp_name'][$i], $path_copyT[$i]);

                    $sql = "INSERT INTO file (f_name,f_date,pd_id) 
                               VALUES ('$newnameT[$i]','$date','$p_id' )";
                    $insert = mysqli_query($con, $sql) or die(mysqli_error($con));
                }
            }


            echo "<script>";
            echo "alert(\"เพิ่มข้อมูลเรียบร้อย กรุณารอแอดมินอนุมัติ\")";
            echo "</script>";
            header('Refresh:0; url=../frontend/dashboard-properties.php');
        }
    }
}

if ($file == '') {

    if (isset($_POST['submit1'])) {

        $sql5 = "SELECT * FROM advertise WHERE a_id =$id";
        $result5 = mysqli_query($con, $sql5);
        $row5 = mysqli_fetch_assoc($result5);
        $l_id = $row5['l_id'];
        $p_id = $row5['pd_id'];

        $sql2 = "UPDATE location_property SET house_no='$house_no',village_no='$village_no',lane='$lane',road='$road',district_id='$district',amphure_id='$amphure',province_id='$province',postal_code='$postal_code' WHERE l_id = $l_id ";
        $result2 = mysqli_query($con, $sql2);


        $sql = "UPDATE property_detail SET ptype_id='$ptype',project_name='$project_name',bedroom='$bedroom',bathroom='$bathroom',parking='$parking',price='$price',space_area='$space_area',facility='$facility' WHERE l_id = $l_id ";
        $result = mysqli_query($con, $sql);


        $sql4 = "UPDATE advertise SET atype_id='$atype',ptype_id='$ptype',pd_id='$p_id',l_id='$l_id',title='$title',note='$describe',ad_status='2' WHERE a_id = $id ";
        $result4 = mysqli_query($con, $sql4) or die(mysqli_error($con));;


        if (isset($_FILES["file"])) {

            for ($i = 0; $i < count($_FILES["file"]["name"]); $i++) {
                if (isset($_FILES["file"]["name"][$i]) !== '') {
                    $fileT[$i] = $_FILES["file"]["name"][$i];
                    $filesT[$i] = pathinfo($fileT[$i], PATHINFO_FILENAME);

                    $typeT[$i] = strrchr($_FILES['file']['name'][$i], "."); //ตัดชื่อไฟล์เหลือแต่นามสกุล
                    $newnameT[$i] = $filesT[$i] . $nameDateT . $numrandT . $typeT[$i]; //ประกอบเป็นชื่อใหม่
                    $path_copyT[$i] = $pathT . $newnameT[$i]; //กำหนด path ในการเก็บ

                    move_uploaded_file($_FILES['file']['tmp_name'][$i], $path_copyT[$i]);

                    $sql = "INSERT INTO file (f_name,f_date,pd_id) 
                               VALUES ('$newnameT[$i]','$date','$p_id' )";
                    $insert = mysqli_query($con, $sql) or die(mysqli_error($con));
                }
            }


            echo "<script>";
            echo "alert(\"แก้ไขข้อมูลเรียบร้อย\")";
            echo "</script>";
            header('Refresh:0; url=../frontend/dashboard-properties.php');
        }
    } else {
        $sql5 = "SELECT * FROM advertise WHERE a_id =$id";
        $result5 = mysqli_query($con, $sql5);
        $row5 = mysqli_fetch_assoc($result5);
        $l_id = $row5['l_id'];
        $p_id = $row5['pd_id'];

        $sql2 = "UPDATE location_property SET house_no='$house_no',village_no='$village_no',lane='$lane',road='$road',district_id='$district',amphure_id='$amphure',province_id='$province',postal_code='$postal_code' WHERE l_id = $l_id ";
        $result2 = mysqli_query($con, $sql2);


        $sql = "UPDATE property_detail SET ptype_id='$ptype',project_name='$project_name',bedroom='$bedroom',bathroom='$bathroom',parking='$parking',price='$price',space_area='$space_area',facility='$facility' WHERE l_id = $l_id ";
        $result = mysqli_query($con, $sql);


        $sql4 = "UPDATE advertise SET atype_id='$atype',ptype_id='$ptype',pd_id='$p_id',l_id='$l_id',title='$title',note='$describe',ad_status='0' WHERE a_id = $id ";
        $result4 = mysqli_query($con, $sql4) or die(mysqli_error($con));;


        if (isset($_FILES["file"])) {

            for ($i = 0; $i < count($_FILES["file"]["name"]); $i++) {
                if (isset($_FILES["file"]["name"][$i]) !== '') {
                    $fileT[$i] = $_FILES["file"]["name"][$i];
                    $filesT[$i] = pathinfo($fileT[$i], PATHINFO_FILENAME);

                    $typeT[$i] = strrchr($_FILES['file']['name'][$i], "."); //ตัดชื่อไฟล์เหลือแต่นามสกุล
                    $newnameT[$i] = $filesT[$i] . $nameDateT . $numrandT . $typeT[$i]; //ประกอบเป็นชื่อใหม่
                    $path_copyT[$i] = $pathT . $newnameT[$i]; //กำหนด path ในการเก็บ

                    move_uploaded_file($_FILES['file']['tmp_name'][$i], $path_copyT[$i]);

                    $sql = "INSERT INTO file (f_name,f_date,pd_id) 
                               VALUES ('$newnameT[$i]','$date','$p_id' )";
                    $insert = mysqli_query($con, $sql) or die(mysqli_error($con));
                }
            }


            echo "<script>";
            echo "alert(\"เพิ่มข้อมูลเรียบร้อย กรุณารอแอดมินอนุมัติ\")";
            echo "</script>";
            header('Refresh:0; url=../frontend/dashboard-properties.php');
        }
    }
}
