<?php
//กำหนดค่า Access-Control-Allow-Origin ให้ เครื่อง อื่น ๆ สามารถเรียกใช้งานหน้านี้ได้
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// require_once 'connect.php';

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






if ($requestMethod === 'GET') {
    $strJson = file_get_contents("set_response.json");
    if (!empty($strJson)) {
        echo $strJson;
    } else {
        echo "No Data.";
    }
} elseif ($requestMethod === 'PUT') {
    //ตรวจสอบว่ามีการส่งค่า id มาหรือไม่
    if (!empty($data)) {
        if (!empty($data['full-back-url']) && !empty($data['mobile-back-url'])  && !empty($data['qrcash-back-url']) && !empty($data['qrcode-back-url'])) {

            $dataJson = array(
                'full-back-url' => $data['full-back-url'],
                'full-res-url' => $data['full-res-url'],
                'mobile-back-url' => $data['mobile-back-url'],
                'mobile-res-url' => $data['mobile-res-url'],
                'qrcash-back-url' => $data['qrcash-back-url'],
                'qrcode-back-url' => $data['qrcode-back-url']
            );

            $fp = fopen('set_response.json', 'w');
            
            fwrite($fp, json_encode($dataJson));
            fclose($fp);



            if (!empty($dataJson)) {
                $detail = 'Complete';
                $msg = 'Update Data Complete';
                $err = false;
            } else {
                $err = true;
            }
        } else {
            $err = true;
        }
    }else{
      $err = true;  
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
    
    //กำหนดตัวแปร array สำหรับส่งข้อมูล
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
    
    
}

