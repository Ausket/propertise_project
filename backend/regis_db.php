<?php
require('../dbconnect.php');

$email = $_POST['email'];
$password = $_POST['password'];
$name = $_POST['name'];
$tel = $_POST['tel'];
$address = $_POST['address'];
$x = "";
$check = "SELECT * FROM users";
$result = mysqli_query($con, $check);

if (isset($_POST['submit'])) {
    while ($row = mysqli_fetch_array($result)) {
        if ($_POST['email'] == $row['email']) {
            echo "<script>";
            echo "alert(\" email นี้ถูกใช้ไปแล้ว\");";
            echo "</script>";
            header('Refresh:0; url=../page/register.php');
            $x = 1;
        }
        if ($_POST['tel'] == $row['tel']) {
            echo "<script>";
            echo "alert(\" เบอร์นี้ถูกใช้ไปแล้ว\");";
            echo "</script>";
            header('Refresh:0; url=../page/register.php');
            $x = 1;
        }
    }
    if ($x !== 1) {
        $sql = "INSERT INTO users(email,password,name,tel,address,utype) VALUES('$email','$password','$name','$tel','$address','member') ";

        $result2 = mysqli_query($con, $sql);

        if ($result2) {
            header("Location:../page/login.php");
            exit(0);
        } else {
            echo "mysql_error($con)";
        }
    }
}
