<?php

require_once('../dbconnect.php');

$id = $_SESSION['u_id'];
if (empty($id)) {
    header('Location:../index.php');
}
$type = $_SESSION['utype'];
if ($type != 'admin' || $type != 'staff') {
    header('Location:../index.php');
}
$sql = "SELECT * FROM users WHERE u_id= $id";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);

$sqlp = "SELECT * FROM users_role  ";
$resultp = mysqli_query($con, $sqlp);


if (isset($_POST["p_id"])) {
    $ids = $_POST["p_id"];

    $sql = "SELECT * FROM file WHERE pd_id='$ids'";
    $query = mysqli_query($con, $sql);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Show file</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <!-- <link rel="stylesheet" href="../css/all.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Theme style -->
    <link rel="stylesheet" href="../css/adminlte.min.css">
    <link rel="stylesheet" href="../css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="../css/switch_insurance.css">
    <style>
        body {
            font-family: 'Prompt', sans-serif;
            font-size: 14px;
        }
    </style>
</head>

<body>


    <div class="form-row">
        <div class="form-group col-md-12">
            <a href="addfile_ad.php?id=<?php echo $ids  ?>" title='เพิ่มไฟล์'>
                <button type=button class="btn btn-info">เพิ่มไฟล์ <i class="fas fa-plus-circle"></i></button><br><br>
            </a>
            <table id="Table" class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>ลำดับ</th>
                        <th>รูปภาพ</th>
                        <th>วันที่เพิ่มไฟล์</th>
                        <th>ลบไฟล์</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    while ($row = mysqli_fetch_array($query)) {
                    ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><img src="../file/<?php echo $row['f_name'] ?>" style="border-radius:50%" width="60"></td>
                            <td><?php echo $row["f_date"]; ?></td>
                            <td>
                                <div class='row'>
                                    <div class='col-5'>
                                        <a href="../backend/delete_file.php?id=<?php echo $row["f_id"]; ?>&submit=DEL" onclick="return confirm('ต้องการจะลบไฟล์นี้หรือไม่ ?')" title='ลบไฟล์'>
                                            <button type=button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i>
                                            </button></a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php
                        $i++;
                    }
                    ?>
                </tbody>
            </table>

            <?php
            ?>

        </div>
    </div>

</body>

</html>