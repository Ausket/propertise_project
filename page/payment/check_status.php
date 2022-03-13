<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


require('../../config.php');
require('../../dbconnect.php');
$status = false;
// $paymentType = '';
$paymentType = '';
$gbpReferenceNo = '';
$date = '';
$time = '';
$issuerBank = '';
$merchantDefined = '';
$detail = '';

if (isset($_POST['referenceNo']) && !empty($_POST['referenceNo'])) {

    // $result = $_POST["resultCode"];
    // $amount = $_POST["amount"];
    // $order_id = $_POST["referenceNo"];
    // $gbp_ref = $_POST["gbpReferenceNo"];
    // if (isset($_POST["date"])) {
    //     $date = $_POST["date"];
    //     $time = $_POST["time"];
    // } else {
    //     $date = date("d:m:y");
    //     $time = date("h:i");
    // }


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

    // print_r ($res->txns->customerName);


    // $paymentType = $res->txns[0]->paymentType;
    // if($paymentType == 'C'){
    //     $paymentType = "Credit Card Full payment";
    // }else if($paymentType == 'R'){
    //     $paymentType = "Recurring";
    // }else if($paymentType == 'I'){
    //     $paymentType = "Credit Card Installment";
    // }else if($paymentType == 'Q'){
    //     $paymentType = "Qr Cash";
    // }else if($paymentType == 'B'){
    //     $paymentType = "Bill Payment";
    // }else if($paymentType == 'W'){
    //     $paymentType = "Wechat";
    // }else if($paymentType == 'L'){
    //     $paymentType = "Line Payment";
    // }else if($paymentType == 'T'){
    //     $paymentType = "True Wallet";
    // }else if($paymentType == 'M'){
    //     $paymentType = "Mobile Banking";
    // }else if($paymentType == 'D'){
    //     $paymentType = "Direct Debit";
    // }
    if ($res->resultCode == '00') {
        foreach ($res->txns as $key => $value) {
            if ($value->paymentType != 'V') {
                $amount =  $value->amount;
                $gbpReferenceNo = $value->gbpReferenceNo;
                if (!isset($value->resultCode)) {
                    $status = false;
                } else {
                    $resultCode = $value->resultCode;
                }

                if (isset($value->paymentType)) {
                    $paymentType = $value->paymentType;                    
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
                }
                if (isset($value->gbpReferenceNo)) {
                    $gbpReferenceNo = $value->gbpReferenceNo;
                }
                if (isset($value->date)) {
                    $date = $value->date;
                }
                if (isset($value->time)) {
                    $time = $value->time;
                }                
                if (isset($value->issuerBank)) {
                    $issuerBank = $value->issuerBank;
                }
                if (isset($value->merchantDefined1)) {
                    $merchantDefined = $value->merchantDefined1;
                }
                if (isset($value->detail)) {
                    $detail = $value->detail;
                }
            }
        }


        if (isset($resultCode)) {
            $referentNo = $_POST["referenceNo"];
            $sql = "UPDATE pay_status 
            SET            
            paymentType = '$paymentType' ,
            issuerBank = '$issuerBank',
            gbpReferenceNo = '$gbpReferenceNo',
            price = '$amount' ,
            resultCode = '$resultCode', 
            merchantDefined	 = '$merchantDefined',
            date = '$date',
            time = '$time' 
            WHERE referenceNo = '$referentNo'";
            $res_qurey = mysqli_query($con, $sql);
            if ($res_qurey &&  $resultCode == '00') {
                $status = true;
            } else {
                $status = false;
            }
        }
    } else {
        $status = false;
    }

    if ($status == true) {
        print_r($response);
    } else {
        echo json_encode(["resultCode" => "-"]);
    }
}
