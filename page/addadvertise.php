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

$sqla = "SELECT * FROM advertise_type  ";
$resulta = mysqli_query($con, $sqla);

$sqlpr = "SELECT * FROM provinces";
$resultpr = mysqli_query($con, $sqlpr);

$sqlpa = "SELECT * FROM (pay_status 
LEFT JOIN package_type ON pay_status.pack_name = package_type.pack_name)
WHERE u_id= $id AND void = '0' AND resultCode = '00' AND pack_status = '1'  ORDER BY pay_status.id DESC";
$resultpa = mysqli_query($con, $sqlpa);


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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
    <!--   <script src="../js/jquery.min.js"></script>
 -->
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.css' rel='stylesheet' />
    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.2/mapbox-gl-geocoder.min.js"></script>
    <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.2/mapbox-gl-geocoder.css" type="text/css">
    <script src="https://cdn.jsdelivr.netnpmsweetalert2@11script"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.css">
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

                                        <label for="exampleInputEmail1">แพ็คเกจของคุณ</label>
                                        <select class="custom-select" name="packtype" id="package" required>
                                            <option class="text-center">เลือกแพ็คเกจ</option>
                                            <?php while ($row = mysqli_fetch_array($resultpa)) {
                                                $period = $row['period'];
                                                $time = strtotime($row['datetime_order']);
                                                $month = '+' . $period . 'day';
                                                $stop_date = date('d-m-Y', strtotime($month, $time));
                                                $allad = $row['num_ad'];


                                                echo " <option  value=" . $row['id'] . "> " . "ชื่อแพ็คเกจ : " . $row['pack_name'] . " /วันสั่งซื้อ " . date('d-m-Y', strtotime($row['datetime_order'])) . " /หมดอายุ " . $stop_date . " /ราคา " . $row['price'] . " /จำนวนประกาศ " . $allad . " </option> ";
                                            } ?>
                                        </select>
                                        <input type="text" id="idpack" name="idpack" hidden>
                                        <input type="text" id="numimg" name="numimg" hidden>
                                        <input type="text" id="numad" name="numad" hidden>
                                    </div>
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
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">แผนที่</label>
                                        <div id="map" style="height: 296px"></div>
                                        <div class="form-row mx-n2">
                                            <div class="col-md-6 col-lg-12 col-xxl-6 px-2">
                                                <div class="form-group mb-md-0">
                                                    <label for="latitude"> ละติจูด </label>
                                                    <input type="text" class="form-control form-control-lg border-0" id="lat" name="latitude" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-12 col-xxl-6 px-2">
                                                <div class="form-group mb-md-0">
                                                    <label for="longitude"> ลองจิจูด </label>
                                                    <input type="text" class="form-control form-control-lg border-0" id="lng" name="longitude" required>
                                                </div>
                                            </div>
                                        </div>
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
                                        <div class="form-group text-center">
                                            <div class="form-group">
                                                <label>
                                                    รูปภาพหลัก</label>
                                                <div class="profile-images">
                                                    <img src="../images/up-img.png" id="uploaded_image" width="100px">
                                                </div>
                                                <input type="file" name="upload_image" id="upload_image" accept="image/*">
                                                <input type="text" id="saveimg" name="nameimg" value="" hidden>
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

                                                                // var id = $('#package').attr("id");
                                                                // $('#idpack').val(id);

                                                                var mySpan = document.getElementById('mySpan');
                                                                var myLine = document.getElementById('hdnLine');
                                                                myLine.value++;


                                                                var div = document.createElement('div');
                                                                div.id = 'div' + myLine.value;
                                                                div.innerHTML = 'ไฟล์ที่ ' + myLine.value;



                                                                var myElement2 = document.createElement('input');
                                                                myElement2.setAttribute('type', "file");
                                                                myElement2.setAttribute('name', "file[]");
                                                                myElement2.setAttribute('id', "file" + myLine.value);
                                                                myElement2.setAttribute('required', 'true');
                                                                myElement2.setAttribute('accept', 'image/*');
                                                                myElement2.setAttribute('OnChange', 'showPreview(this)');
                                                                div.appendChild(myElement2);

                                                                // accept="image/*" OnChange="showPreview(this)

                                                                var myElement4 = document.createElement('br');
                                                                myElement4.setAttribute('name', "br" + myLine.value);
                                                                myElement4.setAttribute('id', "br" + myLine.value);
                                                                mySpan.appendChild(myElement4);


                                                                var img = document.createElement('img');
                                                                img.id = 'imgAvatar' + myLine.value;
                                                                img.className = 'img-thumbnail2';
                                                                //img.setAttribute('height', '200');
                                                                //class="img-thumbnail2"

                                                                div.appendChild(img);


                                                                mySpan.appendChild(div);

                                                                var limit = parseInt($('#numimg').val());
                                                                console.log(typeof(limit));

                                                                if (myLine.value > limit) {
                                                                    Swal.fire({
                                                                        position: 'top-center',
                                                                        icon: 'warning',
                                                                        title: 'สามารถเพิ่มรูปได้สูงสุด ' + limit + ' รูปเท่านั้น',
                                                                        showConfirmButton: false,
                                                                        timer: 1000
                                                                    })


                                                                    var deleteSpan = document.getElementById('div' + myLine.value);
                                                                    mySpan.removeChild(deleteSpan);

                                                                    var deleteBr = document.getElementById("br" + myLine.value);
                                                                    mySpan.removeChild(deleteBr);

                                                                    myLine.value--;
                                                                }

                                                            }

                                                            function fncDeleteElement() {

                                                                var mySpan = document.getElementById('mySpan');
                                                                var myLine = document.getElementById('hdnLine');

                                                                var deleteSpan = document.getElementById('div' + myLine.value);
                                                                mySpan.removeChild(deleteSpan);

                                                                var deleteBr = document.getElementById("br" + myLine.value);
                                                                mySpan.removeChild(deleteBr);

                                                                myLine.value--;

                                                            }

                                                            function showPreview(ele) { //ฟังก์โชว์ภาพก่อน กด submit 

                                                                var mySpan = document.getElementById('mySpan');
                                                                var myLine = document.getElementById('hdnLine');
                                                                $('#imgAvatar').attr('src', ele.value);
                                                                if (ele.files && ele.files[0]) {

                                                                    var reader = new FileReader();

                                                                    reader.onload = function(e) {
                                                                        $('#imgAvatar'.$x).attr('src', e.target.result);
                                                                    }
                                                                    reader.readAsDataURL(ele.files[0]);
                                                                }
                                                                console.log('#imgAvatar');
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
    <div id="uploadimageModal" class="modal" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Upload & Crop Image</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12 ">
                        <div id="image_demo" class="demo"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary crop_image " id="img">Crop & Upload Image</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

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
        $(document).ready(function() {

            $image_crop = $('#image_demo').croppie({
                enableExif: true,
                viewport: {
                    width: 490,
                    height: 310,
                    type: 'square' //circle
                },
                boundary: {
                    width: 550,
                    height: 500
                }
            });

            $('#upload_image').on('change', function() {
                var reader = new FileReader();
                reader.onload = function(event) {
                    $image_crop.croppie('bind', {
                        url: event.target.result
                    }).then(function() {
                        console.log('jQuery bind complete');
                    });
                }
                reader.readAsDataURL(this.files[0]);
                $('#uploadimageModal').modal('show');
            });

            $('.crop_image').click(function(event) {
                $image_crop.croppie('result', {
                        type: 'canvas',
                        size: 'viewport'
                    })
                    .then(function(response) {

                        $.ajax({
                            url: "../backend/uploadimg.php",
                            type: "POST",
                            data: {
                                "img": response
                            },
                            success: function(data) {
                                $('#uploadimageModal').modal('hide');
                                $('#uploaded_image').attr('src', data).width(450).height(300);
                                let name = data;
                                let cutname = name.slice(15);
                                $('#saveimg').val(cutname);
                                console.log(data);
                            }
                        });
                    })
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

        $('#package').change(function() {
            var id = $(this).val();
            $('#idpack').val(id);

            $.ajax({
                type: "post",
                url: "../backend/get_package.php",
                data: {
                    id: id
                },

                success: function(data) {
                    console.log(data);
                    $('#numimg').val(data);
                }
            });

            $.ajax({
                type: "post",
                url: "../backend/get_numad.php",
                data: {
                    id: id
                },

                success: function(data) {
                    console.log(data);
                    $('#numad').val(data);
                }
            });

        });

        mapboxgl.accessToken = 'pk.eyJ1IjoicG9uZDA4MjkiLCJhIjoiY2t6YzdqdDNrMmw5MzJub2Y2M2lkbncwdSJ9.hdSf1-d_NbXj6WsPUpua-Q';
        var map = new mapboxgl.Map({
            container: 'map',
            center: [100.604274, 13.84786],
            style: 'mapbox://styles/mapbox/streets-v11',
            zoom: 10
        });
        var marker = [];

        console.log(marker)

        map.on('style.load', function() {
            map.on('click', function(e) {


                if (marker.length !== 0) {

                    for (var i = marker.length - 1; i >= 0; i--) {
                        marker[i].remove();
                    }


                } else {
                    console.log('test');

                }

                var coordinates = e.lngLat;
                new mapboxgl.Popup()

                document.getElementById("lng").value = coordinates.lng
                document.getElementById("lat").value = coordinates.lat



                var marker1 = new mapboxgl.Marker({
                    color: 'red'
                }).setLngLat(coordinates).addTo(map);

                marker.push(marker1);

            });
        });

        map.addControl(
            new MapboxGeocoder({
                accessToken: mapboxgl.accessToken,
                mapboxgl: mapboxgl

            })

        );

        map.on('idle', function() {
            map.resize()
        })

        map.addControl(new mapboxgl.NavigationControl());
        map.addControl(new mapboxgl.FullscreenControl());
    </script>
</body>

</html>