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

$idf = $_GET['id'];
$sqlf = "SELECT * FROM propertise_detail WHERE pd_id = $idf";
$resultf = mysqli_query($con, $sqlf);


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
    <script src="//cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
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
                        <h1 style="text-transform: uppercase">เพิ่มไฟล์</h1>
                    </div>

                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->

        <div class="column m-auto" style="width: 700px;">
            <div class="card card-dark">
                <div class="card-header">
                    <h3 class="card-title">รูปภาพ</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="../backend/addfile_pro_db.php?id=<?php echo $idf?>" enctype="multipart/form-data" method="POST">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>รูปภาพเพิ่มเติม</label>
                                <div></div>
                                <input type="text" name="ids" value="<?php echo $ids ?>" hidden>
                                <input hidden name="date" type="datetime" value=<?php date_default_timezone_set("Asia/Bangkok");
                                                                                echo date("Y-m-d\TH:i:s"); ?>>
                                <input name="btnCreate" type="button" class="btn  btn-warning" value="เพิ่มไฟล์" onClick="JavaScript:fncCreateElement();">
                                <input name="btnDelete" type="button" class="btn  btn-danger" value="ลบไฟล์" onClick="JavaScript:fncDeleteElement();"><br><br>
                                <input name="hdnLine" id="hdnLine" type="hidden" value=0>

                                <div class="card">
                                    <div class="card-body ">
                                        <div id="mySpan" name="mySpan">(ไฟล์ต่างๆ) <br>
                                        </div>
                                        <script language="javascript">
                                            function fncCreateElement() {

                                                var mySpan = document.getElementById('mySpan');
                                                var myLine = document.getElementById('hdnLine');
                                                myLine.value++;

                                                var myElement4 = document.createElement('br');
                                                myElement4.setAttribute('name', "br" + myLine.value);
                                                myElement4.setAttribute('id', "br" + myLine.value);
                                                mySpan.appendChild(myElement4);

                                                var div = document.createElement('div');
                                                div.id = 'div' + myLine.value;
                                                div.className = 'card-body bg-light';
                                                div.innerHTML = 'ไฟล์ที่ ' + myLine.value;


                                                var myElement4 = document.createElement('br');
                                                myElement4.setAttribute('name', "br" + myLine.value);
                                                myElement4.setAttribute('id', "br" + myLine.value);
                                                div.appendChild(myElement4);

                                                var myElement2 = document.createElement('input');
                                                myElement2.setAttribute('type', "file");
                                                myElement2.setAttribute('name', "file[]");
                                                myElement2.setAttribute('id', "file" + myLine.value);
                                                myElement2.setAttribute('required', 'true');
                                                div.appendChild(myElement2);

                                                var myElement4 = document.createElement('br');
                                                myElement4.setAttribute('name', "br" + myLine.value);
                                                myElement4.setAttribute('id', "br" + myLine.value);
                                                div.appendChild(myElement4);

                                                mySpan.appendChild(div);


                                            }

                                            function fncDeleteElement() {

                                                var mySpan = document.getElementById('mySpan');
                                                var myLine = document.getElementById('hdnLine');

                                                var deleteSpan = document.getElementById('div' + myLine.value);
                                                mySpan.removeChild(deleteSpan);

                                                var deleteBr = document.getElementById("br" + myLine.value);
                                                mySpan.removeChild(deleteBr);
                                                // var deleteFile = document.getElementById("file" + myLine.value);
                                                // mySpan.removeChild(deleteFile);
                                                // var deleteBr = document.getElementById("br" + myLine.value);
                                                // mySpan.removeChild(deleteBr);


                                                myLine.value--;

                                            }
                                        </script>
                                    </div>
                                </div>
                                <button type="submit" name="submit" class="btn btn-success m-auto d-block " style="width: 150px;">บันทึก</button>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>

    </section>
    <!-- /.card-body -->

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


</body>

</html>