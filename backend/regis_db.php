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

            
            $sToken = "ikREbCH8W5zjrcmXkyqnDCf8p7qNwvEstaBFBzXpSsq";
            $ms = 
                "\n" . "ชื่อ :  $name".
                "\n" . "อีเมล : $email   "  .
                "\n" . "สถานะ : สมาชิกทั่วไป " .
                "\n" . "เบอร์โทร : $tel " ;



            $chOne = curl_init();
            curl_setopt($chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
            curl_setopt($chOne, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($chOne, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($chOne, CURLOPT_POST, 1);
            curl_setopt($chOne, CURLOPT_POSTFIELDS, "message=" . $ms);
            $headers = array('Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer ' . $sToken . '',);
            curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($chOne, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec($chOne);

          
            curl_close($chOne);
            exit(0);
        } else {
            echo "mysql_error($con)";
        }
    }
}


?>
