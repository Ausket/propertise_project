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

$id2 = $_GET["id"];

$sql2 = "SELECT advertise.a_id,advertise.title,advertise.note,advertise_type.type,advertise.atype_id,property_detail.project_name,property_detail.bedroom,property_detail.bathroom,property_detail.parking,
property_detail.price,property_detail.space_area,property_detail.img_video,location_property.house_no,property_detail.facility,
location_property.village_no,location_property.lane,location_property.road,location_property.province_id,location_property.district_id,
location_property.amphure_id,location_property.postal_code,location_property.lat,location_property.lng,property_type.p_type 
FROM ((((advertise
    LEFT  JOIN advertise_type ON advertise.atype_id = advertise_type.atype_id)
    LEFT  JOIN location_property ON advertise.l_id = location_property.l_id)
    LEFT  JOIN property_detail ON advertise.pd_id = property_detail.pd_id)
    LEFT  JOIN property_type ON advertise.ptype_id = property_type.ptype_id)
    WHERE a_id =  $id2 ";
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

$facility_arr = array("??????????????????????????????", "????????????????????????", "??????????????????????????????", "??????????????????", "???????????????????????????????????????", "????????????????????????????????????", "????????????????????????????????????????????????", "Wi-Fi");

$sqlpp = "SELECT * FROM advertise  
LEFT  JOIN pay_status ON advertise.pack_id = pay_status.id
LEFT  JOIN package_type ON pay_status.pack_name = package_type.pack_name 
WHERE a_id =  $id2 ";
$resultpp = mysqli_query($con, $sqlpp);


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
                        <h1 style="text-transform: uppercase">?????????????????????????????????</h1>
                    </div>

                </div>
            </div><!-- /.container-fluid -->
        </section>




        <!-- Main content -->
        <section class="content">
            <form action="../backend/edit_advertise_db.php?id=<?php echo $row2['a_id']; ?>" enctype="multipart/form-data" method="POST">
                <div class="container">
                    <div class="row m-auto">
                        <!-- general form elements -->
                        <div class="column m-auto" style="width: 700px;">
                            <div class="card card-dark">
                                <div class="card-header">
                                    <h3 class="card-title">????????????????????????????????????????????????</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->


                                <div class="card-body">

                                    <label for="exampleInputEmail1">???????????????????????????????????????</label>
                                    <select class="custom-select" name="packtype" id="package" required>
                                        <?php foreach ($resultpp as $value) {
                                            $period = $value['period'];
                                            $time = strtotime($value['datetime_order']);
                                            $month = '+' . $period . 'day';
                                            $stop_date = date('d-m-Y', strtotime($month, $time)); ?>

                                            <option id="pack" value="<?php echo  $value['id'] ?>" <?php if ($value['pack_id'] == $rowb['pack_id']) {
                                                                                                        echo "selected";
                                                                                                    } ?>> ????????????????????????????????? : <?php echo $value['pack_name'] ?> /????????????????????????????????? <?php echo date('d-m-Y', strtotime($value['datetime_order'])) ?> /????????????????????? <?php echo $stop_date ?> /???????????? <?php echo $value['price'] ?> </option>
                                        <?php } ?>
                                    </select>
                                    <div class="form-group">

                                        <label for="exampleInputEmail1">????????????????????????????????????</label>
                                        <select class="custom-select" name="ptype" id="ptype">
                                            <option class="text-center">???????????????????????????????????????????????????</option>
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
                                        <label for="exampleInputPassword1">?????????????????????????????????</label>
                                        <input type="text" class="form-control" id="exampleInputPassword1" name="project_name" value="<?php echo $row2['project_name']; ?>" placeholder="?????????????????????????????????">
                                    </div>
                                    <div class="row ">
                                        <div class="form-group col-md-4">
                                            <label for="exampleInputPassword1">????????????????????????????????????</label>
                                            <input type="number" class="form-control" id="exampleInputPassword1" name="bedroom" value="<?php echo $row2['bedroom']; ?>" placeholder="????????????????????????????????????" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="exampleInputPassword1">????????????????????????????????????</label>
                                            <input type="number" class="form-control" id="exampleInputPassword1" name="bathroom" value="<?php echo $row2['bathroom']; ?>" placeholder="????????????????????????????????????" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="exampleInputPassword1">???????????????????????????????????????/?????????</label>
                                            <input type="number" class="form-control" id="exampleInputPassword1" name="parking" value="<?php echo $row2['parking']; ?>" placeholder="???????????????????????????????????????/?????????" required>
                                        </div>
                                    </div>
                                    <div class="form-group">

                                        <label for="exampleInputEmail1">????????????</label>
                                        <input type="type" class="form-control" id="price" name="price" value="<?php echo $row2['price']; ?>" placeholder="????????????" required>

                                    </div>
                                    <div class="form-group">

                                        <label for="exampleInputEmail1">?????????????????????????????????</label>
                                        <input type="type" class="form-control" id="exampleInputEmail1" name="space_area" value="<?php echo $row2['space_area']; ?>" placeholder="?????????????????????????????????" required>

                                    </div>
                                    <div class="form-group">
                                        <div class="form-group text-center">

                                            <label>??????????????????????????????</label><br>
                                            <img src="../image/p_img/<?php echo $row2['img_video']; ?>" width="40%"> &nbsp;&nbsp;
                                        </div>
                                        <div class="form-group col-md-3 text-center">
                                            <script language="JavaScript">
                                                function showPreview(ele) { //???????????????????????????????????????????????? ?????? submit 
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
                                        <label>
                                            ?????????????????????????????????</label>
                                        <input type="file" name="upload_image" id="upload_image" accept="image/*">
                                        <input type="text" id="saveimg" name="nameimg" value="" hidden>

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

                        <div class="column m-auto " style="width: 700px;">
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
                                            <input type="text" class="form-control" id="exampleInputPassword1" name="house_no" value="<?php echo $row2['house_no']; ?>" placeholder="??????????????????????????????" required>

                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="exampleInputPassword1">????????????</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1" name="village_no" value="<?php echo $row2['village_no']; ?>" placeholder="????????????" required>
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="form-group col-md-6">
                                            <label for="exampleInputPassword1">?????????</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1" name="lane" value="<?php echo $row2['lane']; ?>" placeholder="?????????">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="exampleInputPassword1">?????????</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1" name="road" value="<?php echo $row2['road']; ?>" placeholder="?????????">
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="form-group col-md-4">
                                            <label for="province">?????????????????????</label>
                                            <select name="province_id" id="province" class="form-control">
                                                <option value="">????????????????????????????????????</option>
                                                <?php while ($rowpr = mysqli_fetch_assoc($resultpr)) {

                                                ?>
                                                    <option value="<?= $rowpr['id'] ?>" <?php if ($row2['province_id'] == $rowpr['id']) { ?> selected="selected" <?php } ?>><?= $rowpr['name_th'] ?></option>

                                                <?php   } ?>

                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="amphure">???????????????</label>
                                            <select name="amphure_id" id="amphure" class="form-control">
                                                <option value="">??????????????????????????????</option>
                                                <?php while ($rowpa = mysqli_fetch_assoc($resultpa)) {


                                                ?>
                                                    <option value="<?= $rowpa['id'] ?>" <?php if ($row2['amphure_id'] == $rowpa['id']) { ?> selected="selected" <?php } ?>><?= $rowpa['aname_th'] ?></option>

                                                <?php   } ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="district">????????????</label>
                                            <select name="district_id" id="district" class="form-control">
                                                <option value="">???????????????????????????</option>
                                                <?php while ($rowd = mysqli_fetch_assoc($resultd)) {


                                                ?>
                                                    <option value="<?= $rowd['id'] ?>" <?php if ($row2['district_id'] == $rowd['id']) { ?> selected="selected" <?php } ?>><?= $rowd['dname_th'] ?></option>

                                                <?php   } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">????????????????????????????????????</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="postal_code" value="<?php echo $row2['postal_code']; ?>" placeholder="????????????????????????????????????" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">??????????????????</label>
                                        <div id="map" style="height: 296px"></div>
                                        <div class="form-row mx-n2">
                                            <div class="col-md-6 col-lg-12 col-xxl-6 px-2">
                                                <div class="form-group mb-md-0">
                                                    <label for="latitude"> ????????????????????? </label>
                                                    <input type="text" class="form-control form-control-lg border-0" id="lat" name="latitude" value="<?php echo $row2['lat']; ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-12 col-xxl-6 px-2">
                                                <div class="form-group mb-md-0">
                                                    <label for="longitude"> ???????????????????????? </label>
                                                    <input type="text" class="form-control form-control-lg border-0" id="lng" name="longitude" value="<?php echo $row2['lng']; ?>" required>
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
                                        <h3 class="card-title">??????????????????????????????????????????????????????</h3>
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
                                                        <label  class='mr-5'> $value</label>";
                                                    } else {
                                                        echo " <input type='checkbox' id='' name='facility[]' value='$value' >
                                                        <label  class='mr-5'> $value</label>";
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="column  m-auto" style="width: 700px;">
                                <div class="card card-dark">
                                    <div class="card-header">
                                        <h3 class="card-title">????????????????????????????????????????????????</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->

                                    <div class="card-body">
                                        <div class="form-group">

                                            <label for="exampleInputEmail1">????????????????????????????????????</label>
                                            <select class="custom-select" name="atype" id="atype">
                                                <option class="text-center">???????????????????????????????????????????????????</option>
                                                <?php foreach ($resulta as $value) {  ?>
                                                    <?php if ($value['at_status'] == '1') { ?>
                                                        <option value="<?php echo $value['atype_id'] ?>" <?php if ($value['type'] == $row2['type']) {
                                                                                                                echo "selected";
                                                                                                            } ?>>
                                                            <?php echo $value['type']; ?></option>
                                                    <?php  } ?>
                                                <?php  } ?>
                                            </select>

                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">??????????????????</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1" name="title" value="<?php echo $row2['title']; ?>" placeholder="??????????????????" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">????????????????????????????????????????????????</label>
                                            <textarea type="text" class="form-control" id="describe" name="describe" value="" placeholder="??????????????????" required><?php echo $row2['note']; ?></textarea>
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
                                <button type="submit" name="submit" class="btn btn-success m-auto d-block" style="width: 150px;">?????????????????????????????????</button>
                            </div>
            </form>
        </section>
        <!-- /.card-body -->

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
        mapboxgl.accessToken = 'pk.eyJ1IjoicG9uZDA4MjkiLCJhIjoiY2t6YzdqdDNrMmw5MzJub2Y2M2lkbncwdSJ9.hdSf1-d_NbXj6WsPUpua-Q';

        var map = new mapboxgl.Map({
            container: 'map',
            center: [<?= $row2['lng']; ?>, <?= $row2['lat']; ?>],
            style: 'mapbox://styles/mapbox/streets-v11',
            zoom: 10

        });

        const marker2 = new mapboxgl.Marker({
                color: 'red'
            })
            .setLngLat([<?= $row2['lng']; ?>, <?= $row2['lat']; ?>])
            .addTo(map)


        var marker = [];

        map.on('style.load', function() {
            map.on('click', function(e) {
                marker2.remove();

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

        // ------------------------------------------------------------------------------------------------------

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

            $('#district').html('<option value="" selected disabled class="text-center">???????????????????????????</option>');

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