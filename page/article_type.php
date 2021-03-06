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

$sql = "SELECT * FROM users WHERE u_id= $id";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);

$sqlp = "SELECT * FROM users_role  ";
$resultp = mysqli_query($con, $sqlp);

$sql2 = "SELECT * FROM article_type ORDER BY at_id DESC";
$result2 = mysqli_query($con, $sql2);
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
    <?php require('admin_nav.php') ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 style="text-transform: uppercase">??????????????????????????????????????????</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid ">
                <div class="row">
                    <div class="offset-2 col-8">

                        <!-- /.card -->

                        <div class="card">
                            <div class="card-header">
                            <div id="input"><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#input-modal">
                                    ???????????????????????????????????????<i class="fas fa-hand-holding-heart"></i></button></div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>???????????????</th>
                                            <th>?????????????????????????????????</th>
                                            <th>???????????????</th>
                                            <th>??????????????????</th>


                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php while ($row2 = mysqli_fetch_array($result2)) { ?>
                                            <tr>
                                                <td><?php echo $order++ ?></td>
                                                <td><?php echo $row2['a_type']; ?></td>
                                                <td>
                                                    <?php if ($row2['at_status'] == '1') {

                                                        $status = 'checked';
                                                    } else {
                                                        $status = '';
                                                    } ?>

                                                    <label class="switch">
                                                        <input type="checkbox" name="id" class="change" <?php echo $status ?> id="<?php echo $row2['at_id']; ?>">
                                                        <div class="slider round"> </div>

                                                    </label>

                                                </td>



                                                <td class="text-center">
                                                    <a href="edit_article_type.php?id=<?php echo $row2['at_id']; ?>" class="btn btn-primary"><i class="far fa-edit"></a></i>&nbsp;
                                                    <a href="../backend/del_article_type.php?id=<?php echo $row2['at_id']; ?>" onclick="return confirm('Are you sure to delete ?')" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
                                                </td>

                                            </tr>


                                        <?php  } ?>


                                    </tbody>

                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
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
                            "autoWidth": false
                            // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
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
                    $(document).on('click', '.change', function() {
                        var status_id = $(this).attr("id");
                        if (status_id != '') {
                            $.ajax({
                                url: "../backend/update_status_atype.php",
                                method: "POST",
                                data: {
                                    status_id: status_id
                                },
                                success: function(data) {

                                    console.log(data);
                                }
                            });
                        }
                    });
                </script>
                <!-- Modal -->
               
                <div id="input-modal" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h3>???????????????????????????????????????</h3>
                                <a class="close" data-dismiss="modal">??</a>
                            </div>
                            <form id="inputform" name="input" role="form">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="name">????????????????????????????????????</label>
                                        <input type="text" name="type" class="form-control">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <input type="submit" class="btn btn-success" id="submit">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <script>
                    $(document).ready(function() {
                        $("#inputform").submit(function(event) {
                            submitForm();
                            return false;
                        });
                    });

                    function submitForm() {
                        $.ajax({
                            type: "POST",
                            url: "../backend/add_article_type.php",
                            cache: false,
                            data: $('form#inputform').serialize(),
                            success: function(response) {
                                $("#input").html(response)
                                $("#input-modal").modal('hide');
                            },
                            error: function() {
                                alert("Error");
                            }
                        });
                    }
                </script>
</body>

</html>