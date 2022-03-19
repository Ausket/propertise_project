<?php
    // require('../base_require.php');
require('../config.php');
// require('../connect.php');
require('../dbconnect.php');

if(isset($_POST['referenceNo'])){
    $id = $_POST['referenceNo'];
    $sqlData = "SELECT * FROM pay_status WHERE referenceNo = '$id' ";
    $result = mysqli_query($con, $sqlData);
    $resultp = mysqli_fetch_assoc($result);
    echo json_encode($resultp);
}else{
    echo 'Invalid data';
}

