<?php
require_once('../dbconnect.php');

$id = $_SESSION['u_id'];
if (empty($id)) {
  header('Location:login.php');
}
$sql = "SELECT * FROM users WHERE u_id= $id";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);

$sqlp = "SELECT * FROM users_role  ";
$resultp = mysqli_query($con, $sqlp);

$id2 = $_POST['r_id'];
$sql2 = "SELECT advertise.a_id,advertise.title,advertise.note,advertise.atype_id,advertise_type.type,advertise.date,property_detail.project_name,property_detail.bedroom,property_detail.bathroom,property_detail.parking,
property_detail.price,property_detail.space_area,property_detail.img_video,location_property.house_no, location_property.l_id,property_detail.pd_id,advertise.ad_status,
location_property.village_no,location_property.lane,location_property.road,location_property.province_id,location_property.district_id,property_detail.facility,
location_property.amphure_id,location_property.postal_code,location_property.latitude,location_property.longitude,property_type.p_type,users.name,users.tel,users.email,users.company
FROM (((((advertise
    LEFT  JOIN advertise_type ON advertise.atype_id = advertise_type.atype_id)
    LEFT  JOIN location_property ON advertise.l_id = location_property.l_id)
    LEFT  JOIN property_detail ON advertise.pd_id = property_detail.pd_id)
    LEFT  JOIN property_type ON advertise.ptype_id = property_type.ptype_id)
    LEFT  JOIN users ON advertise.u_id = users.u_id)
    WHERE a_id = $id2 ORDER BY a_id DESC ";
$result2 = mysqli_query($con, $sql2) or die(mysqli_error($con));
$row2 = mysqli_fetch_array($result2);

$sql3 = "SELECT location_property.l_id,location_property.province_id,location_property.amphure_id,location_property.district_id,
    provinces.name_th,amphures.aname_th,districts.dname_th
FROM (((location_property
INNER  JOIN provinces ON location_property.province_id = provinces.id)
INNER  JOIN amphures ON location_property.amphure_id = amphures.id)
INNER JOIN districts ON location_property.district_id = districts.id) 
 ";
$result3 = mysqli_query($con, $sql3)  or die(mysqli_error($con));


$h_no = "เลขที่";
$v_no = "หมู่";

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Show Report</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
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
  <link rel="stylesheet" href="../css/switch_insurance.css">
  <style>
    body {
      font-family: 'Prompt', sans-serif;
      font-size: 14px;
    }
  </style>
</head>

<body>

  <div class="content">
    <div class="container my-6">
      <div class="row">
        <div class="col-md-4">
          <label>ชื่อโครงการ</label>
          <p><?php echo $row2['project_name'] ?></p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <label>จำนวนห้องนอน</label>
          <p> <?php echo $row2['bedroom'] ?></p>
        </div>
        <div class="col-md-4">
          <label>จำนวนห้องน้ำ</label>
          <p> <?php echo $row2['bathroom'] ?></p>
        </div>
        <div class="col-md-4">
          <label>จำนวนที่จอดรถ/คัน</label>
          <p> <?php echo $row2['parking'] ?></p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <label>ราคา </label>
          <p> <?php echo $row2['price'] ?> บาท</p>
        </div>
        <div class="col-md-6">
          <label>ขนาดพื้นที่ </label>
          <p> <?php echo $row2['space_area'] ?></p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <label>สถานที่ตั้ง </label>
          <p><?php if ($row2['house_no'] != '') {
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
            <?php echo $row2['postal_code']; ?></p>
        </div>
      </div>
      <div class="row">
      <div class="col-md-12">
          <label>สิ่งอำนวยความสะดวก</label>
          <div class ="row">
          <?php
           $facility=explode(",",$row2['facility']);
           foreach ($facility as $value) {
            echo "<p class='mr-5'> - $value </p>";
           }        
          ?>   
          </div>    
        </div>
      </div>
    </div>
      <div class="row">
      <div class="col-md-12">
          <label>รายละเอียด</label>
          <p><?php echo $row2['note'] ?></p>
        </div>
      </div>
    </div>
  </div>

</body>

</html>