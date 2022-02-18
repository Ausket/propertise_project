<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if (!isset($_SESSION)) {
    session_start();
}
// require('../base_require.php');
require('../config.php');
// require('../connect.php');
require('../dbconnect.php');

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
    // print_r( $res);
    // print_r ($res->txn->customerName);


    $paymentType = $res->txn->paymentType;
    if($paymentType == 'C'){
        $paymentType = "Credit Card Full payment";
    }else if($paymentType == 'R'){
        $paymentType = "Recurring";
    }else if($paymentType == 'I'){
        $paymentType = "Credit Card Installment";
    }else if($paymentType == 'Q'){
        $paymentType = "Qr Cash";
    }else if($paymentType == 'B'){
        $paymentType = "Bill Payment";
    }else if($paymentType == 'W'){
        $paymentType = "Wechat";
    }else if($paymentType == 'L'){
        $paymentType = "Line Payment";
    }else if($paymentType == 'T'){
        $paymentType = "True Wallet";
    }else if($paymentType == 'M'){
        $paymentType = "Mobile Banking";
    }else if($paymentType == 'D'){
        $paymentType = "Direct Debit";
    }

    $name =  $res->txn->customerName;
    $email = $res->txn->customerEmail; 
    $issuerBank = $res->txn->issuerBank;  
    $merchantDefined = $res->txn->merchantDefined1; 
    $detail = $res->txn->detail; 

    


    $sql = "UPDATE pay_status 
            SET
            gbpReferenceNo = '$gbp_ref',
            amount = '$amount' ,
            resultCode = '$result' ,
            name = '$name',
            email = '$email',
            issuerBank = '$issuerBank',
            paymentType = '$paymentType' ,
            merchantDefined	 = '$merchantDefined',
            detail = '$detail',
            date = '$date',
            time = '$time' 
            WHERE referenceNo = '$order_id'";

    $res_qurey = mysqli_query($con, $sql);

    if ($res_qurey) {
        echo 'บันทึกข้อมูลแล้ว';
    } else {
        echo 'เกิดปัญหา';
    }
    // header("location : ".$base_url."pages/management/login.php");
}
