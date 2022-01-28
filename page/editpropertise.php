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

$sqlpr = "SELECT * FROM provinces";
$resultpr = mysqli_query($con, $sqlpr);



$id2 = $_GET["id"];
$sql2 = "SELECT property_detail.pd_id,property_detail.project_name,property_detail.bedroom,property_detail.bathroom,property_detail.parking,
property_detail.price,property_detail.space_area,property_detail.img_video,location_property.l_id,location_property.house_no,property_detail.facility,
location_property.village_no,location_property.lane,location_property.road,location_property.province_id,location_property.amphure_id,
location_property.district_id,location_property.postal_code,location_property.latitude,location_property.longitude,property_type.p_type 
FROM ((property_detail
    LEFT  JOIN location_property ON property_detail.l_id = location_property.l_id)
    LEFT  JOIN property_type ON property_detail.ptype_id = property_type.ptype_id)
WHERE pd_id =  $id2
    ";
$result2 = mysqli_query($con, $sql2) or die(mysqli_error($con));
$row2 = mysqli_fetch_assoc($result2);

$sql3 = "SELECT location_property.l_id,location_property.province_id,location_property.amphure_id,location_property.district_id,
provinces.name_th,amphures.aname_th,districts.dname_th
FROM (((location_property
INNER  JOIN provinces ON location_property.province_id = provinces.id)
INNER  JOIN amphures ON location_property.amphure_id = amphures.id)
INNER JOIN districts ON location_property.district_id = districts.id) 
";
$result3 = mysqli_query($con, $sql3)  or die(mysqli_error($con));

$facility_arr = array("สระว่ายน้ำ", "ห้องสมุด", "สวนสาธารณะ", "ฟิตเนส", "ร้านสะดวกซื้อ", "สนามเด็กเล่น", "เครื่องปรับอากาศ", "Wi-Fi");

$sqlt = "SELECT * FROM property_type  ";
$resultt = mysqli_query($con, $sqlt);

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
                        <h1 style="text-transform: uppercase">แก้ไขอสังหา</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>




        <!-- Main content -->
        <section class="content">
            <form action="../backend/edit_propertise_db.php?id=<?php echo $row2['l_id'] ?>" enctype="multipart/form-data" method="POST">
                <div class="container ">
                    <div class="row m-auto">
                        <!-- general form elements -->
                        <div class="column  " style="width: 500px;">
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
                                            <?php foreach ($resultt as $value) {  ?>

                                                <?php if ($value['pt_status'] == '1') { ?>
                                                    <option value="<?php echo $value['ptype_id'] ?>" <?php if ($value['p_type'] == $row2['p_type']) {
                                                                                                            echo "selected";
                                                                                                        } ?>>
                                                        <?php echo $value['p_type']; ?></option>
                                                <?php  } ?>



                                            <?php  } ?>
                                        </select>

                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">ชื่อโครงการ</label>
                                        <input type="text" class="form-control" id="exampleInputPassword1" name="project_name" value="<?php echo $row2['project_name']; ?>" placeholder="ชื่อโครงการ">
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="exampleInputPassword1">จำนวนห้องนอน</label>
                                            <input type="number" class="form-control" id="exampleInputPassword1" name="bedroom" value="<?php echo $row2['bedroom']; ?>" placeholder="จำนวนห้องนอน" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="exampleInputPassword1">จำนวนห้องน้ำ</label>
                                            <input type="number" class="form-control" id="exampleInputPassword1" name="bathroom" value="<?php echo $row2['bathroom']; ?>" placeholder="จำนวนห้องน้ำ" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="exampleInputPassword1">จำนวนที่จอดรถ/คัน</label>
                                            <input type="number" class="form-control" id="exampleInputPassword1" name="parking" value="<?php echo $row2['parking']; ?>" placeholder="จำนวนที่จอดรถ/คัน" required>
                                        </div>
                                    </div>
                                    <div class="form-group">

                                        <label for="exampleInputEmail1">ราคา</label>
                                        <input type="type" class="form-control" id="price" name="price" value="<?php echo $row2['price']; ?>" placeholder="ราคา" required>

                                    </div>
                                    <div class="form-group">

                                        <label for="exampleInputEmail1">ขนาดพื้นที่</label>
                                        <input type="type" class="form-control" id="exampleInputEmail1" name="space_area" value="<?php echo $row2['space_area']; ?>" placeholder="ขนาดพื้นที่" required>

                                    </div>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <div class="form-group col-md-4">
                                                <label>รูปภาพเดิม</label><br>
                                                <img src="../image/p_img/<?php echo $row2['img_video']; ?>" width="40%"> &nbsp;&nbsp;
                                            </div>
                                            <div class="form-group col-md-3">
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
                                                <img id="imgAvatar" width="50%">
                                            </div>
                                            <label>เลือกรูปภาพ</label>
                                            <input type="file" name="img" id="fileToUpload">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                        $province_id = $row2['province_id'];
                        $sqlpa = "SELECT * FROM amphures WHERE province_id = $province_id";
                        $resultpa = mysqli_query($con, $sqlpa);


                        $amphure_id = $row2['amphure_id'];
                        $sqld = "SELECT * FROM districts WHERE amphure_id = $amphure_id";
                        $resultd = mysqli_query($con, $sqld);
                        ?>

                        <div class="column m-auto" style="width: 600px;">
                            <div class="card card-dark">
                                <div class="card-header">
                                    <h3 class="card-title">ที่ตั้งอสังหา</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->

                                <div class="card-body">
                                    <div class="form-group">

                                        <label for="exampleInputEmail1">บ้านเลขที่</label>
                                        <input type="text" class="form-control" id="exampleInputPassword1" name="house_no" value="<?php echo $row2['house_no']; ?>" placeholder="บ้านเลขที่" required>

                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">หมู่</label>
                                        <input type="text" class="form-control" id="exampleInputPassword1" name="village_no" value="<?php echo $row2['village_no']; ?>" placeholder="หมู่" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">ซอย</label>
                                        <input type="text" class="form-control" id="exampleInputPassword1" name="lane" value="<?php echo $row2['lane']; ?>" placeholder="ซอย">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">ถนน</label>
                                        <input type="text" class="form-control" id="exampleInputPassword1" name="road" value="<?php echo $row2['road']; ?>" placeholder="ถนน">
                                    </div>
                                    <div class="row ">
                                        <div class="form-group col-md-4">
                                            <label for="province">จังหวัด</label>
                                            <select name="province_id" id="province" class="form-control">
                                                <option value="">เลือกจังหวัด</option>
                                                <?php while ($rowpr = mysqli_fetch_assoc($resultpr)) {


                                                ?>
                                                    <option value="<?= $rowpr['id'] ?>" <?php if ($row2['province_id'] == $rowpr['id']) { ?> selected="selected" <?php } ?>><?= $rowpr['name_th'] ?></option>

                                                <?php   } ?>

                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="amphure">อำเภอ</label>
                                            <select name="amphure_id" id="amphure" class="form-control">
                                                <option value="">เลือกอำเภอ</option>
                                                <?php while ($rowpa = mysqli_fetch_assoc($resultpa)) {


                                                ?>
                                                    <option value="<?= $rowpa['id'] ?>" <?php if ($row2['amphure_id'] == $rowpa['id']) { ?> selected="selected" <?php } ?>><?= $rowpa['aname_th'] ?></option>

                                                <?php   } ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="district">ตำบล</label>
                                            <select name="district_id" id="district" class="form-control">
                                                <option value="">เลือกตำบล</option>
                                                <?php while ($rowd = mysqli_fetch_assoc($resultd)) {


                                                ?>
                                                    <option value="<?= $rowd['id'] ?>" <?php if ($row2['district_id'] == $rowd['id']) { ?> selected="selected" <?php } ?>><?= $rowd['dname_th'] ?></option>

                                                <?php   } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">

                                        <label for="exampleInputEmail1">ไปรษณีย์</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="postal_code" value="<?php echo $row2['postal_code']; ?>" placeholder="ไปรษณีย์" required>

                                    </div>

                                    <!-- /.card-body -->
                                </div>
                            </div>

                            <div class="column m-auto " style="width: 600px;">
                                <div class="card card-dark">
                                    <div class="card-header">
                                        <h3 class="card-title">สิ่งอำนวยความสะดวก</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-md-12 ">
                                                <?php
                                                $facility = explode(",", $row2['facility']); //array
                                                foreach ($facility_arr as $value) {
                                                    if (in_array($value, $facility)) {
                                                        echo " <input type='checkbox' id='' name='facility[]' value='$value'checked >
                                                        <label  class='mr-4'> $value</label>";
                                                    } else {
                                                        echo " <input type='checkbox' id='' name='facility[]' value='$value' >
                                                        <label  class='mr-4'> $value</label>";
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <button type="submit" name="submit" class="btn btn-success m-auto d-block" style="width: 150px;">บันทึก</button>
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

            $('#district').html('<option value="" selected disabled class="text-center">เลือกตำบล</option>');

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