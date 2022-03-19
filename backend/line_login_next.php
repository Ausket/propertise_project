<?php
require('../dbconnect.php');

$userid = $_POST['user'];
$name = $_POST['name'];

$accessToken = $_POST['accessToken'];
$oa_id = $_POST['oa_id'];
$link_img = $_POST['link_img'];




$sql = "SELECT * FROM users WHERE user_id='$userid' AND oa_id='$oa_id' ";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);
$Num_Rows = mysqli_num_rows($result);

if ($Num_Rows == 0) {


    echo "<script> window.location.href='../frontend/line_login_new.php'</script>";
} else {
    $_SESSION["u_id"] = $row["u_id"];
            $_SESSION["email"] = $row["email"];
            $_SESSION["password"] = $row["password"];
            $_SESSION["name"] = $row["name"];
            $_SESSION["address"] = $row["address"];
            $_SESSION["tel"] = $row["tel"];
            $_SESSION["id_card"] = $row["id_card"];
            $_SESSION["company"] = $row["company"];
            $_SESSION["birth_date"] = $row["birth_date"];
            $_SESSION["img"] = $row["img"];
            $_SESSION["utype"] = $row["utype"];
            $_SESSION["ustatus"] = $row["ustatus"];
            $_SESSION['last_login_timestamp'] = time();

            if ($_SESSION["utype"] == 'admin' || $_SESSION["utype"] == 'staff') {
                header("location: ../page/profile.php");
            }
            if ($_SESSION["utype"] == 'member' || $_SESSION["utype"] == 'agent') {
                header("location: ../frontend/dashboard-profiles.php");
            }
}

// $sql2 = "INSERT INTO user_timestamp (name,email,user_id) VALUES ('$name','$email','$userid')";
// $result2 = mysqli_query($con, $sql2);
