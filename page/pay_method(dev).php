<?php

// require('../base_require.php');
require('../config.php');
// require('../connect.php');
require('../dbconnect.php');

$id = $_SESSION['u_id'];
if (empty($id)) {
    header('Location:../index.php');
}
$type = $_SESSION['utype'];
if ($type == 'member' || $type == 'agent') {
    header('Location:../index.php');
}

$url_api = $base_api."insureBank";
$url_api_status = $base_api."updataStatus";


$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://okjung.com/au/api/v1/getData',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => '{
    "table":"pay_method",
    "target":"*"

}',
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'
    ),
));

$response = curl_exec($curl);
$response = json_decode($response);
$res = $response->response;
// echo gettype($res);
curl_close($curl);




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pay Method</title>

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
            <div classฟ="container-fluid">
                <div class="row mb-2 ml-2">
                    <div class="col-sm-6">
                        <h1 style="text-transform: uppercase">ช่องทางชำระเงิน</h1>
                    </div>


                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid ">
                <div class="mb-3">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#InsertModal">
                        <i class="fas fa-plus-circle"></i>&nbsp;เพิ่มช่องทางการชำระเงิน
                    </button>
                    <!-- <a class="btn btn-success" href="insCompanyCreate.php" ><i class="fas fa-plus-circle"></i>&nbsp;เพิ่มบริษัทประกันภัย</a> -->
                </div>
                <!-- Modal -->
                <div class="modal fade" id="InsertModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">เพิ่มช่องทางการชำระเงิน</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="modal-body">
                                  

                                    <div class="form-group">
                                        <label>ชื่อวิธีการชำระเงิน</label>
                                        <input type="text" class="form-control" name="method" id="method" value="" placeholder="วิธีการชำระเงิน" required>
                                    </div>
                                   


                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" id="close_modal" data-dismiss="modal">ปิด</button>
                                    <button type="submit" name="submit-insert" class="btn btn-primary">เพิ่มข้อมูล</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="UpdateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">แก้ไขบัตรเครดิตธนาคาร</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <input type="text" name="edit-id" id="edit-id" value="" hidden>

                                   
                                    <div class="form-group">
                                        <label>ชื่อวิธีการชำระเงิน</label>
                                        <input type="text" class="form-control" name="edit-method" id="edit-method" value="" placeholder="วิธีการชำระเงิน" required>
                                    </div>
                                   
                               

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" id="close_modal" data-dismiss="modal">ปิด</button>
                                    <button type="submit" name="submit-update" class="btn btn-primary">เพิ่มข้อมูล</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <table id="methodTable" class="table table-striped">
                    <thead>
                        <tr class="text-center">
                            <th>รหัส</th>
                            <th>ช่องทาง</th>
                            <th>สถานะ</th>
                            <th>แก้ไข</th>
                            <th>ลบ</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        foreach ($res as $row) {
                        ?>
                            <tr class="text-center">
                                <td><?= $row->id; ?></td>                                
                                <td><?= $row->method; ?></td>
                                <td>


                                    <?php if ($row->status == '1') {

                                        $status = 'checked';
                                    } else {
                                        $status = '';
                                    } ?>

                                    <label class="switch">
                                        <input type="checkbox" name="id" class="change" <?= $status ?> id="<?= $row->id ?>">
                                        <span class="slider round"></span>
                                    </label>

                                </td>

                                <td class="text-end">
                                    <a class="btn btn-info rounded-pill " onclick="check_row(<?= $row->id ?>)" data-toggle="modal" data-target="#UpdateModal">
                                        <i class=" far fa-edit"></i>
                                        <b>แก้ไข</b>
                                    </a>
                                    </td>
                                <td class="text-end">
                                    <!-- &nbsp;&nbsp;&nbsp; -->
                                    <a class="btn btn-danger rounded-pill" onclick="delete_row(<?= $row->id ?>)" ">
                                            <i class=" far fa-trash-alt"></i>
                                        <b>ลบ</b>
                                    </a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>

                </table>
            </div>
            <!-- /.content-wrapper -->
        </section>

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
        $(document).ready(function() {
            $("#methodTable").DataTable({
                "scrollY": 600,
                "scrollX": true,
                "responsive": true,
                "autoWidth": false,
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true
            });

        });

        $(document).on('click', '.change', function() {
            var status_id = $(this).attr("id");
            var checked = $(this).attr("checked");
            if (status_id != '') {
                $.ajax({
                    url: "<?= $url_api_status?>",
                    method: "PUT",
                    data: JSON.stringify({
                        id: status_id,
                        table_name: 'pay_method'
                    }),
                    success: function(res) {
                        // alert(data);
                        console.log(res);
                        Swal.fire({
                            position: 'top-center',
                            icon: 'success',
                            title: 'อัพเดทสถานะเรียบร้อย',
                            showConfirmButton: false,
                            timer: 1000
                        })
                    }
                });
            }
        });

        function insert_row(method) {
            $.ajax({
                url: "https://okjung.com/au/api/v1/insertData",
                method: "POST",
                data: JSON.stringify({
                    table: "pay_method",
                    target: "method",
                    data: `'${method}'`
                }),
                success: function(data) {
                    $('#close_modal').click();
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'สร้างรายการข้อมูลสำเร็จ',
                        showConfirmButton: false,
                        timer: 1000
                    })
                    setTimeout(function() {
                        window.location = window.location;
                    }, 1000);
                }
            });
        }

        function update_row(id, method) {

            $.ajax({
                url: "https://okjung.com/au/api/v1/updateData",
                method: "PUT",
                data: JSON.stringify({
                    table:"pay_method",
                    set:`method = ${method}`,
                    id : id
                }),
                success: function(data) {
                    $('#close_modal').click();
                    // alert(data['message']);
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'อัพเดทข้อมูลสำเร็จ',
                        showConfirmButton: false,
                        timer: 1000
                    })
                    setTimeout(function() {
                        window.location = window.location;
                    }, 1000);
                }
            });
        }



        function check_row(id) {
            if (id != '') {
                $.ajax({
                    url: "https://okjung.com/au/api/v1/getData",
                    method: "POST",
                    data  :JSON.stringify({
                        table : "pay_method",
                        target : "*",
                        key : "id",
                        where : id

                    }),
                    success: function(data) {
                        console.log(id);
                        console.log(data['response']);
                        $('#edit-id').val(data['response'][0]['id']);
                        $('#edit-method').val(data['response'][0]['method']);
                        
              
                    }
                });
            }
        }



        function delete_row(id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger mr-1'
                },
                buttonsStyling: false
            })
            swalWithBootstrapButtons.fire({
                title: 'คุณต้องการจะลบข้อมูล ?',
                text: "คุณจะไม่สามารถกลับมาแก้ไขได้",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'ใช่, ฉันต้องการลบ',
                cancelButtonText: 'ไม่, ยกเลิก',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "https://okjung.com/au/api/v1/deleteData",
                        method: "DELETE",
                        data: JSON.stringify({
                            id: id,
                            table : "pay_method"
                        }),
                        success: function(res) {
                            console.log(res);
                            location.reload();
                        }
                    });
                }
            })
        }


    </script>
    <?php
    if (isset($_POST['submit-insert'])) {
        $method = $_POST['method'];
        echo "<script> insert_row('" . $method . "') </script>";
        
    }


    if (isset($_POST['submit-update'])) {

        $id = $_POST['edit-id'];
        $method = $_POST['edit-method'];
        echo "<script> update_row('" . $id . "','" . $method . "') </script>";
    }
    ?>
</body>
<footer>
</footer>

</html>