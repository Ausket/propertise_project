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
$facility = implode(",", $_POST["facility"]);

$house_no = $_POST['house_no'];
$village_no = $_POST['village_no'];
$lane = $_POST['lane'];
$road = $_POST['road'];
$district = $_POST['district_id'];
$amphure = $_POST['amphure_id'];
$province = $_POST['province_id'];
$postal_code = $_POST['postal_code'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];

$atype = $_POST['atype'];
$title = $_POST['title'];
$describe = $_POST['describe'];

$file = $_FILES['upload_image']['name'];
$files = pathinfo($file, PATHINFO_FILENAME);

$nameDate = date('Ymd'); //เก็บวันที่
$path = "../image/p_img/"; //สร้างไฟล์สำหรับเก็บไฟล์ใหม่
date_default_timezone_set('Asia/Bangkok');
$numrand = (mt_rand(1000, 9999));

// --------------------------------------------------------

$nameDateT = date('Ymd'); //เก็บวันที่
$pathT = "../file/"; //สร้างไฟล์สำหรับเก็บไฟล์ใหม่
$numrandT = (mt_rand(1000, 9999));
$date = $_POST['date'];
$file2 = $_FILES['file']['name'];

//---------------------------------------------------------


if ($file != '') {
    $type = strrchr($file, "."); //ตัดชื่อไฟล์เหลือแต่นามสกุล
    $newname = $files . $nameDate . $numrand . $type; //ประกอบเป็นชื่อใหม่
    $path_copy = $path . $newname; //กำหนด path ในการเก็บ

    move_uploaded_file($_FILES['upload_image']['tmp_name'], $path_copy);

    if (isset($_POST['submit1'])) {


        $sql2 = "INSERT INTO location_property(house_no,village_no,lane,road,district_id,amphure_id,province_id,postal_code,u_id,lng,lat) VALUES('$house_no','$village_no','$lane','$road','$district','$amphure','$province','$postal_code','$id','$longitude','$latitude') ";
        $result2 = mysqli_query($con, $sql2) or die(mysqli_error($con));

        $sql3 = "SELECT * FROM location_property ORDER BY l_id DESC LIMIT 1";
        $result3 = mysqli_query($con, $sql3);
        $row3 = mysqli_fetch_assoc($result3);
        $l_id = $row3['l_id'];

        $sql = "INSERT INTO property_detail(ptype_id,l_id,project_name,bedroom,bathroom,parking,price,img_video,space_area,u_id,facility) VALUES('$ptype','$l_id','$project_name','$bedroom','$bathroom','$parking','$price','$newname','$space_area','$id','$facility') ";
        $result = mysqli_query($con, $sql);

        $sql4 = "SELECT * FROM property_detail ORDER BY pd_id DESC LIMIT 1";
        $result4 = mysqli_query($con, $sql4);
        $row4 = mysqli_fetch_assoc($result4);
        $pd_id = $row4['pd_id'];

        $sql5 = "INSERT INTO advertise(atype_id,ptype_id,l_id,pd_id,title,note,u_id,ad_status) VALUES('$atype','$ptype','$l_id','$pd_id','$title','$describe','$id','2') ";
        $result5 = mysqli_query($con, $sql5) or die(mysqli_error($con));;

        $yearMonth = substr(date("Y") + 543, -2) . date("m");

        $check = "SELECT * FROM advertise ORDER BY a_id DESC LIMIT 1";
        $qry = mysqli_query($con, $check) or die(mysqli_error($con));
        $rs = mysqli_fetch_assoc($qry);
        $a_id = $rs['a_id'];

        $namep = "SELECT * FROM property_type";
        $qry2 = mysqli_query($con, $namep) or die(mysqli_error($con));
        foreach ($qry2 as $value) {

            if ($rs['ptype_id'] == $value['ptype_id']) {
                $code = $value['name_short'];
            }
        }

        $maxId = substr($rs['a_id'], -5);
        $maxId = substr("00000" . $maxId, -5);
        $nextId = $code . $yearMonth . $maxId;

        $sql7 = "UPDATE advertise SET ad_id ='$nextId' WHERE a_id = $a_id ";
        $result7 = mysqli_query($con, $sql7) or die(mysqli_error($con));;

        if ($file2 !== '') {
            for ($i = 0; $i < count($file2); $i++) {
                if ($_FILES["file"]["name"][$i] !== '') {
                    $fileT[$i] = $_FILES["file"]["name"][$i];
                    $filesT[$i] = pathinfo($fileT[$i], PATHINFO_FILENAME);

                    $typeT[$i] = strrchr($_FILES['file']['name'][$i], "."); //ตัดชื่อไฟล์เหลือแต่นามสกุล
                    $newnameT[$i] = $filesT[$i] . $nameDateT . $numrandT . $typeT[$i]; //ประกอบเป็นชื่อใหม่
                    $path_copyT[$i] = $pathT . $newnameT[$i]; //กำหนด path ในการเก็บ

                    move_uploaded_file($_FILES['file']['tmp_name'][$i], $path_copyT[$i]);

                    $sql = "INSERT INTO file (f_name,f_date,pd_id) 
                               VALUES ('$newnameT[$i]','$date','$pd_id' )";
                    $insert = mysqli_query($con, $sql) or die(mysqli_error($con));
                }
            }
        }

        echo "<script>";
        echo "alert(\"เพิ่มข้อมูลเรียบร้อย\")";
        echo "</script>";
        header('Refresh:0; url=../frontend/dashboard-properties.php');
    } else {

        $sql2 = "INSERT INTO location_property(house_no,village_no,lane,road,district_id,amphure_id,province_id,postal_code,u_id,lng,lat) VALUES('$house_no','$village_no','$lane','$road','$district','$amphure','$province','$postal_code','$id','$longitude','$latitude') ";
        $result2 = mysqli_query($con, $sql2) or die(mysqli_error($con));

        $sql3 = "SELECT * FROM location_property ORDER BY l_id DESC LIMIT 1";
        $result3 = mysqli_query($con, $sql3);
        $row3 = mysqli_fetch_assoc($result3);
        $l_id = $row3['l_id'];

        $sql = "INSERT INTO property_detail(ptype_id,l_id,project_name,bedroom,bathroom,parking,price,img_video,space_area,u_id,facility) VALUES('$ptype','$l_id','$project_name','$bedroom','$bathroom','$parking','$price','$newname','$space_area','$id','$facility') ";
        $result = mysqli_query($con, $sql);

        $sql4 = "SELECT * FROM property_detail ORDER BY pd_id DESC LIMIT 1";
        $result4 = mysqli_query($con, $sql4);
        $row4 = mysqli_fetch_assoc($result4);
        $pd_id = $row4['pd_id'];

        $sql5 = "INSERT INTO advertise(atype_id,ptype_id,l_id,pd_id,title,note,u_id,ad_status) VALUES('$atype','$ptype','$l_id','$pd_id','$title','$describe','$id','0') ";
        $result5 = mysqli_query($con, $sql5) or die(mysqli_error($con));;

        $yearMonth = substr(date("Y") + 543, -2) . date("m");

        $check = "SELECT * FROM advertise ORDER BY a_id DESC LIMIT 1";
        $qry = mysqli_query($con, $check) or die(mysqli_error($con));
        $rs = mysqli_fetch_assoc($qry);
        $a_id = $rs['a_id'];

        $namep = "SELECT * FROM property_type";
        $qry2 = mysqli_query($con, $namep) or die(mysqli_error($con));
        foreach ($qry2 as $value) {

            if ($rs['ptype_id'] == $value['ptype_id']) {
                $code = $value['name_short'];
            }
        }

        $maxId = substr($rs['a_id'], -5);
        $maxId = substr("00000" . $maxId, -5);
        $nextId = $code . $yearMonth . $maxId;

        $sql7 = "UPDATE advertise SET ad_id ='$nextId' WHERE a_id = $a_id ";
        $result7 = mysqli_query($con, $sql7) or die(mysqli_error($con));;


        if ($file2 !== '') {
            for ($i = 0; $i < count($file2); $i++) {
                if ($_FILES["file"]["name"][$i] !== '') {
                    $fileT[$i] = $_FILES["file"]["name"][$i];
                    $filesT[$i] = pathinfo($fileT[$i], PATHINFO_FILENAME);

                    $typeT[$i] = strrchr($_FILES['file']['name'][$i], "."); //ตัดชื่อไฟล์เหลือแต่นามสกุล
                    $newnameT[$i] = $filesT[$i] . $nameDateT . $numrandT . $typeT[$i]; //ประกอบเป็นชื่อใหม่
                    $path_copyT[$i] = $pathT . $newnameT[$i]; //กำหนด path ในการเก็บ

                    move_uploaded_file($_FILES['file']['tmp_name'][$i], $path_copyT[$i]);

                    $sql = "INSERT INTO file (f_name,f_date,pd_id) 
                               VALUES ('$newnameT[$i]','$date','$pd_id' )";
                    $insert = mysqli_query($con, $sql) or die(mysqli_error($con));
                }
            }
        }
        echo "<script>";
        echo "alert(\"เพิ่มข้อมูลเรียบร้อย กรุณารอแอดมินอนุมัติ\")";
        echo "</script>";
        header('Refresh:0; url=../frontend/dashboard-properties.php');
    }
} else {
    if (isset($_POST['submit1'])) {

        $sql2 = "INSERT INTO location_property(house_no,village_no,lane,road,district_id,amphure_id,province_id,postal_code,u_id,lng,lat) VALUES('$house_no','$village_no','$lane','$road','$district','$amphure','$province','$postal_code','$id','$longitude','$latitude') ";
        $result2 = mysqli_query($con, $sql2) or die(mysqli_error($con));

        $sql3 = "SELECT * FROM location_property ORDER BY l_id DESC LIMIT 1";
        $result3 = mysqli_query($con, $sql3);
        $row3 = mysqli_fetch_assoc($result3);
        $l_id = $row3['l_id'];

        $sql = "INSERT INTO property_detail(ptype_id,l_id,project_name,bedroom,bathroom,parking,price,img_video,space_area,u_id,facility) VALUES('$ptype','$l_id','$project_name','$bedroom','$bathroom','$parking','$price','home.png','$space_area','$id','$facility') ";
        $result = mysqli_query($con, $sql);

        $sql4 = "SELECT * FROM property_detail ORDER BY pd_id DESC LIMIT 1";
        $result4 = mysqli_query($con, $sql4);
        $row4 = mysqli_fetch_assoc($result4);
        $pd_id = $row4['pd_id'];

        $sql6 = "INSERT INTO advertise(atype_id,ptype_id,l_id,pd_id,title,note,u_id,ad_status) VALUES('$atype','$ptype','$l_id','$pd_id','$title','$describe','$id','2') ";
        $result6 = mysqli_query($con, $sql6) or die(mysqli_error($con));

        $yearMonth = substr(date("Y") + 543, -2) . date("m");

        $check = "SELECT * FROM advertise ORDER BY a_id DESC LIMIT 1";
        $qry = mysqli_query($con, $check) or die(mysqli_error($con));
        $rs = mysqli_fetch_assoc($qry);
        $a_id = $rs['a_id'];

        $namep = "SELECT * FROM property_type";
        $qry2 = mysqli_query($con, $namep) or die(mysqli_error($con));
        foreach ($qry2 as $value) {

        if ($rs['ptype_id'] == $value['ptype_id']) {
            $code = $value['name_short'];
        }
    }

        $maxId = substr($rs['a_id'], -5);
        $maxId = substr("00000" . $maxId, -5);
        $nextId = $code . $yearMonth . $maxId;

        $sql7 = "UPDATE advertise SET ad_id ='$nextId' WHERE a_id = $a_id ";
        $result7 = mysqli_query($con, $sql7) or die(mysqli_error($con));;


        if ($file2 !== '') {
            for ($i = 0; $i < count($file2); $i++) {
                if ($_FILES["file"]["name"][$i] !== '') {
                    $fileT[$i] = $_FILES["file"]["name"][$i];
                    $filesT[$i] = pathinfo($fileT[$i], PATHINFO_FILENAME);

                    $typeT[$i] = strrchr($_FILES['file']['name'][$i], "."); //ตัดชื่อไฟล์เหลือแต่นามสกุล
                    $newnameT[$i] = $filesT[$i] . $nameDateT . $numrandT . $typeT[$i]; //ประกอบเป็นชื่อใหม่
                    $path_copyT[$i] = $pathT . $newnameT[$i]; //กำหนด path ในการเก็บ

                    move_uploaded_file($_FILES['file']['tmp_name'][$i], $path_copyT[$i]);

                    $sql = "INSERT INTO file (f_name,f_date,pd_id) 
                               VALUES ('$newnameT[$i]','$date','$pd_id' )";
                    $insert = mysqli_query($con, $sql) or die(mysqli_error($con));
                }
            }
        }

        echo "<script>";
        echo "alert(\"เพิ่มข้อมูลเรียบร้อย\")";
        echo "</script>";
        header('Refresh:0; url=../frontend/dashboard-properties.php');
    } else {


        $sql2 = "INSERT INTO location_property(house_no,village_no,lane,road,district_id,amphure_id,province_id,postal_code,u_id,lng,lat) VALUES('$house_no','$village_no','$lane','$road','$district','$amphure','$province','$postal_code','$id','$longitude','$latitude') ";
        $result2 = mysqli_query($con, $sql2) or die(mysqli_error($con));

        $sql3 = "SELECT * FROM location_property ORDER BY l_id DESC LIMIT 1";
        $result3 = mysqli_query($con, $sql3);
        $row3 = mysqli_fetch_assoc($result3);
        $l_id = $row3['l_id'];

        $sql = "INSERT INTO property_detail(ptype_id,l_id,project_name,bedroom,bathroom,parking,price,img_video,space_area,u_id,facility) VALUES('$ptype','$l_id','$project_name','$bedroom','$bathroom','$parking','$price','home.png','$space_area','$id','$facility') ";
        $result = mysqli_query($con, $sql);

        $sql4 = "SELECT * FROM property_detail ORDER BY pd_id DESC LIMIT 1";
        $result4 = mysqli_query($con, $sql4);
        $row4 = mysqli_fetch_assoc($result4);
        $pd_id = $row4['pd_id'];

        $sql5 = "INSERT INTO advertise(atype_id,ptype_id,l_id,pd_id,title,note,u_id,ad_status) VALUES('$atype','$ptype','$l_id','$pd_id','$title','$describe','$id','0') ";
        $result5 = mysqli_query($con, $sql5) or die(mysqli_error($con));;

        $yearMonth = substr(date("Y") + 543, -2) . date("m");

        $check = "SELECT * FROM advertise ORDER BY a_id DESC LIMIT 1";
        $qry = mysqli_query($con, $check) or die(mysqli_error($con));
        $rs = mysqli_fetch_assoc($qry);
        $a_id = $rs['a_id'];

        $namep = "SELECT * FROM property_type";
        $qry2 = mysqli_query($con, $namep) or die(mysqli_error($con));
        foreach ($qry2 as $value) {

            if ($rs['ptype_id'] == $value['ptype_id']) {
                $code = $value['name_short'];
            }
        }
        $maxId = substr($rs['a_id'], -5);
        $maxId = substr("00000" . $maxId, -5);
        $nextId = $code . $yearMonth . $maxId;

        $sql7 = "UPDATE advertise SET ad_id ='$nextId' WHERE a_id = $a_id ";
        $result7 = mysqli_query($con, $sql7) or die(mysqli_error($con));;

        if ($file2 !== '') {
            for ($i = 0; $i < count($file2); $i++) {
                if ($_FILES["file"]["name"][$i] !== '') {
                    $fileT[$i] = $_FILES["file"]["name"][$i];
                    $filesT[$i] = pathinfo($fileT[$i], PATHINFO_FILENAME);

                    $typeT[$i] = strrchr($_FILES['file']['name'][$i], "."); //ตัดชื่อไฟล์เหลือแต่นามสกุล
                    $newnameT[$i] = $filesT[$i] . $nameDateT . $numrandT . $typeT[$i]; //ประกอบเป็นชื่อใหม่
                    $path_copyT[$i] = $pathT . $newnameT[$i]; //กำหนด path ในการเก็บ

                    move_uploaded_file($_FILES['file']['tmp_name'][$i], $path_copyT[$i]);

                    $sql = "INSERT INTO file (f_name,f_date,pd_id) 
                               VALUES ('$newnameT[$i]','$date','$pd_id' )";
                    $insert = mysqli_query($con, $sql) or die(mysqli_error($con));
                }
            }
        }
        echo "<script>";
        echo "alert(\"เพิ่มข้อมูลเรียบร้อย กรุณารอแอดมินอนุมัติ\")";
        echo "</script>";
        header('Refresh:0; url=../frontend/dashboard-properties.php');
    }
}
