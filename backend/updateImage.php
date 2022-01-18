<?php

require_once('../dbconnect.php');

$id = $_SESSION['u_id'];

if (isset($_POST['submit'])) {
  $temp = explode('.', $_FILES['file']['name']);
  $new_name = round(microtime(true) * 9999) . '.' . end($temp);
  $url = '../m_img/' . $new_name;

  if (move_uploaded_file($_FILES['file']['tmp_name'], $url)) {
    $sql = "UPDATE `users` SET `img` = '" . $new_name . "' WHERE `u_id` = '" . $_SESSION['u_id'] . "' ";
    $result = $con->query($sql) or die($con->error);

    echo $id;

    $sql2 = "SELECT * FROM users WHERE u_id = $id";
    $result2 = mysqli_query($con, $sql2) or die(mysqli_error($con));
    $row2 = mysqli_fetch_assoc($result2);
    $utype = $row2['utype'];

    if ($utype == 'admin') {
      echo '<script> alert("แก้ไขข้อมูลเรียบร้อย") </script>';
      header("Location:../page/profile.php");
    }
    if ($utype == 'staff') {
      echo '<script> alert("แก้ไขข้อมูลเรียบร้อย") </script>';
      header("Location:../page/profile.php");
    }
    if ($utype == 'member') {
      echo '<script> alert("แก้ไขข้อมูลเรียบร้อย") </script>';
      header("Location:../page/user/profile.php");
    }
    if ($utype == 'agent') {
      echo '<script> alert("แก้ไขข้อมูลเรียบร้อย") </script>';
      header("Location:../page/user/profile.php");
    }
  }
}
