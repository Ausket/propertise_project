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
property_detail.price,property_detail.space_area,property_detail.img_video,location_property.house_no, location_property.l_id,property_detail.pd_id,advertise.date,
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
    <link rel="stylesheet" href="../../css/switch_insurance.css">
    
</head>

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
                    <h3 style="text-transform: uppercase">????????????????????????????????????</h3>
                </div>
                
            </div>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid ">
                <div class="row">
                    <div class="col-12">

                        <!-- /.card -->

                        <div class="card">
                            <div class="card-header">
                                <a href="addadvertise.php" class="btn btn-warning ">????????????????????????????????????????????? &nbsp; <i class="fas fa-clipboard"></i></a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>???????????????</th>
                                            <th>??????????????????</th>
                                            <th>??????????????????</th>
                                            <th>????????????????????????????????????</th>
                                            <th>????????????????????????????????????</th>
                                            <th>?????????????????????????????????</th>
                                            <th>Action</th>


                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php while ($row2 = mysqli_fetch_array($result2)) {
                                            $h_no = "??????????????????";
                                            $v_no = "????????????"; ?>

                                            <tr>
                                                <td><?php echo $order++ ?></td>
                                                <td><img src="../../image/p_img/<?php echo $row2['img_video'] ?>" style="border-radius:50%" width="100"></td>
                                                <td><?php echo $row2['title']; ?></td>
                                                <td><?php echo $row2['type']; ?></td>
                                                <td><?php echo $row2['p_type']; ?></td>
                                                <td><?php echo $row2['date']; ?></td>


                                                <td class="text-center">
                                                    <a href="edit_advertise.php?id=<?php echo $row2['a_id']; ?>" class="btn btn-primary "><i class="far fa-edit"></a></i>&nbsp;
                                                    <a title='????????????' type=button class="btn btn-info file" name="file" value="????????????" id="<?php echo $row2["pd_id"]; ?>">
                                                        <i class="fas fa-folder"></i></a>&nbsp;
                                                    <a title='?????????' type=button class="btn btn-warning view" name="view" value="?????????" id="<?php echo $row2["a_id"]; ?>">
                                                        <i class="fas fa-eye"></i></a>&nbsp;
                                                    <a href="../../backend/deladvertise.php?id=<?php echo $row2['a_id']; ?>" onclick="return confirm('Are you sure to delete ?')" class="btn btn-danger "><i class="far fa-trash-alt"></i></a>
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
                <script src="../../js/jquery.min.js"></script>
                <!-- Bootstrap 4 -->

                <!-- AdminLTE App -->

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
                   
                   $(document).on('click', '.file', function() {
                        var p_id = $(this).attr("id");
                        if (p_id != '') {
                            $.ajax({
                                url: "showfile.php",
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
                    $(document).on('click', '.view', function() {
                        var r_id = $(this).attr("id");
                        if (r_id != '') {
                            $.ajax({
                                url: "showreport.php",
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

                <div id="dataModal1" class="modal fade" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5>???????????????????????????<h5>
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
                                <h5>????????????????????????????????????????????????<h5>
                            </div>
                            <div class="modal-body" id="Report_detail">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>

                    </div>
                </div>

                <script src="../../js/bootstrap.bundle.min.js"></script>
                <script src="../../js/adminlte.min.js"></script>
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
                </script>


</body>

</html>