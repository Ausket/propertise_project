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

$sql = "SELECT * FROM users WHERE u_id= $id ";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);

$sqlp = "SELECT * FROM users_role  ";
$resultp = mysqli_query($con, $sqlp);

$idb = $_GET["id"];

$sqla = "SELECT * FROM article_type  ";
$resulta = mysqli_query($con, $sqla);

$sql2 = "SELECT article.a_title , article.a_note , article.a_img , article.a_img , article.a_status , article.a_id,
article_type.a_type
FROM (article
INNER  JOIN  article_type ON article.at_id = article_type.at_id)
WHERE a_id= $idb ";
$result2 = mysqli_query($con, $sql2);
$row2 = mysqli_fetch_assoc($result2);
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
    <script src="http://cdn.ckeditor.com/4.6.2/standard-all/ckeditor.js"></script>
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
                        <h1 style="text-transform: uppercase">แก้ไขข้อมูล</h1>
                    </div>

                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid ">
                <div class="row">
                    <div class="offset-3 col-md-6">
                        <!-- general form elements -->
                        <div class="card card-dark">
                            <div class="card-header">
                                <h3 class="card-title">แก้ไขข้อมูล</h3>

                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->

                            <form action="../backend/edit_article_db.php?id=<?php echo $row2['a_id'] ?>" enctype="multipart/form-data" method="POST">
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="exampleInputPassword1">หัวข้อหลัก</label>
                                        <select class="custom-select" name="type" id="ptype">
                                            <option class="text-center">เลือกประเภทบทความ</option>
                                            <?php foreach ($resulta as $value) {  ?>

                                                <?php if ($value['at_status'] == '1') { ?>
                                                    <option value="<?php echo $value['at_id'] ?>" <?php if ($value['a_type'] == $row2['a_type']) {
                                                                                                            echo "selected";
                                                                                                        } ?>>
                                                        <?php echo $value['a_type']; ?></option>
                                                <?php  } ?>
                                            <?php  } ?>

                                        </select>
                                    </div>
                                    <div class="form-group">

                                        <label for="exampleInputEmail1">หัวข้อย่อย</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="title" value="<?php echo $row2['a_title']; ?>" required>

                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">รายละเอียด</label>
                                        <textarea type="text" class="form-control" id="note" name="note" value="" required><?php echo $row2['a_note']; ?></textarea>
                                        <script>
                                            CKEDITOR.replace('note', {
                                                height: 300,
                                                filebrowserUploadUrl: '../backend/upload.php'
                                            });
                                        </script>
                                    </div>


                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label>รูปภาพเดิม</label><br>
                                                <img src="../image/a_img/<?php echo $row2['a_img']; ?>" width="40%"> &nbsp;&nbsp;
                                            </div>
                                            <div class="form-group col-md-4">
                                                <script language="JavaScript">
                                                    function showPreview(ele) { //ฟังก์โชว์ภาพก่อน กด submit 
                                                        $('#imgAvatar').attr('src', ele.value);
                                                        if (ele.files && ele.files[0]) {

                                                            var reader = new FileReader();

                                                            reader.onload = function(e) {
                                                                $('#imgAvatar').attr('src', e.target.result);
                                                            }
                                                            reader.readAsDataURL(ele.files[0]);
                                                        }
                                                    }
                                                </script>
                                                <img id="imgAvatar" width="40%">
                                            </div>
                                            <div class="form-group">
                                                เลือกรูปภาพใหม่
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