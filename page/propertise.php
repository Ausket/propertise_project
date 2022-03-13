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

$sql = "SELECT * FROM users WHERE u_id= $id";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);

$sqlp = "SELECT * FROM users_role  ";
$resultp = mysqli_query($con, $sqlp);


if ($_SESSION['utype'] == 'admin' || $_SESSION['utype'] == 'staff') {
    $sql2 = "SELECT property_detail.pd_id,property_detail.project_name,property_detail.bedroom,property_detail.bathroom,property_detail.parking,
property_detail.price,property_detail.space_area,property_detail.img_video,property_detail.pd_status,location_property.l_id,location_property.house_no,
location_property.village_no,location_property.lane,location_property.road,location_property.postal_code,location_property.lat,location_property.lng,property_type.p_type 
,users.name,users.tel,users.email,users.company,location_property.province_id,location_property.amphure_id,location_property.district_id
FROM (((property_detail
    LEFT  JOIN location_property ON property_detail.l_id = location_property.l_id)
    LEFT  JOIN property_type ON property_detail.ptype_id = property_type.ptype_id)
    LEFT  JOIN users ON property_detail.u_id = users.u_id)
    ORDER BY pd_id DESC ";
    $result2 = mysqli_query($con, $sql2) or die(mysqli_error($con));


    $sql3 = "SELECT location_property.l_id,location_property.province_id,location_property.amphure_id,location_property.district_id,
    provinces.name_th,amphures.aname_th,districts.dname_th
FROM (((location_property
INNER  JOIN provinces ON location_property.province_id = provinces.id)
INNER  JOIN amphures ON location_property.amphure_id = amphures.id)
INNER JOIN districts ON location_property.district_id = districts.id) 
 ";
    $result3 = mysqli_query($con, $sql3)  or die(mysqli_error($con));
} else {
    $sql2 = "SELECT property_detail.pd_id,property_detail.project_name,property_detail.bedroom,property_detail.bathroom,property_detail.parking,
property_detail.price,property_detail.space_area,property_detail.img_video,property_detail.pd_status,location_property.l_id,location_property.house_no,
location_property.village_no,location_property.lane,location_property.road,location_property.postal_code,location_property.latitude,location_property.longitude,property_type.p_type 
,users.name,users.tel,users.email,users.company,location_property.province_id,location_property.amphure_id,location_property.district_id
FROM (((property_detail
    LEFT  JOIN location_property ON property_detail.l_id = location_property.l_id)
    LEFT  JOIN property_type ON property_detail.ptype_id = property_type.ptype_id)
    LEFT  JOIN users ON property_detail.u_id = users.u_id)
    WHERE users.u_id = $id ORDER BY pd_id DESC ";
    $result2 = mysqli_query($con, $sql2) or die(mysqli_error($con));
    $sql3 = "SELECT location_property.l_id,location_property.province_id,location_property.amphure_id,location_property.district_id,
    provinces.name_th,amphures.aname_th,districts.dname_th
FROM (((location_property
INNER  JOIN provinces ON location_property.province_id = provinces.id)
INNER  JOIN amphures ON location_property.amphure_id = amphures.id)
INNER JOIN districts ON location_property.district_id = districts.id) 
 ";
    $result3 = mysqli_query($con, $sql3)  or die(mysqli_error($con));
}


$order = 1;
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
    <link rel="stylesheet" href="../css/switch_insurance.css">
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
                        <h1 style="text-transform: uppercase">ข้อมูลอสังหา</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid ">
                <div class="row">
                    <div class="col-12">

                        <!-- /.card -->

                        <div class="card">
                            <div class="card-header">
                                <a href="addpropertise.php" class="btn btn-warning ">เพิ่มอสังหา &nbsp; <i class="fas fa-user"></i></a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ลำดับ</th>
                                            <th>รูปภาพ</th>
                                            <th>ประเภทอสังหา</th>
                                            <th>ชื่อโครงการ</th>
                                            <th>สถานะ</th>
                                            <th>Action</th>


                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php while ($row2 = mysqli_fetch_array($result2)) {
                                            $h_no = "เลขที่";
                                            $v_no = "หมู่";

                                        ?>

                                            <tr>
                                                <td><?php echo $order++ ?></td>
                                                <td><img src="../image/p_img/<?php echo $row2['img_video'] ?>" style="border-radius:50%" width="100"></td>
                                                <td><?php echo $row2['p_type']; ?></td>
                                                <td><?php echo $row2['project_name']; ?></td>
                                                <td>
                                                    <?php if ($row2['pd_status'] == '1') {
                                                        $status = 'checked';
                                                    } else {
                                                        $status = '';
                                                    } ?>

                                                    <label class="switch">
                                                        <input type="checkbox" name="id" class="change" <?php echo $status ?> id="<?php echo $row2['pd_id']; ?>">
                                                        <div class="slider round"> </div>

                                                    </label>

                                                </td>

                                                <td class="text-center">
                                                    <a href="editpropertise.php?id=<?php echo $row2['pd_id']; ?>" class="btn btn-primary "><i class="far fa-edit"></a></i>&nbsp;
                                                    <a title='ไฟล์' type=button class="btn btn-info  file" name="file" value="ไฟล์" id="<?php echo $row2["pd_id"]; ?>">
                                                        <i class="fas fa-folder"></i></a>&nbsp;
                                                        <a title='วิว' type=button class="btn btn-warning view" name="view" value="วิว" id="<?php echo $row2["pd_id"]; ?>">
                                                        <i class="fas fa-eye"></i></a>&nbsp;
                                                    <a href="../backend/delpropertise.php?id=<?php echo $row2['l_id']; ?>" onclick="return confirm('Are you sure to delete ?')" class="btn btn-danger "><i class="far fa-trash-alt"></i></a>
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
                            "autoWidth": false
                            // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
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
                    $(document).on('click', '.change', function() {
                        var status_id = $(this).attr("id");
                        if (status_id != '') {
                            $.ajax({
                                url: "../backend/update_status_prodetail.php",
                                method: "POST",
                                data: {
                                    status_id: status_id
                                },
                                success: function(data) {

                                    console.log(data);
                                }
                            });
                        }
                    });
                    $(document).on('click', '.view', function() {
                        var r_id = $(this).attr("id");
                        if (r_id != '') {
                            $.ajax({
                                url: "show_pro.php",
                                method: "POST",
                                data: {
                                    r_id: r_id
                                },
                                success: function(data) {
                                    $('#Report_detail').html(data);
                                    $('#dataModal2').modal('show');
                                }
                            });
                        }
                    });
                    
                </script>
                 <script>
                    $(document).on('click', '.file', function() {
                        var p_id = $(this).attr("id");
                        if (p_id != '') {
                            $.ajax({
                                url: "showfile_pro.php",
                                method: "POST",
                                data: {
                                    p_id: p_id
                                },
                                success: function(data) {
                                    $('#File_detail1').html(data);
                                    $('#dataModal1').modal('show');
                                }
                            });
                        }
                    });
                </script>

                <div id="dataModal1" class="modal fade" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-dialog-scrollable  modal-dialog-centered" role="document">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5>ไฟล์ต่างๆ<h5>
                            </div>
                            <div class="modal-body" id="File_detail1">
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- Modal content-->
                <div id="dataModal2" class="modal fade" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable " role="document">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5>รายละเอียดอสังหา<h5>
                            </div>
                            <div class="modal-body" id="Report_detail">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>

                    </div>
                </div>

                <script src="../js/bootstrap.bundle.min.js"></script>
                <script src="../js/adminlte.min.js"></script>
</body>

</html>