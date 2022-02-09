<?php

// require('../base_require.php');
// require('../../../config.php');
// require('../connect.php');
require('../dbconnect.php');

$id = $_SESSION['u_id'];
if (empty($id)) {
    header('Location: ../index.php');
}
$type = $_SESSION['utype'];
if ($type != 'admin' || $type != 'staff') {
    header('Location:../index.php');
}

$sqlData = "SELECT * FROM pay_status";
$result = mysqli_query($con, $sqlData)

// if (isset($_POST['submit'])) {
//     $path_api = $_POST['path-api'];
//     $customer_key = $_POST['customer-key'];
//     $public_key = $_POST['public-key'];
//     $secret_key = $_POST['secret-key'];
//     echo "<script>alert('$secret_key')</script>";
// }


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Paymant Status</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <!-- <link rel="stylesheet" href="../css/all.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Theme style -->
    <link rel="stylesheet" href="../css/adminlte.min.css">
    <link rel="stylesheet" href="../css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../css/buttons.bootstrap4.min.css">
</head>
<?php
include('admin_nav.php');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div classฟ="container-fluid">
            <div class="row mb-2 ml-2">
                <div class="col-sm-6">
                    <h1 style="text-transform: uppercase">สถานะการชำระเงิน</h1>
                    </h1>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="mr-2 ml-2 text-center">
            <table id="statusTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>ลำดับ</th>
                        <th>หมายเลขคำสั่งซื้อ</th>
                        <th>วันและเวลาสั่งซื้อ</th>
                        <th>รหัสอ้างอิงการชำระเงิน</th>
                        <th>จำนวนเงิน</th>
                        <th>สถานะการชำระเงิน</th>
                        <th>วันและเวลาชำระเงิน</th>
                        <th>จัดการ</th>


                    </tr>
                </thead>
                <tbody>

                    <?php
                    $i = 1;
                    while ($row = mysqli_fetch_array($result)) { ?>
                        <tr>
                            <td><?php echo $i++ ?></td>
                            <td><?php echo $row['referenceNo'] ?></td>
                            <td><?php echo $row['datetime_order'] ?></td>

                            <td>
                                <?php
                                if (!empty($row['gbpReferenceNo'])) {
                                    echo $row['gbpReferenceNo'];
                                } else {
                                    echo '-';
                                }
                                ?>
                            </td>

                            <td><?php echo $row['price']; ?></td>

                            <td>
                                <?php
                                if (!empty($row['resultCode'])) {
                                    if ($row['resultCode'] == "00") {

                                        echo "<span class='badge rounded-pill bg-success'>จ่ายแล้ว</span>";
                                    } else {
                                        echo "<span class='badge rounded-pill bg-danger'>เกิดข้อผิดพลาด</span>";
                                    }
                                } else {
                                    echo "<span class='badge rounded-pill bg-primary'>ค้างชำระ</span>";
                                }
                                ?>
                            </td>

                            <td>

                                <?php
                                if (!empty($row['date'])) {
                                    echo $row['date'] . " - " . $row['time'] . "น.";
                                } else {
                                    echo "-";
                                }
                                ?>

                            </td>





                            <td class="text-center">
                                <!-- <a href="" class="btn btn-info rounded-pill"><i class="far fa-edit"></i>
                                        <b>แก้ไข</b>
                                    </a> -->
                                &nbsp;
                                <a href="del.php?id=<?= $row['id'] ?>" onclick="return confirm('ต้องการลบจริงหรือไม่?')" class="btn btn-danger rounded-pill"><i class="far fa-trash-alt"></i>
                                    <b>ลบ</b>
                                </a>

                            </td>

                        </tr>


                    <?php  } ?>


                </tbody>

            </table>
        </div>
        <!-- /.content-wrapper -->
    </section>

    <!-- Main Footer -->
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<script src="../js/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../js/jquery.dataTables.min.js"></script>
<script src="../js/dataTables.bootstrap4.min.js"></script>
<script src="../js/dataTables.responsive.min.js"></script>
<script src="../js/responsive.bootstrap4.min.js"></script>
<script src="../js/dataTables.buttons.min.js"></script>
<script src="../js/adminlte.min.js"></script>
<script src="../js/buttons.bootstrap4.min.js"></script>
<script src="../js/jszip/jszip.min.js"></script>
<script src="../js/pdfmake.min.js"></script>
<script src="../js/vfs_fonts.js"></script>
<script src="../js/buttons.html5.min.js"></script>
<script src="../js/buttons.print.min.js"></script>
<script src="../js/buttons.colVis.min.js"></script>

<script>
    $(document).ready(function() {
        $("#statusTable").DataTable({
            "scrollY": 600,
            "scrollX": true,
            "responsive": true,
            "autoWidth": false,
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true
        });
    });

    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>

</body>


</html>