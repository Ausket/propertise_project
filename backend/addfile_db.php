<?php
require('../dbconnect.php');

$id = $_SESSION['u_id'];
$idf = $_GET['id'];
// --------------------------------------------------------
$hdnLine = $_POST['hdnLine'];
$date = $_POST['date'];
$nameDateT = date('Ymd'); //เก็บวันที่
$pathT = "../file/"; //สร้างไฟล์สำหรับเก็บไฟล์ใหม่
$numrandT = (mt_rand(1000, 9999));

$sql7 = "SELECT * FROM users WHERE u_id = $id";
$result7 = mysqli_query($con, $sql7) or die(mysqli_error($con));
$row7 = mysqli_fetch_assoc($result7);
$utype = $row7['utype'];

if (isset($_POST['submit'])) {

    if ($hdnLine == 0) {
        if ($utype == 'admin') {
            echo "<script type='text/javascript'>";
            echo "alert('กรุณาเลือกเพิ่มไฟล์');";
            echo "window.location = '../page/advertise.php';";
            echo "</script>";
        }
        if ($utype == 'staff') {
            echo "<script type='text/javascript'>";
            echo "alert('กรุณาเลือกเพิ่มไฟล์');";
            echo "window.location = '../page/advertise.php';";
            echo "</script>";
        }
        if ($utype == 'member') {
            echo "<script type='text/javascript'>";
            echo "alert('กรุณาเลือกเพิ่มไฟล์');";
            echo "window.location = '../page/user/advertise.php';";
            echo "</script>";
        }
        if ($utype == 'staff') {
            echo "<script type='text/javascript'>";
            echo "alert('กรุณาเลือกเพิ่มไฟล์');";
            echo "window.location = '../page/user/advertise.php';";
            echo "</script>";
        }
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
                               VALUES ('$newnameT[$i]','$date','$idf' )";
                $insert = mysqli_query($con, $sql) or die(mysqli_error($con));

                $sql2 = "SELECT * FROM users WHERE u_id = $id";
                $result2 = mysqli_query($con, $sql2) or die(mysqli_error($con));
                $row2 = mysqli_fetch_assoc($result2);
                $utypeu = $row2['utype'];

                if ($utypeu == 'admin') {
                    echo '<script> alert("แก้ไขข้อมูลเรียบร้อย") </script>';
                    header("Location:../page/advertise.php");
                }
                if ($utypeu == 'staff') {
                    echo '<script> alert("แก้ไขข้อมูลเรียบร้อย") </script>';
                    header("Location:../page/advertise.php");
                }
                if ($utypeu == 'member') {
                    echo '<script> alert("แก้ไขข้อมูลเรียบร้อย") </script>';
                    header("Location:../page/user/advertise.php");
                }
                if ($utypeu == 'agent') {
                    echo '<script> alert("แก้ไขข้อมูลเรียบร้อย") </script>';
                    header("Location:../page/user/advertise.php");
                }
            }
        }
    }
}
