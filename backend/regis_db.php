<?php
require('../dbconnect.php');

$email = $_POST['email'];
$password = $_POST['password'];
$name = $_POST['name'];
$tel = $_POST['tel'];

$x = "";
$check = "SELECT * FROM users";
$result = mysqli_query($con, $check);

if (isset($_POST['submit'])) {
    while ($row = mysqli_fetch_array($result)) {
        if ($_POST['email'] == $row['email']) {
            echo "<script>";
            echo "alert(\" email นี้ถูกใช้ไปแล้ว\");";
            echo "</script>";
            header('Refresh:0; url=../index.php');
            $x = 1;
        }
        if ($_POST['tel'] == $row['tel']) {
            echo "<script>";
            echo "alert(\" เบอร์นี้ถูกใช้ไปแล้ว\");";
            echo "</script>";
            header('Refresh:0; url=../index.php');
            $x = 1;
        }
    }
    if ($x !== 1) {
        $sql = "INSERT INTO users(email,password,name,tel,utype) VALUES('$email','$password','$name','$tel','member') ";

        $result2 = mysqli_query($con, $sql) or die(mysqli_error($con));

        if ($result2) {
            echo "<script>";
            echo "alert(\" สมัครสมาชิกสำเร็จ\");";
            echo "</script>";
            header('Refresh:0; url=../index.php');
            exit(0);
        } else {
            echo "mysql_error($con)";
        }
    }
}
