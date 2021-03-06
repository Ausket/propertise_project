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

$sqlt = "SELECT * FROM property_type  ";
$resultt = mysqli_query($con, $sqlt);

$sqlpr = "SELECT * FROM provinces";
$resultpr = mysqli_query($con, $sqlpr);


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
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
                        <h1 style="text-transform: uppercase">?????????????????????????????????</h1>
                    </div>

                </div>
            </div><!-- /.container-fluid -->
        </section>




        <!-- Main content -->
        <section class="content">
            <form action="../backend/addpropertise_db.php" enctype="multipart/form-data" method="POST">
                <div class="container ">
                    <div class="row m-auto">
                        <!-- general form elements -->
                        <div class="column m-auto " style="width: 700px;">
                            <div class="card card-dark">
                                <div class="card-header">
                                    <h3 class="card-title">????????????????????????????????????????????????</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->


                                <div class="card-body">
                                    <div class="form-group">

                                        <label for="exampleInputEmail1">????????????????????????????????????</label>
                                        <select class="custom-select" name="ptype" id="ptype">
                                            <option class="text-center">???????????????????????????????????????????????????</option>
                                            <?php while ($rowt = mysqli_fetch_array($resultt)) { ?>
                                                <?php
                                                if ($rowt['pt_status'] == '1') {
                                                    echo " <option  value=" . $rowt['ptype_id'] . "> " . $rowt['p_type'] . " </option> ";
                                                }
                                                ?>
                                            <?php  } ?>
                                        </select>

                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">?????????????????????????????????</label>
                                        <input type="text" class="form-control" id="exampleInputPassword1" name="project_name" value="" placeholder="?????????????????????????????????">
                                    </div>
                                    <div class="row ">
                                        <div class="form-group  col-md-4">
                                            <label for="exampleInputPassword1">????????????????????????????????????</label>
                                            <input type="number" class="form-control" id="exampleInputPassword1" name="bedroom" value="" placeholder="????????????????????????????????????" required>
                                        </div>
                                        <div class="form-group  col-md-4">
                                            <label for="exampleInputPassword1">????????????????????????????????????</label>
                                            <input type="number" class="form-control" id="exampleInputPassword1" name="bathroom" value="" placeholder="????????????????????????????????????" required>
                                        </div>
                                        <div class="form-group  col-md-4">
                                            <label for="exampleInputPassword1">???????????????????????????????????????/?????????</label>
                                            <input type="number" class="form-control" id="exampleInputPassword1" name="parking" value="" placeholder="???????????????????????????????????????/?????????" required>
                                        </div>
                                    </div>
                                    <div class="form-group">

                                        <label for="exampleInputEmail1">????????????</label>
                                        <input type="type" class="form-control" id="price" name="price" value="" placeholder="????????????" required>

                                    </div>
                                    <div class="form-group">

                                        <label for="exampleInputEmail1">?????????????????????????????????</label>
                                        <input type="type" class="form-control" id="exampleInputEmail1" name="space_area" value="" placeholder="?????????????????????????????????" required>

                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="column m-auto " style="width: 700px;">
                            <div class="card card-dark">
                                <div class="card-header">
                                    <h3 class="card-title">??????????????????????????????????????????????????????</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->

                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-12 ">
                                            <input type="checkbox" id="pool" name="facility[]" value="??????????????????????????????" >
                                            <label  class="mr-5"> ??????????????????????????????</label>
                                            <input type="checkbox" id="library" name="facility[]" value="????????????????????????">
                                            <label  class="mr-5"> ????????????????????????</label>
                                            <input type="checkbox" id="park" name="facility[]" value="??????????????????????????????">
                                            <label class="mr-5"> ??????????????????????????????</label>
                                            <input type="checkbox" id="fitnet" name="facility[]" value="??????????????????">
                                            <label  class="mr-5"> ??????????????????</label><br>
                                            <input type="checkbox" id="store" name="facility[]" value="???????????????????????????????????????">
                                            <label  class="mr-4"> ???????????????????????????????????????</label>
                                            <input type="checkbox" id="playground" name="facility[]" value="????????????????????????????????????">
                                            <label  class="mr-4"> ????????????????????????????????????</label>
                                            <input type="checkbox" id="air" name="facility[]" value="????????????????????????????????????????????????">
                                            <label  class="mr-4"> ????????????????????????????????????????????????</label>
                                            <input type="checkbox" id="wifi" name="facility[]" value="Wi-Fi">
                                            <label  class="mr-5"> Wi-Fi</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="column m-auto" style="width: 700px;">
                            <div class="card card-dark">
                                <div class="card-header">
                                    <h3 class="card-title">???????????????????????????????????????</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->

                                <div class="card-body">
                                    <div class="row ">
                                        <div class="form-group col-md-6">
                                            <label for="exampleInputEmail1">??????????????????????????????</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1" name="house_no" value="" placeholder="??????????????????????????????" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="exampleInputPassword1">????????????</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1" name="village_no" value="" placeholder="????????????" required>
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="form-group col-md-6">
                                            <label for="exampleInputPassword1">?????????</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1" name="lane" value="" placeholder="?????????">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="exampleInputPassword1">?????????</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1" name="road" value="" placeholder="?????????">
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="form-group col-md-4">
                                            <label for="province">?????????????????????</label>
                                            <select name="province_id" id="province" class="form-control">
                                                <option value="">????????????????????????????????????</option>
                                                <?php while ($rowpr = mysqli_fetch_assoc($resultpr)) : ?>
                                                    <option value="<?= $rowpr['id'] ?>"><?= $rowpr['name_th'] ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="amphure">???????????????</label>
                                            <select name="amphure_id" id="amphure" class="form-control">
                                                <option value="">??????????????????????????????</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="district">????????????</label>
                                            <select name="district_id" id="district" class="form-control">
                                                <option value="">???????????????????????????</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">????????????????????????</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="postal_code" value="" placeholder="????????????????????????" required>
                                    </div>

                                    <!-- /.card-body -->
                                </div>

                            </div>
                        </div>
                        <div class="column m-auto" style="width: 700px;">
                            <div class="card card-dark">
                                <div class="card-header">
                                    <h3 class="card-title">??????????????????</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->

                                <div class="card-body">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>
                                                ??????????????????????????????</label>
                                            <input type="file" name="img" id="fileToUpload">
                                        </div>
                                        <div></div>
                                    </div>
                                    <hr>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label>?????????????????????????????????????????????</label>
                                            <input type="text" name="ids" value="<?php echo $ids ?>" hidden>
                                            <input hidden name="date" type="datetime" value=<?php date_default_timezone_set("Asia/Bangkok");
                                                                                            echo date("Y-m-d\TH:i:s"); ?>>
                                            <input name="btnCreate" type="button" class="btn  btn-warning" value="???????????????????????????" onClick="JavaScript:fncCreateElement();">
                                            <input name="btnDelete" type="button" class="btn  btn-danger" value="??????????????????" onClick="JavaScript:fncDeleteElement();"><br><br>
                                            <input name="hdnLine" id="hdnLine" type="hidden" value=0>

                                            <div class="card">
                                                <div class="card-body ">
                                                    <div id="mySpan" name="mySpan">(???????????????????????????) <br>
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
                                                            div.innerHTML = '????????????????????? ' + myLine.value;


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

                                        </div>
                                        <!-- /.card-body -->
                                    </div>

                                </div class="form-group">
                                <button type="submit" name="submit" class="btn btn-success m-auto d-block" style="width: 150px;">??????????????????</button>
                            </div>
            </form>
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
    <script src="../js/script.js"></script>
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
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
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

        /* ---------------------------------------get_amphure  -------------------------------------------------   */

        $('#province').change(function() {



            var id = $(this).val();
            $.ajax({
                type: "post",
                url: "../backend/get_amphure.php",
                data: {
                    province: id
                },

                success: function(data) {

                    $('#amphure').html(data);
                    console.log(data);

                }
            });

        });

        /* ---------------------------------------  -------------------------------------------------   */

        $('#amphure').change(function() {



            var id = $(this).val();
            $.ajax({
                type: "post",
                url: "../backend/get_district.php",
                data: {
                    amphure: id
                },

                success: function(data) {

                    $('#district').html(data);
                    console.log(data);

                }
            });

        });

        function updateTextView(_obj) {
                            var num = getNumber(_obj.val());
                            if (num == 0) {
                                _obj.val('');
                            } else {
                                _obj.val(num.toLocaleString());
                            }
                        }

                        function getNumber(_str) {
                            var arr = _str.split('');
                            var out = new Array();
                            for (var cnt = 0; cnt < arr.length; cnt++) {
                                if (isNaN(arr[cnt]) == false) {
                                    out.push(arr[cnt]);
                                }
                            }
                            return Number(out.join(''));
                        }
                        $(document).ready(function() {
                            $('#price').on('keyup', function() {
                                updateTextView($(this));
                            });
                        });
    </script>

</body>

</html>