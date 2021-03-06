<?php

// require('../base_require.php');
require('../config.php');
// require('../connect.php');
require_once('../dbconnect.php');

$id = $_SESSION['u_id'];
if (empty($id)) {
    header('Location:../index.php');
}
$type = $_SESSION['utype'];
if ($type == 'member' || $type == 'agent') {
    header('Location:../index.php');
}


$curl = curl_init();

curl_setopt_array($curl, array(
    // CURLOPT_URL => 'http://localhost/deena/propertise/page/payment/setupEnvironment.php',
    // CURLOPT_URL => 'https://okjung.com/au/page/payment/setupEnvironment.php',
    CURLOPT_URL => 'https://lifejung.com/page/payment/setupEnvironment.php',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);
// $response = json_encode($response);
$response = json_decode($response, true);

curl_close($curl);
// echo $response['path-api'];

$pack = "SELECT * FROM package_type";
$resultpack = mysqli_query($con, $pack);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payment</title>

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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/hmac-sha256.min.js"></script>

</head>

<body class="hold-transition sidebar-mini">
    <?php require('admin_nav.php') ?>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class???="container-fluid">
                <div class="row mb-2 ml-2">
                    <div class="col-sm-6">
                        <h1 style="text-transform: uppercase">????????????????????????</h1>
                    </div>


                </div>
            </div><!-- /.container-fluid -->
        </section>


        <!-- ???????????????????????? Modal -->
        <div id="mobile" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">???????????????????????? Mobile Banking</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <form id="mobileBankingform" action="<?= $response['path-api'] ?>v2/mobileBanking" method="POST">
                                <input type="hidden" name="customerTelephone" id="cust-phone-mobile">
                                <div class="container">
                                    <br>
                                    <div class="mr-5 ml-5">
                                        <div class="input-group input-group-sm mb-3">
                                            <label class="input-group" id="inputGroup-sizing">??????????????????????????????</label>
                                            <input class="form-control mb-1" type="text" maxlength="15" id="ref-mobile" name="referenceNo" readonly>
                                        </div>
                                        <div class="input-group input-group-sm mb-3">
                                            <label class="input-group" id="inputGroup-sizing">??????????????????????????????</label>
                                            <input class="form-control mb-1" type="number" id="price-mobile" name="amount" step="0.01" readonly>
                                        </div>

                                        <div class="input-group input-group-sm mb-3">
                                            <label class="input-group" id="inputGroup-sizing">??????????????????</label>
                                            <select class="form-control" id="bcode" name="bankCode" onchange="genChecksumMoblie()">
                                                <option selected>????????????????????????????????????????????????</option>
                                                <option value="004">K-Plus</option>
                                                <option value="014">SCB Easy (Only Open in Mobile)</option>
                                                <option value="002">BBL (Only Open in Mobile)</option>
                                                <option value="025">KMA (Krungsri)</option>
                                                <option value="006">KTB (Krungthai)</option>
                                                <!-- <option value="002">BBL (Bangkok Bank)</option>
                                                    <option value="006">KTB (Krungthai)</option> -->
                                            </select>
                                        </div>
                                        <br>
                                        <div class="input-group input-group-sm mb-3">
                                            <input class="btn btn-block btn-primary btn-lg active" onclick="submitFormMobile()" value="????????????????????????">
                                        </div>

                                    </div>
                                </div>
                                <input type="hidden" id="public-key-mobile" name="publicKey">
                                <input type="hidden" id="res-mobile" name="responseUrl">
                                <input type="hidden" id="back-mobile" name="backgroundUrl">
                                <!-- debug checksum :  -->
                                <input type="hidden" id="checksum-mobile" name="checksum" placeholder="checksum"><br />
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div id="credit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">???????????????????????? Credit Card</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <form method="POST" class="mb-3">
                                <br>
                                <div class="container">
                                    <div class="mr-5 ml-5">
                                        <div class="input-group input-group-sm mb-3">
                                            <label class="input-group" id="inputGroup-sizing">???????????????????????????</label>
                                            <input class="form-control mb-2" id="amount-credit" type="number" maxlength="250" placeholder="price" readonly><br />
                                        </div>
                                        <div class="input-group input-group-sm mb-3">
                                            <label class="input-group" id="inputGroup-sizing">??????????????????????????????</label>
                                            <input class="form-control mb-2" id="referenceNo-credit" type="text" id="order-id-credit-card" name="referenceNo" readonly><br />
                                        </div>
                                        <div class="input-group input-group-sm mb-3">
                                            <label class="input-group" id="inputGroup-sizing">??????????????????????????????????????????</label>
                                            <input class="form-control mb-2" id="name-credit" type="text" maxlength="250" placeholder="Holder Name" value="Card Test"><br />
                                        </div>
                                        <div class="input-group input-group-sm mb-3">
                                            <label class="input-group" id="inputGroup-sizing">?????????????????????????????????</label>
                                            <input class="form-control mb-2" id="number-credit" type="text" maxlength="16" placeholder="Card Number" value="4535017710535741"><br />
                                        </div>
                                        <div class="input-group input-group-sm mb-3">
                                            <label class="input-group" id="inputGroup-sizing">?????????????????????????????????????????????</label>
                                            <input class="form-control mb-2" id="expirationMonth-credit" type="text" maxlength="2" placeholder="MM" value="05"><br />
                                        </div>
                                        <div class="input-group input-group-sm mb-3">
                                            <label class="input-group" id="inputGroup-sizing">????????????????????????????????????</label>
                                            <input class="form-control mb-2" id="expirationYear-credit" type="text" maxlength="2" placeholder="YY (Last Two Digits)" value="28"><br />
                                        </div>
                                        <div class="input-group input-group-sm mb-3">
                                            <label class="input-group" id="inputGroup-sizing">???????????? CVV</label>
                                            <input class="form-control mb-2" id="securityCode-credit" type="password" maxlength="3" autocomplete="off" placeholder="CVV" value="184"><br />
                                        </div>
                                        <div class="input-group input-group-sm mb-3">
                                            <input class="btn btn-block btn-primary btn-lg active" id="charge-credit" value="????????????????????????">
                                        </div>


                                    </div>
                                </div>
                            </form>
                        </div>

                        <form name="form-payfull" action="https://api.globalprimepay.com/v2/tokens/3d_secured" method="POST">
                            <input type="hidden" id="public-key-credit" name="publicKey"><br>
                            <input type="hidden" id="gbpRef" name="gbpReferenceNo">
                            <!-- <button type="submit">Pay</button> -->
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div id="installment" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">???????????????????????????????????? Credit Installment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <form action="<?= $response['path-api'] ?>v3/installment" method="POST">

                                <div class="container">
                                    <div class="mr-5 ml-5">
                                        <div class="input-group input-group-sm mb-3">
                                            <label class="input-group" id="inputGroup-sizing">??????????????????????????????</label>
                                            <input class="form-control mb-1" type="text" maxlength="15" id="referenceNo-installment" name="referenceNo" placeholder="referenceNo" readonly>
                                        </div>
                                        <div class="input-group input-group-sm mb-3">
                                            <label class="input-group" id="inputGroup-sizing">?????????????????????????????? ?????????????????? 2 ?????????????????????</label>
                                            <input class="form-control mb-1" type="text" id="amount-installment" name="price" maxlength="13" placeholder="Amount" readonly>
                                        </div>
                                        <div class="input-group input-group-sm mb-3">
                                            <label class="input-group" id="inputGroup-sizing">??????????????????</label>
                                            <input onchange="genChecksumInst()" class="form-control mb-1" type="text" id="bankCode-installment" name="bankCode" maxlength="3" placeholder="Bank Code Ex.014, 004, 025" value="">
                                        </div>
                                        <div class="input-group input-group-sm mb-3">
                                            <label class="input-group" id="inputGroup-sizing">????????????????????????</label>
                                            <input onchange="genChecksumInst()" class="form-control " type="number" id="term-installment" name="term" maxlength="2" placeholder="The number of monthly installments Ex.2" value="">
                                        </div>
                                        <br>
                                        <div class="input-group input-group-sm mb-3">
                                            <input class="btn btn-block btn-primary btn-lg active" type="submit" value="????????????????????????">

                                        </div>
                                    </div>
                                </div>
                                <input class="mb-2" type="hidden" id="publicKey-installment" name="publicKey">
                                <input class="mb-2" type="hidden" id="responseUrl-installment" name="responseUrl">
                                <input class="mb-2" type="hidden" id="backgroundUrl-installment" name="backgroundUrl">
                                <!-- <input class="mb-2" type="text" name="detail" placeholder="Detail" value="????????????????????????????????????????????????"><br /> -->

        <!-- debug checksum -->
        <!-- <input type="hidden" id="checksum-installment" name="checksum" placeholder="checksum" value=""><br />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->

        <!-- Main content -->
        <div class="container mt-3">
            <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">??????????????????????????????????????????</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="referenceNo" maxlength="15" placeholder="???????????????????????????????????????????????????????????????????????? 15 ????????????">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">??????????????????????????????</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="cust-name" placeholder="?????????????????????????????????????????????????????????">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">?????????????????????????????????????????????????????????</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="cust-phone" maxlength="10" placeholder="??????????????????????????????????????????????????????????????????">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">????????????????????????????????????????????????</label>
                <div class="col-sm-10">
                    <select class="form-control " id="order-detail" name="order-detail">
                        <option selected>???????????????????????????????????????????????????</option>
                        <?php while ($rowpack = mysqli_fetch_assoc($resultpack)) : ?>
                            <option value="<?= $rowpack['packtype_id'] ?>"><?= $rowpack['pack_name'] ?> /???????????????????????? <?= $rowpack['period'] ?> ?????????</option>
                        <?php endwhile; ?>
                    </select>
                   
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">??????????????????????????????</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="price">
                    <label for="" class="mt-1" style="color:red"> *??????????????????????????????????????????????????????????????????????????? 2 ????????????????????? ???????????? 95.00 ???????????? 85.50</label>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10">
                    <button class="btn btn-lg btn-success" onclick="create_order()">?????????????????????????????????????????????</button>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">????????????????????????????????????????????? ( <i class="fab fa-btc"></i> )</label>
                <div class="col-sm-10">
                    <button class="btn btn-primary" onclick="getQR()">QR ????????????????????????????????????</button>
                    <button class="btn btn-primary" onclick="getBar()">Barcode ????????????????????????????????????</button>
                    <button class="btn btn-primary" id="mobile-method" data-toggle="modal" data-target="#mobile">????????????????????? Mobile Banking</button>
                    <button class="btn btn-primary" id="credit-method" data-toggle="modal" data-target="#credit">????????????????????? Credit Card</button>
                    <!-- <button class="btn btn-primary" id="installment-method" data-toggle="modal" data-target="#installment">???????????????????????????????????? Credit</button> -->
                </div>
            </div>

            <hr class="mt-5 mb-5">
            <div class="text-center">

                <div class="row">
                    <div class="col-6">
                        QR Cash (??????????????????????????????????????????????????????????????????)<br>
                        <img id="img-qr-cash" width="50%" src="https://via.placeholder.com/150" alt="qr-cash">
                    </div>
                    <div class="col-6">
                        QR Credit (???????????????????????????????????????????????? Application ??????????????????????????????)<br>
                        <img id="img-qr-credit" width="50%" src="https://via.placeholder.com/150" alt="qr-credit">
                    </div>

                </div>
                <br>
                Barcode (???????????????????????????????????????????????? ????????????????????????????????????????????????????????????)<br>
                <img id="barcode" height="80px" width="800px" src="https://via.placeholder.com/800x80.png?text=??????????????????????????????????????????+Barcode" alt="barcode">


            </div>
        </div>

    </div>



    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->

    <script src="../js/jquery.min.js"></script>
    <script src="../js/gbPayment.js"></script>
    <script src="../js/JsBarcode.all.min.js"></script>
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
        var resUrl = "";

        let orderID = $('#referenceNo');
        let random = 1000 + Math.random() * 10000;
        random = Math.ceil(random)
        const d = new Date();
        var referenceNO = `${'ad'+ d.getFullYear()}${("0" + (d.getMonth() + 1)).slice(-2)}${d.getDate()}0${random}`;
        orderID.val(referenceNO);
        
        $(document).ready(function() {
            // API ????????????????????????????????? ReponseUrl ?????????????????????????????????????????????
            // $.ajax({
            //     url: "<?= $base_api_pay ?>insurance/setupResponse.php",
            //     method: "GET",
            //     success: function(data) {
            // console.log(data);
            // $('#full-back-url').val(data['full-back-url']);
            // $('#full-res-url').val(data['full-res-url']);
            // $('#mobile-back-url').val(data['mobile-back-url']);
            // $('#mobile-res-url').val(data['mobile-res-url']);
            // $('#install-back-url').val(data['install-back-url']);
            // $('#install-res-url').val(data['install-res-url']);
            // $('#qrcash-back-url').val(data['qrcash-back-url']);
            // $('#qrcode-back-url').val(data['qrcode-back-url']);
            // }
            // });            
        });

        $('#order-detail').change(function() {
            var id = $(this).val();
            $.ajax({
                type: "post",
                url: "payment/get_price.php",
                data: {
                    pack : id
                },

                success: function(data) {
                    // console.log(data.price);
                    // console.log(data.name);
                    paymentAmount = parseInt(data);
                    let price = $('#price');
                    price.val(paymentAmount.toFixed(2));
                    // console.log(price);

                }
            });

        });

        function checkPay() {
            $.ajax({
                type: "POST",
                url: "<?= $base_api_pay ?>payment/check_status.php",
                data: {
                    referenceNo: $('#referenceNo').val()
                },
                success: function(dataCheck) {
                    console.log(dataCheck)
                    // alert($('#referenceNo').val())
                    // console.log('????????????????????????????????????????????????');
                    // console.log(dataCheck['resultCode']);
                    if (dataCheck['resultCode'] == '00') {

                        // $('#fieldset').attr('style', 'position: relative; opacity: 0; display: none;');
                        // $('#fieldset-finish').attr('style', 'opacity: 1; display: block;');
                        // $('#confirm').attr('class', 'active');
                        // $('#progress-bar').attr('style', 'width: 100%;');
                    } else {
                        // alert('?????????????????????????????????????????????????????????????????????');
                        Swal.fire({
                            icon: 'warning',
                            title: '???????????????????????????',
                            text: '?????????????????????????????????????????? ?????????????????????????????????????????????????????????????????????'
                        })
                    }
                    // console.log(dataCheck['txns'][0]['']);


                },
            });
        }
        $("#check-pay-qr").click(function() {
            checkPay()
        });
        $("#check-pay-bill").click(function() {
            checkPay()
        });

        $("#credit-method").click(function() {
            if ($("#referenceNo").val() == "" || $("#price").val() == "") {
                // $('#close-mobile-modal').click();
                alert('??????????????????????????????????????????????????????????????????????????????');

            } else {
                $("#referenceNo-credit").val($("#referenceNo").val());
                $("#amount-credit").val($("#price").val());
            }

        });

        $("#charge-credit").click(function() {

            $.ajax({
                url: "<?= $base_api_pay ?>payment/setupResponse.php",
                method: "GET",
                success: function(data) {
                    console.log(data);
                    // data['full-back-url'];
                    // data['full-res-url'];

                    $.ajax({
                        url: "<?= $base_api_pay ?>payment/setupResponse.php",
                        method: "GET",
                        success: function(dataRes) {
                            console.log(dataRes);
                            backUrl = dataRes["credit-back-url"];
                            resUrl = dataRes["credit-res-url"];
                            //?????????????????????????????????????????? Environment
                            $.ajax({
                                url: "<?= $base_api_pay ?>payment/setupEnvironment.php",
                                method: "GET",
                                success: function(dataEnvi) {
                                    if (backUrl != "") {
                                        //????????????????????? public key ?????????????????? form-payfull
                                        $("#public-key-credit").val(dataEnvi["public-key"]);
                                        payCredit(
                                            $("#number-credit").val(),
                                            $("#expirationMonth-credit").val(),
                                            $("#expirationYear-credit").val(),
                                            $("#securityCode-credit").val(),
                                            $("#name-credit").val(),
                                            $("#amount-credit").val(),
                                            $("#referenceNo-credit").val(),
                                            data['full-back-url'],
                                            data['full-res-url'],
                                            $("#order-detail").val(),
                                            $("#cust-name").val(),
                                            "cutEmail",
                                            "cutAddress",
                                            $("#cust-phone").val(),
                                            "defined1"
                                        )
                                    }
                                },
                            });
                        },
                    });
                }
            });



        });

        function genChecksumMoblie() {
            //?????????????????????????????????????????? Back and Response Url
            $.ajax({
                url: "<?= $base_api_pay ?>payment/setupResponse.php",
                method: "GET",
                success: function(dataRes) {
                    // console.log(data);
                    backUrl = dataRes["mobile-back-url"];
                    resUrl = dataRes["mobile-res-url"];
                    // ????????????????????????????????? Back and Response Url ????????? form
                    $("#res-mobile").val(resUrl);
                    $("#back-mobile").val(backUrl);

                    //?????????????????????????????????????????? Environment
                    $.ajax({
                        url: "<?= $base_api_pay ?>payment/setupEnvironment.php",
                        method: "GET",
                        success: function(dataEnvi) {
                            if (backUrl != "") {
                                $("#public-key-mobile").val(dataEnvi["public-key"]);
                                //????????????????????????????????? hash ???????????? HmacSHA256 function ?????????????????????????????????????????????????????? api
                                let mobile_hash = CryptoJS.HmacSHA256(
                                    $("#price-mobile").val() +
                                    $("#ref-mobile").val() +
                                    resUrl +
                                    backUrl +
                                    $("#bcode").val(), dataEnvi["secret-key"]
                                );
                                $("#checksum-mobile").val(mobile_hash);
                            }
                        },
                    });

                },
            });


        }



        $("#mobile-method").click(function() {
            if ($("#referenceNo").val() == "" || $("#price").val() == "") {
                // $('#close-mobile-modal').click();
                alert('??????????????????????????????????????????????????????????????????????????????');

            } else {
                $("#ref-mobile").val($("#referenceNo").val());
                $("#price-mobile").val($("#price").val());
                $("#cust-phone-mobile").val($("#cust-phone").val());
            }

        });

        function getQR() {
            if ($("#referenceNo").val() == "" || $("#price").val() == "") {
                alert('??????????????????????????????????????????????????????????????????????????????');
            } else {
                payQR(
                    '/gbp/gateway/qrcode/text',
                    $("#referenceNo").val(),
                    $("#price").val(),
                    '#img-qr-cash'
                )
                payQR(
                    '/gbp/gateway/qrcredit/text',
                    $("#referenceNo").val(),
                    $("#price").val(),
                    '#img-qr-credit'
                )
                Swal.fire({
                    position: 'top-center',
                    icon: 'success',
                    title: '??????????????? QR Cash/Code ??????????????????',
                    showConfirmButton: false,
                    timer: 1000
                })
            }

        }

        function submitFormMobile() {
            document.forms["mobileBankingform"].submit();
        }

        function getBar() {
            if ($("#cust-name").val() == "" || $("#order-detail").val() == "") {
                alert('??????????????????????????????????????????????????????????????????????????????');
            } else {
                payBill(
                    "/gbp/gateway/barcode/text",
                    $("#referenceNo").val(),
                    $("#price").val(),
                    $("#cust-name").val(),
                    $("#order-detail").val(),
                    "#barcode"
                )
                Swal.fire({
                    position: 'top-center',
                    icon: 'success',
                    title: '??????????????? Barcode ??????????????????',
                    showConfirmButton: false,
                    timer: 1000
                })
            }
        }

        function create_order() {
            let name = $("#order-detail option:selected").text();
            const myArray = name.split(" ");
            console.log(myArray[0]);
            $.ajax({
                url: "<?= $base_api_pay ?>payment/create_order.php",
                // url: "http://localhost/deena/project-api/v1/create_order.php",
                method: "POST",
                data: JSON.stringify({
                    referenceNo: $("#referenceNo").val(),
                    price: $("#price").val(),
                    name: $("#cust-name").val(),
                    pack: myArray[0],
                    id: "<?= $_SESSION['u_id'] ?>"
                }),
                success: function(data) {
                    console.log(data);
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: '???????????????????????????????????????????????????????????????',
                        showConfirmButton: false,
                        timer: 1000
                    })
                }
            });
        }
    </script>

</body>


</html>