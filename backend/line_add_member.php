<?php
require('../dbconnect.php');

$name = $_POST["name"];
$userid = $_POST["user"];
$accessToken = $_POST["accessToken"];
$phone = $_POST["phone"];
$oa_id = $_POST['oa_id'];
$link_img = $_POST['link_img'];

// $sql_noti = "SELECT * FROM setting_notify WHERE notify_id = 1";
// $result_noti = mysqli_query($con,$sql_noti);
// $row_noti = mysqli_fetch_array($result_noti);
// $noti_token =  $row_noti['notify_token'];


function random_char($len)
{
    $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"; //ตัวอักษรที่สามารถสุ่มได้
    $ret_char = "";
    $num = strlen($chars);
    for ($i = 0; $i < $len; $i++) {
        $ret_char .= $chars[rand() % $num];
        $ret_char .= "";
    }
    return $ret_char;
}
$random = random_char(8);

$name_img = $name . $random . '.png';
$url = $link_img;
$img = '../image/m_img/' . $name_img;
file_put_contents($img, file_get_contents($url));


$x = "";

$sql2 = "SELECT * FROM users";
$result2 = mysqli_query($con, $sql2);

while ($row = mysqli_fetch_array($result2)) {

    if ($phone == $row['tel'] && $row['user_id'] == '' ) {

        $sql3 = "UPDATE users SET user_id = '$userid', access_token='$accessToken', oa_id='$oa_id' WHERE tel = '$phone' AND user_id = '' ";
        $result3 = mysqli_query($con, $sql3);
        if ($result3) {

            $sql = "SELECT * FROM users WHERE user_id='$userid' AND oa_id ='$oa_id' ";
            $result = mysqli_query($con, $sql);
            $row2 = mysqli_fetch_array($result);
            $_SESSION["u_id"] = $row["u_id"];
            $_SESSION["email"] = $row["email"];
            $_SESSION["password"] = $row["password"];
            $_SESSION["name"] = $row["name"];
            $_SESSION["address"] = $row["address"];
            $_SESSION["tel"] = $row["tel"];
            $_SESSION["id_card"] = $row["id_card"];
            $_SESSION["company"] = $row["company"];
            $_SESSION["birth_date"] = $row["birth_date"];
            $_SESSION["img"] = $row["img"];
            $_SESSION["utype"] = $row["utype"];
            $_SESSION["ustatus"] = $row["ustatus"];
            $_SESSION['last_login_timestamp'] = time();

            // ------------------------ line notify ---------------------------------

            // $sql_oa = "SELECT * FROM line_doc WHERE oa_id = $oa_id";
            // $result_oa = mysqli_query($con, $sql_oa);
            // $row_oa = mysqli_fetch_array($result_oa);
            // $row_oa['name'];


            // $head_content = "เชื่อมไลน์ กับ user เก่า";
            // $sToken = "$noti_token";
            // $ms = $head_content .
            //     "\n" . "ชื่อ : " . $row2["name"] .
            //     "\n" . "line official : " . $row_oa['name'] .
            //     "\n" . "เบอร์โทร : " . $row2["tel"];



            // $chOne = curl_init();
            // curl_setopt($chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
            // curl_setopt($chOne, CURLOPT_SSL_VERIFYHOST, 0);
            // curl_setopt($chOne, CURLOPT_SSL_VERIFYPEER, 0);
            // curl_setopt($chOne, CURLOPT_POST, 1);
            // curl_setopt($chOne, CURLOPT_POSTFIELDS, "message=" . $ms);
            // $headers = array('Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer ' . $sToken . '',);
            // curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
            // curl_setopt($chOne, CURLOPT_RETURNTRANSFER, 1);
            // $result = curl_exec($chOne);

            // //Result error 
            // // if (curl_error($chOne)) {
            // //     echo 'error:' . curl_error($chOne);
            // // } else {
            // //     $result_ = json_decode($result, true);
            // //     echo "status : " . $result_['status'];
            // //     echo "message : " . $result_['message'];
            // // }
            // curl_close($chOne);


            // ------------------------ line notify ---------------------------------


            if ($_SESSION["utype"] == 'admin' || $_SESSION["utype"] == 'staff') {
                header("location: ../page/profile.php");
            }
            if ($_SESSION["utype"] == 'member' || $_SESSION["utype"] == 'agent') {
                header("location: ../frontend/dashboard-profiles.php");
            }
            $x = 1;
        }
    } else {
    }
}


if ($x != 1) {

    $sql6 = "SELECT * FROM users WHERE tel='$phone' AND oa_id='$oa_id' ";
    $result6 = mysqli_query($con, $sql6) or die(mysqli_error($con));
    $Num_Rows = mysqli_num_rows($result6);

    if ($Num_Rows == 0) {

        $sql = "INSERT INTO users (tel,utype,img,name,user_id,access_token,email,oa_id) 
                        VALUES ('$phone','member','$name_img','$name','$userid','$accessToken','$email','$oa_id')";
        $result = mysqli_query($con, $sql);


        if ($result) {




            $sql = "SELECT * FROM users WHERE user_id='$userid' AND oa_id ='$oa_id' ";
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_array($result);
            $_SESSION["u_id"] = $row["u_id"];
            $_SESSION["email"] = $row["email"];
            $_SESSION["password"] = $row["password"];
            $_SESSION["name"] = $row["name"];
            $_SESSION["address"] = $row["address"];
            $_SESSION["tel"] = $row["tel"];
            $_SESSION["id_card"] = $row["id_card"];
            $_SESSION["company"] = $row["company"];
            $_SESSION["birth_date"] = $row["birth_date"];
            $_SESSION["img"] = $row["img"];
            $_SESSION["utype"] = $row["utype"];
            $_SESSION["ustatus"] = $row["ustatus"];
            $_SESSION['last_login_timestamp'] = time();

            // ------------------------ line notify ---------------------------------

            // $sql_oa = "SELECT * FROM line_doc WHERE oa_id = $oa_id";
            // $result_oa = mysqli_query($con, $sql_oa);
            // $row_oa = mysqli_fetch_array($result_oa);
            // $row_oa['name'];


            // $head_content = "เพิ่มเพื่อนผ่านไลน์";
            // $sToken = "$noti_token";
            // $ms = $head_content .
            //     "\n" . "ชื่อ : " . $row["name"] .
            //     "\n" . "line official : " . $row_oa['name'] .
            //     "\n" . "เบอร์โทร : " . $row["tel"];



            // $chOne = curl_init();
            // curl_setopt($chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
            // curl_setopt($chOne, CURLOPT_SSL_VERIFYHOST, 0);
            // curl_setopt($chOne, CURLOPT_SSL_VERIFYPEER, 0);
            // curl_setopt($chOne, CURLOPT_POST, 1);
            // curl_setopt($chOne, CURLOPT_POSTFIELDS, "message=" . $ms);
            // $headers = array('Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer ' . $sToken . '',);
            // curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
            // curl_setopt($chOne, CURLOPT_RETURNTRANSFER, 1);
            // $result = curl_exec($chOne);

            // //Result error 
            // // if (curl_error($chOne)) {
            // //     echo 'error:' . curl_error($chOne);
            // // } else {
            // //     $result_ = json_decode($result, true);
            // //     echo "status : " . $result_['status'];
            // //     echo "message : " . $result_['message'];
            // // }
            // curl_close($chOne);


           

            if ($_SESSION["utype"] == 'admin' || $_SESSION["utype"] == 'staff') {
                header("location: ../page/profile.php");
            }
            if ($_SESSION["utype"] == 'member' || $_SESSION["utype"] == 'agent') {
                header("location: ../frontend/dashboard-profiles.php");
            }
        } else {
            echo mysqli_error($con);
        }
    } else {
        if ($_SESSION["utype"] == 'admin' || $_SESSION["utype"] == 'staff') {
            header("location: ../page/profile.php");
        }
        if ($_SESSION["utype"] == 'member' || $_SESSION["utype"] == 'agent') {
            header("location: ../frontend/dashboard-profiles.php");
        }
    }
}






/* if ($oa_id == '1') {





    $sql_oa = "INSERT INTO tues_chat_1 (name,email,tel,user_id,access_token,oa_id) 
        VALUES ('$name','$email','$phone','$userid','$accessToken','$oa_id')";
    $result_oa = mysqli_query($con, $sql_oa);
}

if ($oa_id == '2') {

    $sql_oa = "INSERT INTO tues_chat_2 (name,email,tel,user_id,access_token,oa_id) 
        VALUES ('$name','$email','$phone','$userid','$accessToken','$oa_id')";
    $result_oa = mysqli_query($con, $sql_oa);
} */
