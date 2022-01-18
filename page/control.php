<?php
require_once('../dbconnect.php');

$id = $_SESSION['u_id'];
if (empty($id)) {
    header('Location:login.php');
}
if ($_SESSION['utype'] !== 'admin') {
    echo "<script type='text/javascript'>alert('คุณไม่มีสิทธิ์เข้าถึงหน้านี้');
    window.location.href='index.php';</script>";
}
$sql = "SELECT * FROM users WHERE u_id= $id ";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);

$order = 1;

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
    <link rel="stylesheet" href="../css/switch_insurance.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <?php require('admin_nav.php') ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 style="text-transform: uppercase">ตั้งค่าสิทธิ์ผู้ใช้</h1>
                        </div>

                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid ">
                    <div class="row">
                        <div class="offset-1 col-10">
                            <form action="" method="post">
                                <div class="card card-dark">
                                    <div class=" card-header">
                                        <h3 class="card-title ">ตั้งค่าสิทธิ์ผู้ใช้</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table id="example2" class="table table-bordered table-hover text-md-center">
                                            <thead>
                                                <tr>
                                                    <th>ลำดับที่</th>
                                                    <th>ชื่อหน้า</th>
                                                    <th>ผู้ดูแลระบบ</th>
                                                    <th>พนักงาน</th>
                                                    <th>สมาชิก</th>
                                                    <th>ตัวแทน</th>
                                                    <th>จัดการ</th>


                                                </tr>
                                            </thead>
                                            <tbody>
                                                <div class="form-group">
                                                    <?php
                                                    $sqlc = "SELECT * FROM users_role  ";
                                                    $resultc = mysqli_query($con, $sqlc);
                                                    while ($rowc = mysqli_fetch_assoc($resultc)) {
                                                        $idr = $rowc['p_id'];
                                                    ?>

                                                        <tr>

                                                            <td><?php echo $order++; ?></td>
                                                            <td><label for="page"><?php echo $rowc['page']; ?></label></td>
                                                            <td>
                                                                <?php if ($rowc['admin'] == '1') {

                                                                    $status = 'checked';
                                                                } else {
                                                                    $status = '';
                                                                } ?>

                                                                <label class="switch">
                                                                    <input type="checkbox" name="id" class="change" <?php echo $status ?> id="<?php echo $rowc['p_id']; ?>">
                                                                    <div class="slider round"> </div>

                                                                </label>

                                                            </td>
                                                            <td>
                                                                <?php if ($rowc['staff'] == '1') {

                                                                    $status = 'checked';
                                                                } else {
                                                                    $status = '';
                                                                } ?>

                                                                <label class="switch">
                                                                    <input type="checkbox" name="id" class="change3" <?php echo $status ?> id="<?php echo $rowc['p_id']; ?>">
                                                                    <div class="slider round"> </div>

                                                                </label>

                                                            </td>
                                                            <td>
                                                                <?php if ($rowc['member'] == '1') {

                                                                    $status = 'checked';
                                                                } else {
                                                                    $status = '';
                                                                } ?>

                                                                <label class="switch">
                                                                    <input type="checkbox" name="id" class="change2" <?php echo $status ?> id="<?php echo $rowc['p_id']; ?>">
                                                                    <div class="slider round"> </div>

                                                                </label>

                                                            </td>
                                                            <td>
                                                                <?php if ($rowc['agent'] == '1') {

                                                                    $status = 'checked';
                                                                } else {
                                                                    $status = '';
                                                                } ?>

                                                                <label class="switch">
                                                                    <input type="checkbox" name="id" class="change4" <?php echo $status ?> id="<?php echo $rowc['p_id']; ?>">
                                                                    <div class="slider round"> </div>

                                                                </label>

                                                            </td>
                                                            <td>
                                                                <a href="tab_edit.php?id=<?php echo  $idr ?>" class="btn btn-primary"><i class="far fa-edit"></a></i>&nbsp;
                                                                <a href="../backend/tab_delete.php?id=<?php echo  $idr ?>" onclick="return confirm('Are you sure to delete ?')" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
                                                            </td>

                                                        </tr>
                                                    <?php  } ?>
                                                </div>
                                            </tbody>
                                            <div>
                                                <a href="tab_manage.php" class="btn btn-warning">เพิ่มหน้า</a>

                                        </table>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.content -->
                </div>
                <!-- /.content-wrapper -->
            </section>

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
        <!-- jQuery -->


        <!-- REQUIRED SCRIPTS -->

        <!-- jQuery -->
        <script src="../js/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="../js/bootstrap.bundle.min.js"></script>
        <!-- DataTables  & Plugins -->
        <script src="../js/jquery.dataTables.min.js"></script>
        <script src="../js/dataTables.bootstrap4.min.js"></script>
        <script src="../js/dataTables.responsive.min.js"></script>
        <script src="../js/responsive.bootstrap4.min.js"></script>
        <script src="../js/dataTables.buttons.min.js"></script>
        <script src="../js/buttons.bootstrap4.min.js"></script>
        <script src="../js/buttons.html5.min.js"></script>
        <script src="../js/buttons.print.min.js"></script>
        <script src="../js/buttons.colVis.min.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!-- AdminLTE App -->
        <script src="../js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="../js/demo.js"></script>
        <!-- Page specific script -->
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
        <script>
            $(document).on('click', '.change', function() {
                var status_id = $(this).attr("id");
                if (status_id != '') {
                    $.ajax({
                        url: "../backend/control_admin.php",
                        method: "POST",
                        data: {
                            status_id: status_id
                        },
                        success: function(data) {
                            Swal.fire({
                                position: 'top-center',
                                icon: 'success',
                                title: 'อัพเดทสำเร็จ',
                                showConfirmButton: false,
                                timer: 1000
                            })
                            setTimeout(function() {
                                window.location = window.location;
                            }, 1000);
                        }

                    });
                }
            });

            $(document).on('click', '.change2', function() {
                var status_id = $(this).attr("id");
                if (status_id != '') {
                    $.ajax({
                        url: "../backend/control_member.php",
                        method: "POST",
                        data: {
                            status_id: status_id
                        },
                        success: function(data) {
                            Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'อัพเดทสำเร็จ',
                        showConfirmButton: false,
                        timer: 1000
                    })
                    setTimeout(function() {
                        window.location = window.location;
                    }, 1000);
                        }
                    });
                }
            });
            $(document).on('click', '.change3', function() {
                var status_id = $(this).attr("id");
                if (status_id != '') {
                    $.ajax({
                        url: "../backend/control_staff.php",
                        method: "POST",
                        data: {
                            status_id: status_id
                        },
                        success: function(data) {
                            Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'อัพเดทสำเร็จ',
                        showConfirmButton: false,
                        timer: 1000
                    })
                    setTimeout(function() {
                        window.location = window.location;
                    }, 1000);
                        }
                    });
                }
            });
            $(document).on('click', '.change4', function() {
                var status_id = $(this).attr("id");
                if (status_id != '') {
                    $.ajax({
                        url: "../backend/control_agent.php",
                        method: "POST",
                        data: {
                            status_id: status_id
                        },
                        success: function(data) {
                            Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'อัพเดทสำเร็จ',
                        showConfirmButton: false,
                        timer: 1000
                    })
                    setTimeout(function() {
                        window.location = window.location;
                    }, 1000);

                        }
                    });
                }
            });
        </script>
        </script>
</body>

</html>