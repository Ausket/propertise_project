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



?>
<!DOCTYPE html>
<html lang="en">
<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome Icons -->
<!-- <link rel="stylesheet" href="../css/all.min.css"> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- Theme style -->
<link rel="stylesheet" href="../../css/adminlte.min.css">
<script src="//cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>

<body>
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
                <a class="btn btn-outline-success my-2 my-sm-0" type="submit" href="../logout.php">ออกจากระบบ</a>
            </div>
        </nav>
        <div class="mt-5">
            <div class="container">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link " href="profile.php">ข้อมูลส่วนตัว</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="advertise.php">ประกาศของฉัน</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="favourite.php">รายการโปรด</a>
                    </li>
                </ul>
                <div class="mt-3">
                    <h3 style="text-transform: uppercase">เพิ่มประกาศ</h3>
                </div>
            </div>
            <section class="content">
                <form action="../../backend/addadvertise_db.php" enctype="multipart/form-data" method="POST">
                    <div class="container">
                        <div class="column m-auto">
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
                                            <input type="type" class="form-control" id="exampleInputEmail1" name="price" value="" placeholder="ราคา" required>

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
                                            <label for="exampleInputEmail1">ไปรษณีย์</label>
                                            <input type="text" class="form-control" id="postal_code" name="postal_code" value="" placeholder="ไปรษณีย์" required>
                                        </div>

                                        <!-- /.card-body -->
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
                                                    <input type="file" name="img" id="fileToUpload">
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
                                                    <textarea type="text" class="form-control" id="exampleInputPassword1" name="describe" value="" placeholder="บรรยาย" required></textarea>
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
            <script src="../../js/jquery.min.js"></script>

            <script>
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
            </script>
</body>

</html>