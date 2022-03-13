
<?php

require('../dbconnect.php');

$id = $_GET['id'];
$icon = $_POST['icon'];
$type = $_POST['type'];

$x = "";
$check = "SELECT name FROM user_role_type ";
$qr = mysqli_query($con, $check) or die(mysqli_error($con));
while ($row = mysqli_fetch_array($qr)) {

    if ($row['name'] == $type) {
        echo '<script> window.location.href = "../page/edit_page_type.php?id='.$id.'";alert("ชื่อหมวดหมู่นี้ซ้ำ")</script>';
        $x = 1;
    }
}
if ($x !== 1) {

    $sql = "UPDATE user_role_type
                SET type_icon = '$icon',name='$type'
                 WHERE id = '$id' ";
    $result = mysqli_query($con, $sql) or die(mysqli_error($con));

    echo '<script> window.location.href = "../page/page_type.php";alert("แก้ไขข้อมูลเรียบร้อย") </script>';
}

?>