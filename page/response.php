<?php

// require('../base_require.php');
// require('../../../config.php');
// require('../connect.php');
require('../dbconnect.php');

$id = $_SESSION['u_id'];
if (empty($id)) {
    header('Location: ../index.php');
}
$type = $_SESSION['utype'];
if ($type != 'admin' || $type != 'staff') {
    header('Location:../index.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Response</title>
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
                        <h1 style="text-transform: uppercase">ตั้งค่าการตอบรับข้อมูล</h1>
                    </div>


                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <div class="container">
            <form method="POST">
                <div class="pb-5">
                    <div class="mt-3 pb-5 card">
                        <div class="mt-2 mr-2 ml-2 card-body">


                            <div class="pt-2 pl-3">
                                <h4><b>ตั้งค่าการตอบรับข้อมูล Response</b></h4>
                                <div class="pt-3 pl-3">
                                    <span><i class="fas fa-exclamation-circle"></i> <b>responseUrl, URL ที่จะเปลี่ยนเส้นทางหลังจากการทำธุรกรรมเสร็จสิ้น</b> </span><br>
                                    <span>responseUrl, URL to redirect after the transaction is completed </span><br><br>
                                    <span><i class="fas fa-exclamation-circle"></i> <b>backgroundUrl, URL สำหรับส่งข้อมูลตอบกลับจากระบบ API GBPrimePay หลังจากทำรายการเสร็จ</b> </span><br>
                                    <span>backgroundUrl, URL to send response data from the GBPrimePay back office system after the transaction is completed </span>
                                </div>

                            </div>


                            <div class="mt-3">
                                <button type="button" class="btn btn-block btn-primary btn-lg" id="check" data-toggle="modal" data-target="#save_config">บันทึกข้อมูล</button>
                            </div>



                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="save_config" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="">แจ้งเตือน</h5>
                                    </div>
                                    <div class="modal-body">
                                        <p>คุณต้องการแก้ไขข้อมูลเป็น</p>
                                        full-back : <br><input class="form-control" id="check-full-back" readonly></input> <br>
                                        full-res : <br><input class="form-control" id="check-full-res" readonly></input> <br>
                                        mobile-back : <br><input class="form-control" id="check-mobile-back" readonly></input> <br>
                                        mobile-res : <br><input class="form-control" id="check-mobile-res" readonly></input> <br>
                                        install-back: <br><input class="form-control" id="check-install-back" readonly></input> <br>
                                        install-res : <br><input class="form-control" id="check-install-res" readonly></input> <br>
                                        qrcash-back : <br><input class="form-control" id="check-qrcash-back" readonly></input> <br>
                                        qrcode-back : <br><input class="form-control" id="check-qrcode-back" readonly></input> <br>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" id="close_modal" data-dismiss="modal">ยกเลิก</button>
                                        <input id="save" value="บันทึกการตั้งค่าระบบ" class="btn btn-dark" width="150px"></input>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="pr-3 pl-3">
                            <div class="mb-4">

                                <h4 class="pl-3"><b>Full Payment</b> ชำระเงินเต็มจำนวน</h4>
                                <!-- <p>รายละเอียด</p> -->
                            </div>

                            <div class="pl-4">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">backgroundUrl</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="full-back-url" name="full-back-url" placeholder="กรอก backgroundUrl" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">responseUrl</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="full-res-url" name="full-res-url" placeholder="กรอก responseUrl" required>
                                    </div>
                                </div>

                            </div>

                            <hr class="my-4" width="95%">

                            <div class="mb-4">
                                <h4 class="pl-3"><b>Mobil Banking</b> ชำระเงินผ่านโอนเงิน</h4>
                            </div>
                            <div class="pl-4">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">backgroundUrl</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="mobile-back-url" name="mobile-back-url" placeholder="กรอก backgroundUrl" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">responseUrl</label>
                                    <div class="col-sm-7">
                                        <input class="form-control" id="mobile-res-url" name="mobile-res-url" placeholder="กรอก responseUrl" required>
                                    </div>
                                </div>
                            </div>


                            <hr class="my-4" width="95%">

                            <div class="mb-4">
                                <h4 class="pl-3"><b>Installment</b> ผ่อนชำระเงิน</h4>
                            </div>
                            <div class="pl-4">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">backgroundUrl</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="install-back-url" name="install-back-url" placeholder="กรอก backgroundUrl" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">responseUrl</label>
                                    <div class="col-sm-7">
                                        <input class="form-control" id="install-res-url" name="install-res-url" placeholder="กรอก responseUrl" required>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4" width="95%">

                            <div class="mb-3">
                                <h4 class="pl-5"><b>QR Cash</b> สแกนชำระเงินผ่านธนาคาร</h4>
                            </div>
                            <div class="pl-4">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">backgroundUrl</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="qrcash-back-url" name="qrcash-back-url" placeholder="กรอก backgroundUrl" required>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4" width="95%">

                            <div class="mb-3">
                                <h4 class="pl-5"><b>QR Credit</b> ชำระเงินผ่าน Application บัตรเครดิต VISA</h4>
                            </div>
                            <div class="pl-4">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">backgroundUrl</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="qrcode-back-url" name="qrcode-back-url" placeholder="กรอก backgroundUrl" required>
                                    </div>
                                </div>
                            </div>

                        </div>


                    </div>
                </div>

        </div>
        </form>
    </div>


    <!-- Main Footer -->
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
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
            //API เรียกข้อมูล ReponseUrl มาแสดงในหน้าเพจ
            $.ajax({
                url: "<?= $base_api_pay ?>insurance/setupResponse.php",
                method: "GET",
                success: function(data) {
                    // console.log(data);
                    $('#full-back-url').val(data['full-back-url']);
                    $('#full-res-url').val(data['full-res-url']);
                    $('#mobile-back-url').val(data['mobile-back-url']);
                    $('#mobile-res-url').val(data['mobile-res-url']);
                    $('#install-back-url').val(data['install-back-url']);
                    $('#install-res-url').val(data['install-res-url']);
                    $('#qrcash-back-url').val(data['qrcash-back-url']);
                    $('#qrcode-back-url').val(data['qrcode-back-url']);
                }
            });
        });
        $("#save").click(function() {
            $.ajax({
                url: "<?= $base_api_pay ?>insurance/setupResponse.php",
                method: "PUT",
                data: JSON.stringify({
                    "full-back-url": $('#full-back-url').val(),
                    "full-res-url": $('#full-res-url').val(),
                    "mobile-back-url": $('#mobile-back-url').val(),
                    "mobile-res-url": $('#mobile-res-url').val(),
                    "install-back-url": $('#install-back-url').val(),
                    "install-res-url": $('#install-res-url').val(),
                    "qrcash-back-url": $('#qrcash-back-url').val(),
                    "qrcode-back-url": $('#qrcode-back-url').val()
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
            $("#check-full-back").val($("#full-back-url").val());
            $("#check-full-res").val($("#full-res-url").val());
            $("#check-mobile-back").val($("#mobile-back-url").val());
            $("#check-mobile-res").val($("#mobile-res-url").val());
            $("#check-install-back").val($("#install-back-url").val());
            $("#check-install-res").val($("#install-res-url").val());
            $("#check-qrcash-back").val($("#qrcash-back-url").val());
            $("#check-qrcode-back").val($("#qrcode-back-url").val());

        });
    </script>

</body>


</html>