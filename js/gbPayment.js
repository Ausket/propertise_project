// $.ajax({
//   url: "https://okjung.com/nack/api/payment/insurance/setupResponse.php",
//   method: "GET",
//   success: function (data) {
//     // console.log(data);
//     $("#full-back-url").val(data["full-back-url"]);
//     $("#full-res-url").val(data["full-res-url"]);
//     $("#mobile-back-url").val(data["mobile-back-url"]);
//     $("#mobile-res-url").val(data["mobile-res-url"]);
//     $("#install-back-url").val(data["install-back-url"]);
//     $("#install-res-url").val(data["install-res-url"]);
//     $("#qrcash-back-url").val(data["qrcash-back-url"]);
//     $("#qrcode-back-url").val(data["qrcode-back-url"]);
//   },
// });

var path_api = "";
var customerID = "";
var secret_key = "";
var public_key = "";
var token;
var json_request;
var url;
var backUrl = "";
var resUrl = "";
var payurl = "http://localhost/deena/propertise/page/";


$.ajax({
        url: payurl + "payment/setupEnvironment.php",
        method: "GET",
        success: function(data) {
            path_api = data["path-api"];
            customerID = data["customer-key"];
            public_key = data["public-key"];
            secret_key = data["secret-key"];
        },
    })
    // .then(function(response) {
    //     // alert(path_api);
    // })


function setAPI(arg_url, arg_request, arg_token = null) {
    var token = arg_token;
    var json_request = arg_request;
    var url = arg_url;
}

function payQR(url, ref_no, price, id_img) {
    $.ajax({
        url: payurl + "payment/setupEnvironment.php",
        method: "GET",
        success: function(data) {
            console.log(data);
            backUrl = data["qrcode-back-url"];
            if (backUrl != "") {
                $.ajax({
                    type: "POST",
                    url: path_api + url,
                    data: {
                        token: customerID,
                        amount: price,
                        referenceNo: ref_no,
                        backgroundUrl: backUrl,
                    },
                    success: function(res) {
                        console.log(res["qrcode"]);
                        $(id_img).attr(
                            "src",
                            "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=" +
                            res["qrcode"] +
                            "&choe=UTF-8"
                        );
                    },
                });
            }
        },
    });
}

function payBill(url, ref_no, price, customerName, detail, id_img) {
    $.ajax({
        url: payurl + "payment/setupEnvironment.php",
        method: "GET",
        success: function(data) {
            console.log(data);
            backUrl = data["qrcode-back-url"];
            if (backUrl != "") {
                $.ajax({
                    type: "POST",
                    url: path_api + url,
                    data: {
                        token: customerID,
                        amount: price,
                        referenceNo: ref_no,
                        backgroundUrl: backUrl,
                        customerName: customerName,
                        detail: detail,
                    },
                    success: function(res) {
                        // console.log(res);
                        let textBar = res.barcode;
                        textBar = textBar.replaceAll("r", "");
                        textBar = textBar.replaceAll("\\", " ");
                        JsBarcode(id_img, textBar);
                    },
                });
            }
        },
    });
}

function payCredit(
    card,
    exm,
    exy,
    securCode,
    name,
    amount,
    refNo,
    backUrlCredit,
    resUrlCredit,
    detail,
    cutName,
    cutEmail,
    cutAddress,
    cutPhone,
    defined1
) {


    $.ajax({
        url: path_api + "v2/tokens",
        type: "POST",
        contentType: "application/json",
        dataType: "json",
        data: JSON.stringify({
            rememberCard: false,
            card: {
                name: name,
                number: card,
                expirationMonth: exm,
                expirationYear: exy,
                securityCode: securCode

            },
        }),
        headers: {
            "Authorization": "Basic " + btoa(public_key + ":")
        },
        success: function(response) {
            console.log(response.card.token);
            var param_request = {
                amount: amount,
                referenceNo: refNo,
                detail: detail,
                customerName: cutName,
                customerEmail: cutEmail,
                customerAddress: cutAddress,
                customerTelephone: cutPhone,
                merchantDefined1: defined1,
                card: {
                    token: response.card.token,
                },
                otp: "Y",
                responseUrl: resUrlCredit,
                backgroundUrl: backUrlCredit,
            };
            $.ajax({
                url: path_api + "v2/tokens/charge",
                method: "POST",
                timeout: 0,
                headers: {
                    "Authorization": "Basic " + btoa(secret_key + ":"),
                    "Content-Type": "application/json",
                },
                data: JSON.stringify(param_request),
            }).done(function(response) {
                console.log(response);
                if (response.resultCode != "00") {
                    alert(
                        "เกิดข้อผิดพลาดจาก Response API ไม่ทราบอ่านค่า gbpReferranceNo ได้"
                    );
                } else {
                    $("input[name=gbpReferenceNo]").val(response.gbpReferenceNo);
                    document.forms["form-payfull"].submit();
                    // alert(response);
                }
            });
        },
        failure: function(errMsg) {
            alert(errMsg);
        }
    });
}

// function installPay(
//   customerName = "ไม่ได้ระบุชื่อ",
//   ref_no,
//   amount,
//   bankCode,
//   term
// ) {
//   var hash = CryptoJS.HmacSHA256(
//     document.getElementsByName("amount")[0].value +
//       document.getElementsByName("referenceNo")[0].value +
//       document.getElementsByName("responseUrl")[0].value +
//       document.getElementsByName("backgroundUrl")[0].value +
//       document.getElementsByName("bankCode")[0].value +
//       document.getElementsByName("term")[0].value,
//     "UKrMkNMg8jY7ZovzN8MIqvpXpZgRSzDn"
//   );

//   document.getElementsByName("checksum")[0].value = hash;
// }