<?php
//กำหนดค่า Access-Control-Allow-Origin ให้ เครื่อง อื่น ๆ สามารถเรียกใช้งานหน้านี้ได้
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//เชื่อมต่อฐานข้อมูล

require('../../dbconnect.php');

$requestMethod = $_SERVER["REQUEST_METHOD"];

//อ่านข้อมูลที่ส่งมาแล้วเก็บไว้ที่ตัวแปร data
$data = file_get_contents("php://input");

//แปลงข้อมูลที่อ่านได้ เป็น array แล้วเก็บไว้ที่ตัวแปร result
$data = json_decode($data, true);

//สร้างตัวแปร array สำหรับเก็บข้อมูลที่ได้
$resultArr = array();
//กำหนดตัวแปรเก็บข้อความที่จะส่งกลับไป
$status = 'status';
//กำหนดตัวแปรเก็บที่จะส่งกลับไป
$detail = 'detail';
//กำหนดตัวแปรเก็บข้อมูลที่จะส่งกลับไป
$msg = 'message';

//กำหนดเก็บข้อผิดพลาด
$err = false;

if ($requestMethod === 'POST') {
    if (!empty($data)) {
        
            $referenceNo = $data['referenceNo'];
            $amount = $data['price'];

            //คำสั่ง SQL สำหรับเพิ่มข้อมูลใน Database
            $sql = "INSERT INTO pay_status (referenceNo, price) VALUES ('$referenceNo','$amount')";

            $result = mysqli_query($con, $sql);

            if ($result) {
                $detail = 'Insert Data Success';
                $msg = 'Success';
                $err = false;
            } else {
                $err = true;
            }
        
    } else {
        $err = true;
    }
} else {
    // $err = true;
}

if ($err == true) {
    $status = 'error';
    $msg = 'Bad Request';
    $detail = 'Invalid Data';
    http_response_code(400);
} else {
    $status = 'OK';
    http_response_code(200);
}

if ($resultArr == null) {
    $response = array(
        'status' => $status,
        'message' => $msg,
        'detail' => $detail
    );
} else {
    $response = array(
        'status' => $status,
        'message' => $msg,
        'response' => $resultArr,
        'detail' => $detail
    );
}

echo json_encode($response);

   
?>