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
        $name = $data['name'];
        $pack = $data['pack'];
        $id = $data['id'];
        $date = date('Y-m-d H:i:s');

        if ($data['price'] == '0.00') {
            $sql = "INSERT INTO pay_status (referenceNo, price ,name ,pack_name ,u_id,resultCode) VALUES ('$referenceNo','$amount','$name','$pack','$id','00')";
        } else {
            $sql = "INSERT INTO pay_status (referenceNo, price ,name ,pack_name ,u_id) VALUES ('$referenceNo','$amount','$name','$pack','$id')";
        }
        $result = mysqli_query($con, $sql);

        if ($result) {
            $detail = 'Insert Data Success';
            $msg = 'Success';
            $err = false;

            $sToken = "IKk4FOtF09RzptEE1B4dlEVUCFfnDeGspxIJQEsCFCu";
            $ms = 
                "\n" . "รหัสสั่งซื้อ :  $referenceNo".
                "\n" . "ชื่อแพ็คเกจ : $pack " .
                "\n" . "ชื่อผู้ชื่อ :  $name".
                "\n" . "ราคา : $amount " . " บาท" .
                "\n" . "เวลาสั่งซื้อ : $date "  ;
               



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
