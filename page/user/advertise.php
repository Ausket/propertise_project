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
    WHERE users.u_id = $id ORDER BY a_id DESC";
$result2 = mysqli_query($con, $sql2) or die(mysqli_error($con));
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
                    <h3 style="text-transform: uppercase">ประกาศของฉัน</h3>
                </div>
            </div>

            <div class="wrapper">
                <div class="card">
                    <div class="card-header">
                        <a href="addadvertise.php" class="btn btn-warning ">เพิ่มประกาศใหม่ &nbsp; <i class="fas fa-clipboard"></i></a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ลำดับ</th>
                                    <th>รูปภาพ</th>
                                    <th>หัวข้อ</th>
                                    <th>ประเภทประกาศ</th>
                                    <th>ประเภทอสังหา</th>
                                    <th>ชื่อโครงการ</th>
                                    <th>จำนวนห้องนอน</th>
                                    <th>จำนวนห้องน้ำ</th>
                                    <th>จำนวนที่จอดรถ</th>
                                    <th>ราคา</th>
                                    <th>ขนาดพื้นที่</th>
                                    <th>สถานที่ตั้ง</th>
                                    <th>คำบรรยาย</th>
                                    <th>ผู้ลงประกาศ</th>
                                    <th>วันลงประกาศ</th>
                                    <th>Action</th>


                                </tr>
                            </thead>
                            <tbody>

                                <?php while ($row2 = mysqli_fetch_array($result2)) {
                                    $h_no = "เลขที่";
                                    $v_no = "หมู่"; ?>

                                    <tr>
                                        <td><?php echo $order++ ?></td>
                                        <td><img src="../../p_img/<?php echo $row2['img_video'] ?>" style="border-radius:50%" width="100"></td>
                                        <td><?php echo $row2['title']; ?></td>
                                        <td><?php echo $row2['type']; ?></td>
                                        <td><?php echo $row2['p_type']; ?></td>
                                        <td><?php echo $row2['project_name']; ?></td>
                                        <td><?php echo $row2['bedroom']; ?></td>
                                        <td><?php echo $row2['bathroom']; ?></td>
                                        <td><?php echo $row2['parking']; ?></td>
                                        <td><?php echo $row2['price']; ?></td>
                                        <td><?php echo $row2['space_area']; ?></td>
                                        <td><?php if ($row2['house_no'] != '') {
                                                echo $h_no . " " . $row2['house_no'];
                                            } ?> <?php if ($row2['village_no'] != '') {
                                                    echo $v_no . " " . $row2['village_no'];
                                                } ?>
                                            <?php echo $row2['lane']; ?> <?php echo $row2['road']; ?>
                                            <?php foreach ($result3 as $value) {

                                                if ($value['l_id'] == $row2['l_id']) {

                                                    echo 'ต.' . $value['dname_th'] . ' ';
                                                    echo 'อ.' . $value['aname_th'] . ' ';
                                                    echo 'จ.' . $value['name_th'] . ' ';
                                                }
                                            } ?>
                                            <?php echo $row2['postal_code']; ?>
                                        </td>
                                        <td><?php echo $row2['note']; ?></td>
                                        <td><?php echo $row2['name']; ?></td>
                                        <td><?php echo $row2['date']; ?></td>


                                        <td class="text-center">
                                            <a href="edit_advertise.php?id=<?php echo $row2['a_id']; ?>" class="btn btn-primary m-auto d-block"><i class="far fa-edit"></a></i>&nbsp;
                                            <a href="../backend/deladvertise.php?id=<?php echo $row2['a_id']; ?>" onclick="return confirm('Are you sure to delete ?')" class="btn btn-danger m-auto d-block"><i class="far fa-trash-alt"></i></a>
                                        </td>

                                    </tr>


                                <?php  } ?>


                            </tbody>

                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>

</body>

</html>