
<?php

require('../dbconnect.php');

$id = $_GET['id'];
$type = $_POST['type'];
$x = "";
$check = "SELECT a_type FROM article_type ";
$qr = mysqli_query($con, $check) or die(mysqli_error($con));
while ($row = mysqli_fetch_array($qr)) {

    if ($row['a_type'] == $type) {
        echo '<script> window.location.href = "../page/edit_article_type.php?id='.$id.'";alert("ชื่อหมวดหมู่นี้ซ้ำ")</script>';
        $x = 1;
    }
}
if ($x !== 1) {

$sql = "UPDATE article_type
                SET a_type = '$type'
                 WHERE at_id = '$id' ";
$result = mysqli_query($con, $sql) or die(mysqli_error($con));

echo '<script> window.location.href = "../page/article_type.php";alert("แก้ไขข้อมูลเรียบร้อย") </script>';

}

?>