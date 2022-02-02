<?php

require_once("../dbconnect.php");

if(isset($_POST['submit'])){
    $oldpassword = $_POST['oldpassword'];
    $newpassword = $_POST['newpassword'];
    $repassword = $_POST['repassword'];
    $password = $_SESSION['password'];
    $id = $_SESSION['u_id'];

   if($newpassword == $repassword){
       $sql = "SELECT * FROM users WHERE u_id = '".$_SESSION['u_id']."'";  
       $result = $con->query($sql);
       $row = $result->fetch_assoc();

       if($oldpassword == $password ){
          $sql_pw = "UPDATE users SET password = '$newpassword' WHERE u_id = $id "; 

          $result_pw = $con->query($sql_pw) or die($con->error);
          if($result_pw){
            echo'<script> alert("เปลี่ยนรหัสผ่านใหม่สำเร็จ")</script>';
            header('Refresh:0; url= ../frontend/dashboard-profiles.php');

            $_SESSION['password'] = $newpassword;
          }
          
       }else{
        echo'<script> alert("รหัสผ่านเดิมไม่ถูกต้อง")</script>';
        header('Refresh:0; url= ../frontend/dashboard-profiles.php');
       }

   }else{
       echo'<script> alert("รหัสผ่านใหม่ไม่ตรงกัน")</script>';
       header('Refresh:0; url= ../frontend/dashboard-profiles.php');
   }

}else{
    header("location:../frontend/dashboard-profiles.php");
}



?>