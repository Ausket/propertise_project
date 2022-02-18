<?php
    // require('../base_require.php');
require('../config.php');
// require('../connect.php');
require('../dbconnect.php');


if(isset($_POST['resultCode'])){
    $code = $_POST['resultCode'];
    $sqlData = "SELECT meaning_eng, meaning_th, recommend FROM `pay_message` WHERE resultCode = '$code'";
    $result = mysqli_query($con, $sqlData);
    $result = mysqli_fetch_assoc($result);
    echo json_encode($result);
}else{
    echo 'Invalid data';
}

