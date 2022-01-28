<?php
require_once('../dbconnect.php');

$id = $_SESSION['u_id'];
if (empty($id)) {
    header('Location:login.php');
}
$sql = "SELECT * FROM users WHERE u_id= $id ";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);

$sqlp = "SELECT * FROM users_role  ";
$resultp = mysqli_query($con, $sqlp);

$sqlt = "SELECT * FROM property_type  ";
$resultt = mysqli_query($con, $sqlt);

$sqla = "SELECT * FROM advertise_type  ";
$resulta = mysqli_query($con, $sqla);

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
                        <h1 style="text-transform: uppercase">เพิ่มประกาศ</h1>
                    </div>

                </div>
            </div><!-- /.container-fluid -->
        </section>




        <!-- Main content -->
        <section class="content">
            <form action="../backend/addadvertise_db.php" enctype="multipart/form-data" method="POST">
                <div class="container">
                    <div class="row m-auto">
                        <!-- general form elements -->
                        <div class="column m-auto " style="width: 700px;">
                            <div class="card card-dark">
                                <div class="card-header">
                                    <h3 class="card-title">รายละเอียดอสังหา</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->


                                <div class="card-body">
                                    <div class="form-group">

                                        <label for="exampleInputEmail1">ประเภทอสังหา</label>
                                        <select class="custom-select" name="ptype" id="ptype">
                                            <option class="text-center">เลือกประเภทอสังหา</option>
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
                                        <label for="exampleInputPassword1">ชื่อโครงการ</label>
                                        <input type="text" class="form-control" id="exampleInputPassword1" name="project_name" value="" placeholder="ชื่อโครงการ">
                                    </div>
                                    <div class="row ">
                                        <div class="form-group col-md-4">
                                            <label for="exampleInputPassword1">จำนวนห้องนอน</label>
                                            <input type="number" class="form-control" id="exampleInputPassword1" name="bedroom" value="" placeholder="จำนวนห้องนอน" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="exampleInputPassword1">จำนวนห้องน้ำ</label>
                                            <input type="number" class="form-control" id="exampleInputPassword1" name="bathroom" value="" placeholder="จำนวนห้องน้ำ" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="exampleInputPassword1">จำนวนที่จอดรถ/คัน</label>
                                            <input type="number" class="form-control" id="exampleInputPassword1" name="parking" value="" placeholder="จำนวนที่จอดรถ/คัน" required>
                                        </div>
                                    </div>
                                    <div class="form-group">

                                        <label for="exampleInputEmail1">ราคา</label>
                                        <input type="type" class="form-control" id="price" name="price" value="" placeholder="ราคา" required>

                                    </div>
                                    <div class="form-group">

                                        <label for="exampleInputEmail1">ขนาดพื้นที่</label>
                                        <input type="type" class="form-control" id="exampleInputEmail1" name="space_area" value="" placeholder="ขนาดพื้นที่" required>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="column m-auto " style="width: 700px;">
                            <div class="card card-dark">
                                <div class="card-header">
                                    <h3 class="card-title">ที่ตั้งอสังหา</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->

                                <div class="card-body">
                                    <div class="row ">
                                        <div class="form-group col-md-6">
                                            <label for="exampleInputEmail1">บ้านเลขที่</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1" name="house_no" value="" placeholder="บ้านเลขที่" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="exampleInputPassword1">หมู่</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1" name="village_no" value="" placeholder="หมู่" required>
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="form-group col-md-6">
                                            <label for="exampleInputPassword1">ซอย</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1" name="lane" value="" placeholder="ซอย">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="exampleInputPassword1">ถนน</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1" name="road" value="" placeholder="ถนน">
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="form-group col-md-4">
                                            <label for="province">จังหวัด</label>
                                            <select name="province_id" id="province" class="form-control">
                                                <option value="">เลือกจังหวัด</option>
                                                <?php while ($rowpr = mysqli_fetch_assoc($resultpr)) : ?>
                                                    <option value="<?= $rowpr['id'] ?>"><?= $rowpr['name_th'] ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="amphure">อำเภอ</label>
                                            <select name="amphure_id" id="amphure" class="form-control">
                                                <option value="">เลือกอำเภอ</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="district">ตำบล</label>
                                            <select name="district_id" id="district" class="form-control">
                                                <option value="">เลือกตำบล</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">รหัสไปรษณีย์</label>
                                        <input type="text" class="form-control" id="postal_code" name="postal_code" value="" placeholder="รหัสไปรษณีย์" required>
                                    </div>

                                    <!-- /.card-body -->
                                </div>
                            </div>

                            <div class="column m-auto " style="width: 700px;">
                                <div class="card card-dark">
                                    <div class="card-header">
                                        <h3 class="card-title">สิ่งอำนวยความสะดวก</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-md-12 ">
                                                <input type="checkbox" id="pool" name="facility[]" value="สระว่ายน้ำ">
                                                <label class="mr-5"> สระว่ายน้ำ</label>
                                                <input type="checkbox" id="library" name="facility[]" value="ห้องสมุด">
                                                <label class="mr-5"> ห้องสมุด</label>
                                                <input type="checkbox" id="park" name="facility[]" value="สวนสาธารณะ">
                                                <label class="mr-5"> สวนสาธารณะ</label>
                                                <input type="checkbox" id="fitnet" name="facility[]" value="ฟิตเนส">
                                                <label class="mr-5"> ฟิตเนส</label><br>
                                                <input type="checkbox" id="store" name="facility[]" value="ร้านสะดวกซื้อ">
                                                <label class="mr-4"> ร้านสะดวกซื้อ</label>
                                                <input type="checkbox" id="playground" name="facility[]" value="สนามเด็กเล่น">
                                                <label class="mr-4"> สนามเด็กเล่น</label>
                                                <input type="checkbox" id="air" name="facility[]" value="เครื่องปรับอากาศ">
                                                <label class="mr-4"> เครื่องปรับอากาศ</label>
                                                <input type="checkbox" id="wifi" name="facility[]" value="Wi-Fi">
                                                <label class="mr-5"> Wi-Fi</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="column m-auto" style="width: 700px;">
                                <div class="card card-dark">
                                    <div class="card-header">
                                        <h3 class="card-title">รูปภาพ</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <div class="card-body">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label>
                                                    รูปภาพหลัก</label>
                                                <input type="file" name="img" id="imageUpload">
                                            </div>
                                            <div></div>
                                        </div>
                                        <hr>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label>รูปภาพเพิ่มเติม</label>
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

                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                    </div>
                                </div>
                                <div class="column m-auto" style="width: 700px;">
                                    <div class="card card-dark">
                                        <div class="card-header">
                                            <h3 class="card-title">รายละเอียดประกาศ</h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <!-- form start -->

                                        <div class="card-body">
                                            <div class="form-group">

                                                <label for="exampleInputEmail1">ประเภทประกาศ</label>
                                                <select class="custom-select" name="atype" id="atype">
                                                    <option class="text-center">เลือกประเภทประกาศ</option>
                                                    <?php while ($rowa = mysqli_fetch_array($resulta)) { ?>
                                                        <?php
                                                        if ($rowa['at_status'] == '1') {
                                                            echo " <option  value=" . $rowa['atype_id'] . "> " . $rowa['type'] . " </option> ";
                                                        }
                                                        ?>
                                                    <?php  } ?>
                                                </select>

                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">หัวข้อ</label>
                                                <input type="text" class="form-control" id="exampleInputPassword1" name="title" value="" placeholder="หัวข้อ" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">บรรยาย</label>
                                                <textarea type="text" class="form-control" id="describe" name="describe" value="" placeholder="บรรยาย" required></textarea>
                                                <script>
                                                    CKEDITOR.replace('describe');

                                                    function CKupdate() {
                                                        for (instance in CKEDITOR.instances)
                                                            CKEDITOR.instances[instance].updateElement();
                                                    }
                                                </script>
                                            </div>


                                            <!-- /.card-body -->
                                        </div>

                                    </div>
                                    <button type="submit" name="submit" class="btn btn-success m-auto d-block " style="width: 150px;">ประกาศ</button>
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