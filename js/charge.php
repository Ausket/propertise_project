<?php

require('../env.php');

if (isset($_GET['token'])) {
  $token = $_GET['token'];

  $data = array(
    'amount' => 100.00,
    'referenceNo' => '1234564890743465',
    'detail' => 't-shirt',
    'customerName' => 'John',
    'customerEmail' => 'example@gbprimepay.com',
    'merchantDefined1' => 'Promotion',
    'card' => array(
      'token' => $token,
    ),
    'otp' => 'Y',
    'backgroundUrl' => $resUrl ,
    'responseUrl' => $resUrl
  );

  $payload = json_encode($data);

  $ch = curl_init($testUrlAPI . 'v2/tokens/charge');
  curl_setopt($ch, CURLOPT_HEADER, 0);
  curl_setopt($ch, CURLOPT_USERPWD, $secret_key . ':');
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

  curl_setopt(
    $ch,
    CURLOPT_HTTPHEADER,
    array(
      'Content-Type: application/json',
      'Content-Length: ' . strlen($payload)
    )
  );

  $result = curl_exec($ch);

  curl_close($ch);

  $chargeResp = json_decode($result, true);
  if($chargeResp['resultCode']  == '94'){
    echo "รหัสอ้างอิงซ้ำ" ;
  } else{
    header("location: 3DSecure.php?gbpRefNo=".$chargeResp['gbpReferenceNo']);
  }
  
}
