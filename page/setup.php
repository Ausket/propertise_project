<?php

// require('../base_require.php');
// require('../../../config.php');
// require('../connect.php');
require('../dbconnect.php');

$id = $_SESSION['u_id'];
if (empty($id)) {
    header('Location: ../index.php');
}


// if (isset($_POST['submit'])) {
//     $path_api = $_POST['path-api'];
//     $customer_key = $_POST['customer-key'];
//     $public_key = $_POST['public-key'];
//     $secret_key = $_POST['secret-key'];
//     echo "<script>alert('$secret_key')</script>";
// }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Setup</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <!-- <link rel="stylesheet" href="../css/all.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Theme style -->
    <link rel="stylesheet" href="../css/adminlte.min.css">
    <link rel="stylesheet" href="../css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../css/buttons.bootstrap4.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <?php
    include('admin_nav.php');
    ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div classฟ="container-fluid">
                <div class="row mb-2 ml-2">
                    <div class="col-sm-6">
                        <h1 style="text-transform: uppercase">ตั้งค่าระบบชำระเงิน</h1>
                    </div>



                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container">
                <form action="" method="POST">
                    <div class="mt-3 card">
                        <div class="mt-2 mr-2 ml-2 card-body">
                            <div class="mb-4">
                                <div class="pt-2 pl-3">
                                    <h4><b>ตั้งค่าสภาพแวดล้อมการใช้งาน API (Config API Environment)</b></h4>
                                    <div class="pt-3 pl-3">

                                        <span><i class="fas fa-exclamation-circle"></i>
                                            <b>Environment หรือ API Path</b>
                                            เป็น path ที่อยู่ของ API GB Prime Pay ที่ใช้ในการชำระเงิน โดยจะมี 2 สภาพแวดล้อมประกอบด้วย <br></span>
                                        <span class="pl-4">
                                            Production URL : https://api.gbprimepay.com/ และ
                                            Test URL : https://api.globalprimepay.com/

                                        </span>
                                        <br>

                                        <br>
                                        <span>
                                            <i class="fas fa-exclamation-circle"></i>
                                            <b>
                                                Customer Key Public Key และ Secret Key
                                            </b>
                                        </span>
                                        <br>
                                        <span class="pl-4">
                                            เป็นข้อมูลรหัสจำเพาะที่ทาง GB Prime Pay ออกให้ผู้ประกอบการที่ลงทะเบียนขอใช้ API Payment Gateway
                                        </span><br>
                                        <span class="pl-4">
                                            สามารถอ่านข้อมูล Document โดยละเอียดที่ช่องทาง<a href="https://doc.gbprimepay.com/" target="_blank"> Document GB Prime Pay</a>
                                        </span>


                                    </div>

                                </div>


                                <hr>

                            </div>


                            <div class="pl-4">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Environment (API Path)</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="path-api" name="path-api" placeholder="กรอก Secret Key ของคุณ" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Customer Key</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="customer-key" name="customer-key" placeholder="กรอก Customer Key ของคุณ" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Public Key</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="public-key" name="public-key" placeholder="3QpUB0bwqOczd1ynkEdefyq7rEA72QWD" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Secret Key</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="secret-key" name="secret-key" placeholder="UKrMkNMg8jY7ZovzN8MIqvpXpZgRSzDn" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label"></label>
                                    <div class="col-sm-8">
                                        <button type="button" id="check" class="btn btn-warning" data-toggle="modal" data-target="#save_config">
                                            ตั้งค่าระบบ
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="save_config" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="">แจ้งเตือน</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>คุณต้องการแก้ไขข้อมูลเป็น</p>
                                                        path api : <br><input class="form-control" id="check-path-api" readonly></input> <br>
                                                        customer key : <br><textarea style="height: 120px;" class="form-control" id="check-customer-key" readonly></textarea> <br>
                                                        public key : <br><input class="form-control" id="check-public-key" readonly></input> <br>
                                                        secret key : <br><input class="form-control" id="check-secret-key" readonly></input> <br>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" id="close_modal" data-dismiss="modal">ยกเลิก</button>
                                                        <input id="save" value="บันทึกการตั้งค่าระบบ" class="btn btn-dark" width="150px"></input>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.content-wrapper -->
        </section>

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
                <script src="../js/buttons.bootstrap4.min.js"></script>
                <script src="../js/jszip/jszip.min.js"></script>
                <script src="../js/pdfmake.min.js"></script>
                <script src="../js/vfs_fonts.js"></script>
                <script src="../js/buttons.html5.min.js"></script>
                <script src="../js/buttons.print.min.js"></script>
                <script src="../js/buttons.colVis.min.js"></script>


    <script>
        $(document).ready(function() {
            //API เรียกข้อมูล Environment มาแสดงในหน้าเพจ
            $.ajax({
                url: "<?= $base_api_pay ?>insurance/setupEnvironment.php",
                method: "GET",
                success: function(data) {
                    // console.log(data);
                    $('#path-api').val(data['path-api']);
                    $('#customer-key').val(data['customer-key']);
                    $('#secret-key').val(data['secret-key']);
                    $('#public-key').val(data['public-key']);
                }
            });
        });
        $("#save").click(function() {
            $.ajax({
                url: "<?= $base_api_pay ?>insurance/setupEnvironment.php",
                method: "PUT",
                data: JSON.stringify({
                    "path-api": $('#path-api').val(),
                    "customer-key": $('#customer-key').val(),
                    "secret-key": $('#secret-key').val(),
                    "public-key": $('#public-key').val()
                }),
                success: function(res) {
                    // alert(data);
                    // console.log(res);
                    $('#close_modal').click();
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'อัพเดทสถานะเรียบร้อย',
                        showConfirmButton: false,
                        timer: 1000
                    })
                }
            });
        });
        $("#check").click(function() {
            $("#check-path-api").val($("#path-api").val());
            $("#check-customer-key").val($("#customer-key").val());
            $("#check-public-key").val($("#public-key").val());
            $("#check-secret-key").val($("#secret-key").val());
        });
    </script>

</body>


</html>