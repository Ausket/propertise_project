<?php
require_once('../../dbconnect.php');

$id = $_SESSION['u_id'];
if (empty($id)) {
    header('Location:login.php');
}
$sql = "SELECT * FROM users WHERE u_id= $id";
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
$sql2 = "SELECT advertise.a_id,advertise.title,advertise.note,advertise_type.type,property_detail.project_name,property_detail.bedroom,property_detail.bathroom,property_detail.parking,
property_detail.price,property_detail.space_area,property_detail.img_video,location_property.house_no, location_property.l_id,advertise.date,
location_property.village_no,location_property.lane,location_property.road,location_property.province_id,location_property.district_id,
location_property.amphure_id,location_property.postal_code,location_property.latitude,location_property.longitude,property_type.p_type,users.name,users.tel,users.email,users.company
FROM (((((advertise
    LEFT  JOIN advertise_type ON advertise.atype_id = advertise_type.atype_id)
    LEFT  JOIN location_property ON advertise.l_id = location_property.l_id)
    LEFT  JOIN property_detail ON advertise.pd_id = property_detail.pd_id)
    LEFT  JOIN property_type ON advertise.ptype_id = property_type.ptype_id)
    LEFT  JOIN users ON advertise.u_id = users.u_id)
    WHERE a_id =  $id2";

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


$order = 1;
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

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agent</title>
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
                    <h3 style="text-transform: uppercase">แก้ไขประกาศ</h3>
                </div>
            </div>

            <div class="wrapper">
                    <!-- /.card-header -->
                    <section class="content">
            <form action="../../backend/edit_advertise_db.php?id=<?php echo $row2['a_id']; ?>" enctype="multipart/form-data" method="POST">
                <div class="container">
                    <div class="row m-auto">
                        <!-- general form elements -->
                        <div class="column m-auto" style="width: 500px;">
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
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">จำนวนห้องนอน</label>
                                        <input type="number" class="form-control" id="exampleInputPassword1" name="bedroom" value="<?php echo $row2['bedroom']; ?>" placeholder="จำนวนห้องนอน" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">จำนวนห้องน้ำ</label>
                                        <input type="number" class="form-control" id="exampleInputPassword1" name="bathroom" value="<?php echo $row2['bathroom']; ?>" placeholder="จำนวนห้องน้ำ" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">จำนวนที่จอดรถ/คัน</label>
                                        <input type="number" class="form-control" id="exampleInputPassword1" name="parking" value="<?php echo $row2['parking']; ?>" placeholder="จำนวนที่จอดรถ/คัน" required>
                                    </div>
                                    <div class="form-group">

                                        <label for="exampleInputEmail1">ราคา</label>
                                        <input type="type" class="form-control" id="exampleInputEmail1" name="price" value="<?php echo $row2['price']; ?>" placeholder="ราคา" required>

                                    </div>
                                    <div class="form-group">

                                        <label for="exampleInputEmail1">ขนาดพื้นที่</label>
                                        <input type="type" class="form-control" id="exampleInputEmail1" name="space_area" value="<?php echo $row2['space_area']; ?>" placeholder="ขนาดพื้นที่" required>

                                    </div>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <div class="form-group col-md-4">
                                                <label>รูปภาพเดิม</label><br>
                                                <img src="../../p_img/<?php echo $row2['img_video']; ?>" width="40%"> &nbsp;&nbsp;
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
                                            <label>
                                                เลือกรูปภาพ</label>
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

                        <div class="row  m-auto " style="width: 500px;">
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
                                            <input type="text" class="form-control" id="exampleInputPassword1" name="house_no" value="<?php echo $row2['house_no']; ?>" placeholder="บ้านเลขที่" required>

                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="exampleInputPassword1">หมู่</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1" name="village_no" value="<?php echo $row2['village_no']; ?>" placeholder="หมู่" required>
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="form-group col-md-6">
                                            <label for="exampleInputPassword1">ซอย</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1" name="lane" value="<?php echo $row2['lane']; ?>" placeholder="ซอย">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="exampleInputPassword1">ถนน</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1" name="road" value="<?php echo $row2['road']; ?>" placeholder="ถนน">
                                        </div>
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
                        <div class="column  m-auto" style="width: 500px;">
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
                                        <label for="exampleInputPassword1">หัวข้อ</label>
                                        <input type="text" class="form-control" id="exampleInputPassword1" name="title" value="<?php echo $row2['title']; ?>" placeholder="หัวข้อ" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">บรรยาย</label>
                                        <textarea type="text" class="form-control" id="exampleInputPassword1" name="describe" value="" placeholder="บรรยาย" required><?php echo $row2['note']; ?></textarea>
                                    </div>


                                    <!-- /.card-body -->
                                </div>

                            </div>
                            <button type="submit" name="submit" class="btn btn-success m-auto d-block" style="width: 150px;">แก้ไขประกาศ</button>
                        </div>
            </form>
        </section>
        <!-- /.card-body -->
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>

</body>

</html>