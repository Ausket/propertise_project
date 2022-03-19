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

$sqlData = "SELECT * FROM pay_status ORDER BY id DESC";
$result = mysqli_query($con, $sqlData);



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payment Status</title>

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

    <script src="https://cdn.jsdelivr.netnpmsweetalert2@11script"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                        <h1 style="text-transform: uppercase">สถานะการชำระเงิน</h1>
                        </h1>
                    </div>



                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="mr-2 ml-2 text-center">
                <table id="statusTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>ลำดับ</th>
                            <th>หมายเลขคำสั่งซื้อ</th>
                            <th>ชื่อลูกค้า</th>
                            <th>จำนวนเงิน</th>
                            <th>สถานะการชำระเงิน</th>
                            <th>ช่องทางชำระเงิน</th>
                            <th>วันและเวลาสั่งซื้อ</th>
                            <th>วันและเวลาชำระเงิน</th>
                            <th>จัดการ</th>


                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $i = 1;
                        while ($row = mysqli_fetch_array($result)) { ?>
                            <tr>
                                <td><?php echo $i++ ?></td>
                                <td><?php echo $row['referenceNo'] ?></td>
                                <td><?php echo $row['name'] ?></td>
                                <td><?php echo $row['price']; ?></td>

                                <td>
                                    <?php
                                    if (!empty($row['resultCode'])) {
                                        if ($row['resultCode'] == "00") {

                                            echo "<span class='badge rounded-pill bg-success' style='font-size: 1.1em'>จ่ายแล้ว</span>";
                                        } else {
                                            echo "<span class='badge rounded-pill bg-danger' style='font-size: 1.1em'>เกิดข้อผิดพลาด</span>";
                                        }
                                    } else {
                                        echo "<span class='badge rounded-pill bg-primary' style='font-size: 1.1em'>ค้างชำระ</span>";
                                    }
                                    ?>
                                </td>
                                <td><?php echo $row['paymentType']; ?></td>
                                <td><?php echo $row['datetime_order'] ?></td>
                                <td>

                                    <?php
                                    if (!empty($row['date'])) {
                                        echo $row['date'] . " - " . $row['time'] . "น.";
                                    } else {
                                        echo "-";
                                    }
                                    ?>

                                </td>





                                <td class="text-center">

                                    <button class="btn btn-info rounded-pill" onclick="seeDetail('<?= $row['referenceNo'] ?>')"><i class="far fa-eye"></i>
                                        <b>รายละเอียด</b>
                                    </button>
                                    &nbsp;
                                    <?php if ($row['void'] == '1') { ?>
                                        <button class="btn btn-danger rounded-pill" onclick="seeReVoid('<?= $row['referenceNo'] ?>')"><i class="fas fa-info"></i>
                                            <b>รายการถูกยกเลิก</b>
                                        </button>
                                    <?php } else { ?>
                                        <button class="btn btn-warning rounded-pill" onclick="seeVoid('<?= $row['referenceNo'] ?>')"><i class="fas fa-ban"></i>
                                            <b>ยกเลิกรายการ</b>
                                        </button>
                                    <?php } ?>
                                </td>

                            </tr>


                        <?php  } ?>


                    </tbody>
                </table>
            </div>
            <div class="modal fade" id="seeDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">รายละเอียดการชำระเงิน</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="col">
                                        <label>ชื่อลูกค้า :</label>
                                        <span id="cust-name"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col">
                                        <label>หมายเลขคำสั่งซื้อ :</label>
                                        <span id="order_id"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col">

                                        <label>สถานะการชำระเงิน :</label>
                                        <span id="pay-status"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col">
                                        <label>จำนวนเงิน :</label>
                                        <span id="price"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col">
                                        <label>รายละเอียด : </label>
                                        <span id="detail"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col">
                                        <label>วันเวลา-สั่งซื้อ :</label>
                                        <span id="date-order"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col">
                                        <label>วันเวลา-ชำระเงิน :</label>
                                        <span id="date-pay"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col">
                                        <label>ช่องทางชำระเงิน :</label>
                                        <span id="pay-method"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col">
                                        <label>ธนาคารผู้ออกบัตร :</label>
                                        <span id="issuerBank"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิดหน้าต่าง</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="modal fade" id="changeVoid" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">ยกเลิกการทำรายการ</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col">
                                <label>หมายเลขคำสั่งซื้อ :</label>
                                <span id="void_id"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <label>รายละเอียด : </label>
                                <span id="void_detail"></span>
                            </div>
                        </div>
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="exampleInputEmail1">สาเหตุการยกเลิก</label>
                                <textarea type="text" class="form-control" id="note" name="note" value="" placeholder="สาเหตุการยกเลิก" required width="500"></textarea>

                            </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="modal-footer">
                        <button type="submit" id="submit" name="submit" class="btn btn-success" onclick="return confirm('คุณต้องการยกเลิกรายการนี้จริงหรือ ?')">ตกลง</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="seeVoid" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">รายละเอียดการยกเลิก</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col">
                                <label>หมายเลขคำสั่งซื้อ :</label>
                                <span id="revoid_id"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <label>รายละเอียด : </label>
                                <span id="revoid_detail"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <label >สาเหตุการยกเลิก : </label>
                                <span id="seenote"></span>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="modal-footer">

                        <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
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
            $("#statusTable").DataTable({
                "scrollY": 600,
                "scrollX": true,
                "responsive": true,
                "autoWidth": false,
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "responsive": true
            });
        });

        function seeDetail(order_id) {
            // alert(order_id);
            $.ajax({
                url: "readDetail.php",
                method: "POST",
                data: {
                    referenceNo: order_id
                },
                success: function(res) {
                    $("#seeDetail").modal("show")
                    res = JSON.parse(res);
                    // console.log(res.name);
                    $("#cust-name").text(res.name)
                    $("#order_id").text(res.referenceNo)

                    $("#price").text(res.price)
                    $("#date-order").text(res.datetime_order)
                    $("#date-pay").text(res.date + "-" + res.time)
                    $("#pay-method").text(res.paymentType)
                    $("#detail").text(res.pack_name)
                    $("#issuerBank").text(res.issuerBank)

                    $.ajax({
                        url: "readCheck.php",
                        method: "POST",
                        data: {
                            resultCode: res.resultCode
                        },
                        success: function(resCheck) {
                            resCheck = JSON.parse(resCheck);
                            console.log(resCheck);
                            let color = "";
                            if (res.resultCode == "00") {
                                color = "bg-success";
                            } else {
                                color = "bg-danger";
                            }

                            $("#pay-status").html(resCheck.meaning_eng + " - <span class='badge rounded-pill " + color + "' style='font-size: 1.1em'>" + resCheck.meaning_th + "</span>")




                        }
                    });


                }
            });

        };

        function seeVoid(order_id) {
            $.ajax({
                url: "readDetail.php",
                method: "POST",
                data: {
                    referenceNo: order_id
                },
                success: function(res) {
                    $("#changeVoid").modal("show")
                    res = JSON.parse(res);
                    $("#void_id").text(res.referenceNo)
                    $("#void_detail").text(res.pack_name)
                }

            });

            $(document).on('click', '#submit', function() {

                var note = $('#note').val();

                console.log(note);
                console.log(order_id);

                $.ajax({
                    url: "../backend/changeVoid.php",
                    method: "POST",
                    data: {
                        note: note,
                        id: order_id
                    },
                    success: function(data) {
                        console.log(data)
                        Swal.fire({
                            position: 'top-center',
                            icon: 'success',
                            title: 'ทำการยกเลิกรายการแล้ว',
                            showConfirmButton: false,
                            timer: 1000
                        })
                        // setTimeout(function() {
                        //     window.location = window.location;
                        // }, 5000);
                    }
                });

            });

        };

        function seeReVoid(order_id) {
            $.ajax({
                url: "readDetail.php",
                method: "POST",
                data: {
                    referenceNo: order_id
                },
                success: function(res) {
                    $("#seeVoid").modal("show")
                    res = JSON.parse(res);
                    $("#revoid_id").text(res.referenceNo)
                    $("#revoid_detail").text(res.pack_name)
                    $("#seenote").text(res.void_note)
                }

            });

        };
    </script>

</body>


</html>