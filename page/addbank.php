<?php
require_once('../dbconnect.php');

$id = $_SESSION['u_id'];
if (empty($id)) {
    header('Location:../index.php');
}
$type = $_SESSION['utype'];
if ($type == 'member' || $type == 'agent') {
    header('Location:../index.php');
}
$sql = "SELECT * FROM users WHERE u_id= $id ";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);

$sqlp = "SELECT * FROM users_role  ";
$resultp = mysqli_query($con, $sqlp);



?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Users</title>

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
</head>

<body class="hold-transition sidebar-mini">
    <?php require('admin_nav.php') ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 style="text-transform: uppercase">เพิ่มธนาคาร</h1>
                    </div>
                    
                </div>
            </div><!-- /.container-fluid -->
        </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid ">
                    <div class="row">
                        <div class="offset-sm-3 col-md-6">
                            <!-- general form elements -->
                            <div class="card card-dark">
                                <div class="card-header">
                                    <h3 class="card-title">เพิ่มธนาคาร</h3>

                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->

                                <form action="../backend/addbank_db.php" enctype="multipart/form-data" method="POST">
                                    <div class="card-body">
                                        <div class="form-group">

                                            <label for="exampleInputEmail1">ชื่อธนาคาร</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" name="name" value="" placeholder="ชื่อธนาคาร" required>

                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">วงเงินกู้</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1" name="loan_amount" value="" placeholder="วงเงินกู้" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">อัตราดอกเบี้ย</label>

                                            <input type="text" class="form-control" id="exampleInputPassword1" name="interest_rate" value="" placeholder="อัตราดอกเบี้ย" required>
                                        </div>
                                        <div class="form-group">

                                            <label for="exampleInputEmail1">MRR/MLR</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" name="mrr_mlr" value="" placeholder="MRR/MLR" required>

                                        </div>
                                        <div class="form-group">

                                            <label for="exampleInputEmail1">วงเงินกู้สูงสุด</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" name="max_loan_amount" value="" placeholder="วงเงินกู้สูงสุด" required>

                                        </div>
                                        <div class="form-group">

                                            <label for="exampleInputEmail1">ติดต่อ</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" name="contact" value="" placeholder="ติดต่อ" required>

                                        </div>
                                        <div class="form-group">
                                            <div class="form-group">
                                                เลือกรูปภาพ
                                                <input type="file" name="img" id="fileToUpload">

                                            </div>

                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" name="submit" class="btn btn-primary d-block m-auto">บันทึก</button>
                                    </div>
                                </form>
                            </div>
                            <!-- /.card -->


                            </form>
                        </div>
                        <!-- /.content-wrapper -->

                        <!-- Control Sidebar -->
                        <aside class="control-sidebar control-sidebar-dark">
                            <!-- Control sidebar content goes here -->
                            <div class="p-3">
                                <h5>Title</h5>
                                <p>Sidebar content</p>
                            </div>
                        </aside>
                        <!-- /.control-sidebar -->

                        <!-- Main Footer -->
                    </div>
                    <!-- ./wrapper -->

                    <!-- REQUIRED SCRIPTS -->

                    <!-- jQuery -->
                    <script src="../js/jquery.min.js"></script>
                    <!-- Bootstrap 4 -->
                    <script src="../js/bootstrap.bundle.min.js"></script>
                    <!-- AdminLTE App -->
                    <script src="../js/adminlte.min.js"></script>

                    <script src="../js/jquery.dataTables.min.js"></script>
                    <script src="../js/dataTables.bootstrap4.min.js"></script>
                    <script src="../js/dataTables.responsive.min.js"></script>
                    <script src="../js/responsive.bootstrap4.min.js"></script>
                    <script src="../js/dataTables.buttons.min.js"></script>
                    <script src="../js/buttons.bootstrap4.min.js"></script>
                    <script src="../js/jszip/jszip.min.js"></script>
                    <script src="../js/pdfmake.min.js"></script>
                    <script src="../js/vfs_fonts.js"></script>
                    <script src="../js/buttons.html5.min.js"></script>
                    <script src="../js/buttons.print.min.js"></script>
                    <script src="../js/buttons.colVis.min.js"></script>

                    <script>
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