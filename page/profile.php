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
            <h1 style="text-transform: uppercase">ข้อมูลส่วนตัว</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="offset-sm-3 col-md-6">

            <!-- Profile Image -->
            <div class="card card-warning card-outline">
              <div class="card-body box-profile">
                <div class="text-center">

                  <?php
                  // if ($_SESSION['level'] == 'member') {  
                  ?>

                  <!-- <img class="d-block m-auto" style="border-radius:50%" id="pictureUrl" width="100" alt="img"> -->

                  <?php
                  //  }
                  ?>

                  <?php
                  // if ($_SESSION['level'] == 'admin' || $_SESSION['level'] == 'employee') {  
                  ?>
                  <img class="d-block m-auto" style="border-radius:50%" src="../image/m_img/<?php echo $row['img']; ?>" width="100" alt="img">

                  <?php
                  // }
                  ?>
                </div>

                <h3 class="profile-username text-center"><?php echo $row['name']; ?></h3>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-dark">
              <div class="card-header">
                <h3 class="card-title">เกี่ยวกับฉัน</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <strong><i class="fas fa-user"></i> ชื่อ</strong>

                <p class="text-muted">
                  <?php echo $row['name']; ?>
                </p>

                <hr>
                <strong><i class="fas fa-envelope"></i> อีเมล</strong>

                <p class="text-muted">
                  <?php echo $row['email']; ?>
                </p>

                <hr>

                <strong><i class="fas fa-phone"></i> เบอร์โทร</strong>

                <p class="text-muted">
                  <?php echo $row['tel']; ?>
                </p>
                <hr>
                <strong><i class="fas fa-address-card"></i> ที่อยู่</strong>

                <p class="text-muted">
                  <?php echo $row['address']; ?>
                </p>
                <hr>
                <strong><i class="fas fa-birthday-cake"></i> วันเกิด</strong>

                <p class="text-muted">
                  <?php echo $row['birth_date']; ?>
                </p>

                <hr>
                <strong><i class="fas fa-building"></i> บริษัท</strong>

                <p class="text-muted">
                  <?php echo $row['company']; ?>
                </p>

                <hr>
                <strong><i class="fas fa-id-card"></i> เลขบัตรประชาชน</strong>

                <p class="text-muted">
                  <?php echo $row['id_card']; ?>
                </p>

                <hr>
                <div class="col-12">
                  <a href="edit_profile.php"><button class="btn btn-warning d-block m-auto" type="submit"><i class="fas fa-user-edit"></i> แก้ไข</button></a>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
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

  
</body>

</html>