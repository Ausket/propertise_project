<?php
require_once('../../dbconnect.php');

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

$id2 = $_GET["id"];

$sql2 = "SELECT advertise.a_id,advertise.title,advertise.note,advertise_type.type,advertise.atype_id,property_detail.project_name,property_detail.bedroom,property_detail.bathroom,property_detail.parking,
property_detail.price,property_detail.space_area,property_detail.img_video,location_property.house_no,property_detail.facility,
location_property.village_no,location_property.lane,location_property.road,location_property.province_id,location_property.district_id,
location_property.amphure_id,location_property.postal_code,location_property.latitude,location_property.longitude,property_type.p_type 
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

$facility_arr = array("??????????????????????????????","????????????????????????","??????????????????????????????","??????????????????","???????????????????????????????????????","????????????????????????????????????","????????????????????????????????????????????????","Wi-Fi");

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
    <link rel="stylesheet" href="../../css/adminlte.min.css">
    <link rel="stylesheet" href="../../css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../../css/buttons.bootstrap4.min.css">
    <script src="//cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
</head>

<body class="hold-transition sidebar-mini">
    
<div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">MY HOME</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dropdown
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#">Disabled</a>
                    </li>
                </ul>
                <a class="btn btn-outline-success my-2 my-sm-0" type="submit" href="../logout.php">??????????????????????????????</a>
            </div>
        </nav>
        <div class="mt-5">
            <div class="container">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link " href="profile.php">???????????????????????????????????????</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="advertise.php">????????????????????????????????????</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="favourite.php">??????????????????????????????</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="reset_pass.php">?????????????????????????????????????????????</a>
                    </li>
                </ul>
                <div class="mt-3">
                    <h3 style="text-transform: uppercase">?????????????????????????????????</h3>
                </div>
            </div>




        <!-- Main content -->
        <section class="content">
            <form action="../../backend/edit_advertise_db.php?id=<?php echo $row2['a_id']; ?>" enctype="multipart/form-data" method="POST">
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
                                        <div class="form-group">
                                            <div class="form-group col-md-4">
                                                <label>??????????????????????????????</label><br>
                                                <img src="../../image/p_img/<?php echo $row2['img_video']; ?>" width="40%"> &nbsp;&nbsp;
                                            </div>
                                            <div class="form-group col-md-3">
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
    <script src="../../js/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../js/adminlte.min.js"></script>

    <script src="../../js/jquery.dataTables.min.js"></script>
    <script src="../../js/dataTables.bootstrap4.min.js"></script>
    <script src="../../js/dataTables.responsive.min.js"></script>
    <script src="../../js/responsive.bootstrap4.min.js"></script>
    <script src="../../js/dataTables.buttons.min.js"></script>
    <script src="../../js/buttons.bootstrap4.min.js"></script>
    <script src="../../js/jszip/jszip.min.js"></script>
    <script src="../../js/pdfmake.min.js"></script>
    <script src="../../js/vfs_fonts.js"></script>
    <script src="../../js/buttons.html5.min.js"></script>
    <script src="../../js/buttons.print.min.js"></script>
    <script src="../../js/buttons.colVis.min.js"></script>

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
                url: "../../backend/get_amphure.php",
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
                url: "../../backend/get_district.php",
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