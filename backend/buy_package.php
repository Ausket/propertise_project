<?php
require('../dbconnect.php');

$id = $_SESSION['u_id'];
$pack_id = $_GET['id'];
$email = $_POST['email'];
$name = $_POST['name'];
$tel = $_POST['tel'];


    if (isset($_POST['submit'])) {

            $sql = "INSERT INTO history_package(u_email,u_name,u_tel,packtype_id,u_id) VALUES('$email','$name','$tel','$pack_id','$id') ";

            $result = mysqli_query($con, $sql)or die(mysqli_error($con));

            $sql3 = "SELECT * FROM history_package ORDER BY hp_id DESC LIMIT 1";
            $result3 = mysqli_query($con, $sql3);
            $row3 = mysqli_fetch_assoc($result3) or die(mysqli_error($con));
            $hp_id = $row3['hp_id'];

            echo '<script> window.location.href = "../page/payment.php?id='.$hp_id.'";</script>';
           
        

    }
 

