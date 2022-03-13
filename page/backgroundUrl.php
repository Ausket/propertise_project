<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// require('../base_require.php');
require('../config.php');
// require('../connect.php');
// $con=mysqli_connect("localhost","root","123456","propertise") or die("เชื่อมต่อผิดพลาด");
// $con=mysqli_connect("localhost","fininsure_auhome","SkHEFLW56W","fininsure_auhome") or die("เชื่อมต่อผิดพลาด");
$con=mysqli_connect("localhost","fininsure_lifejung","mCVI1HT3","fininsure_lifejung") or die("เชื่อมต่อผิดพลาด");
//ข้อความ : ขาดการตรวจสอบเงื่อนไขป้องกันการเข้าถึงจากผู้ไม่ประสงค์ดี 

if (!empty($_POST['resultCode'])) {

    $result = $_POST["resultCode"];
    $amount = $_POST["amount"];
    $order_id = $_POST["referenceNo"];
    $gbp_ref = $_POST["gbpReferenceNo"];
    if (isset($_POST["date"])) {
        $date = $_POST["date"];
        $time = $_POST["time"];
    } else {
        $date = date("d:m:y");
        $time = date("h:i");
    }
    //เรียกใช้ api ตรวจสอบข้อมูลจากรหัสคำสั่งซื้อ (referentNo) 
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.globalprimepay.com/v1/check_status_txn',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{"referenceNo": "' . $_POST["referenceNo"] . '"}',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Basic VUtyTWtOTWc4alk3Wm92ek44TUlxdnBYcFpnUlN6RG46',
            'Content-Type: application/json'
        ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    $res = json_decode($response);
    // print_r($res);

    //ตรวจสอบเงื่อนไข tnxs เป็น response ช่่องทางชำระเงินที่ต้อง เรียกใช้ Token API ก่อน 
    //tnx เป็น response ช่่องทางชำระเงินที่เรียกผ่าน form action โดยตรง
    if (isset($res->txns)) {
        $paymentType = $res->txns[0]->paymentType;
        $issuerBank = $res->txns[0]->issuerBank;
        $merchantDefined = $res->txns[0]->merchantDefined1;
       
    }

    if(isset($res->txn)) {
        $paymentType = $res->txn->paymentType;
        $issuerBank = $res->txn->issuerBank;
        $merchantDefined = $res->txn->merchantDefined1;
       
    }

    //ตรวจสอบช่องทางชำระเงิน ตามตัวอักษรย่อที่ได้รับจาก response
    if ($paymentType == 'C') {
        $paymentType = "Credit Card Full payment";
    } else if ($paymentType == 'R') {
        $paymentType = "Recurring";
    } else if ($paymentType == 'I') {
        $paymentType = "Credit Card Installment";
    } else if ($paymentType == 'Q') {
        $paymentType = "Qr Cash";
    } else if ($paymentType == 'B') {
        $paymentType = "Bill Payment";
    } else if ($paymentType == 'W') {
        $paymentType = "Wechat";
    } else if ($paymentType == 'L') {
        $paymentType = "Line Payment";
    } else if ($paymentType == 'T') {
        $paymentType = "True Wallet";
    } else if ($paymentType == 'M') {
        $paymentType = "Mobile Banking";
    } else if ($paymentType == 'D') {
        $paymentType = "Direct Debit";
    }

    //เขียน sql อัพเดทฐานข้อมูลใน table ข้อมูลคำสั่งซื้อ ให้อัพเดทสถานะการชำระ
    $sql = "UPDATE pay_status 
            SET
            gbpReferenceNo = '$gbp_ref',
            price = '$amount' ,
            resultCode = '$result' ,    
            issuerBank = '$issuerBank',
            paymentType = '$paymentType' ,
            merchantDefined	 = '$merchantDefined',
            date = '$date',
            time = '$time' 
            WHERE referenceNo = '$order_id'";
    $res_qurey = mysqli_query($con, $sql);

    //ตรวจสอบเงื่อนไขการเรียกใช้ query ข้อมูลว่าสำเร็จหรือไม่
    if ($res_qurey) {
        echo 'บันทึกข้อมูลแล้ว'; 
        // header("location : ".$base_url."pages/default/inventory-detail?code=".$merchantDefined."&status=success");
    } else {
        echo 'เกิดข้อผิดพลาดระหว่างบันทึกข้อมูล';
    }
    
}