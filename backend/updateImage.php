<?php

require_once('../dbconnect.php');

if(isset($_POST['submit'])){
   $temp = explode('.', $_FILES['file']['name']);
   $new_name = round(microtime(true)*9999). '.' . end($temp);
   $url = '../m_img/'.$new_name;

   if(move_uploaded_file($_FILES['file']['tmp_name'],$url)){
     $sql = "UPDATE `users` SET `img` = '".$new_name."' WHERE `u_id` = '".$_SESSION['u_id']."' ";
     $result = $con->query($sql) or die($con->error);

     if($result){
         $_SESSION['img'] = $new_name;
         header('Refresh:0; url=../page/edit_profile.php');
     }
   } 


}else{
    header('location:../page/edit_profile.php');
}
 



?>