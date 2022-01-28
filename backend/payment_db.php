<?php
require('../dbconnect.php');

$header = "ผู้ซื้อแพ็คแก็จ";
//ร้บค่าข้อมูลที่กรอกบนฟอร์ม

$hp_id = $_GET['id'];
$date_start = date('Y-m-d ');
$time = strtotime($date_start);

$hp = "SELECT * FROM history_package WHERE hp_id = $hp_id ";
$checkhp = mysqli_query($con, $hp) or die(mysqli_error($con));
$rowhp = mysqli_fetch_array($checkhp);
$pack_id = $rowhp['packtype_id'];
$name = $rowhp['u_name'];
$email = $rowhp['u_email'];
$tel = $rowhp['u_tel'];


$pack = "SELECT * FROM package_type WHERE packtype_id = $pack_id";
$check = mysqli_query($con, $pack) or die(mysqli_error($con));
$row = mysqli_fetch_array($check);
$period = $row['period'];
$packname = $row['pack_name'];

$date_end = date("Y-m-d", strtotime("+$period month", $time));

$sql = "UPDATE history_package SET start_date='$date_start',end_date=' $date_end' WHERE hp_id = $hp_id ";
$result = mysqli_query($con, $sql) or die(mysqli_error($con));

//ส่วนแสดงข้อมูลบน Line-Notify
$message = $header .
    "\n" . "รหัสคำสั่งซื้อ : " . $hp_id .
    "\n" . "ชื่อแพ็คเกจ : " . $packname .
    "\n" . "ชื่อผู้ซื้อ : " . $name .
    "\n" . "อีเมล : " . $email .
    "\n" . "เบอร์โทรศัพท์ : " . $tel ;
   
sendlinemessage();                                  //เรียกใช้ฟังก์ชัน sendlinemessage()
header('Content-Type: text/html; charset=utf8');
$res = notify_message($message);
echo '<script> window.location.href = "../page/user/profile.php";alert("ชำระเงินสำเร็จ")</script>';
     

function sendlinemessage()
{

    define('LINE_API', "https://notify-api.line.me/api/notify");
    define('LINE_TOKEN', "Eu7aMJbdyGy9OwClPDFUxzirQNG8ugtYFC4zj2ca4al");

    function notify_message($message)
    {
        $queryData = array('message' => $message);
        $queryData = http_build_query($queryData, '', '&');
        $headerOptions = array(
            'http' => array(
                'method' => 'POST',
                'header' => "Content-Type: application/x-www-form-urlencoded\r\n"
                    . "Authorization: Bearer " . LINE_TOKEN . "\r\n"
                    . "Content-Length: " . strlen($queryData) . "\r\n",
                'content' => $queryData
            )
        );
        $context = stream_context_create($headerOptions);
        $result = file_get_contents(LINE_API, FALSE, $context);
        $res = json_decode($result);
        return $res;
    }
}
