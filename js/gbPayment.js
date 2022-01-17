var token;
var secret_key = "UKrMkNMg8jY7ZovzN8MIqvpXpZgRSzDn";
var public_key = "3QpUB0bwqOczd1ynkEdefyq7rEA72QWD";
var json_request;
var url;
var customerID =
  "ltq+q70aqxiAaMYMjwhn4wBwLiMCTz2YSPfyNK5YGtaYtKXGjhcpbFTDhmEhA3F2MLSkjqp/ZAs+u4jeCdesCP8rNIr+vOoqtD/p74Pu3el5yIXFzUuucFQZm+M9AWV8/CbaiyWsI6VzVqsCZQ2hQ68b1WU=";
var backUrl =
  "https://c50b-2405-9800-b530-8e59-3c80-c4ea-faa1-2c26.ngrok.io/deena/insurance/response.php";
var resUrl =
  "https://c50b-2405-9800-b530-8e59-3c80-c4ea-faa1-2c26.ngrok.io/deena/insurance/response.php";

function setAPI(arg_url, arg_request, arg_token = null) {
  var token = arg_token;
  var json_request = arg_request;
  var url = arg_url;
}

function payQR(url, ref_no, price, id_img) {
  $.ajax({
    type: "POST",
    url: "https://api.globalprimepay.com/" + url,
    data: {
      token: customerID,
      amount: price,
      referenceNo: ref_no,
      backgroundUrl: backUrl,
    },
    success: function (res) {
      // console.log(res["qrcode"]);
      $(id_img).attr(
        "src",
        "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=" +
          res["qrcode"] +
          "&choe=UTF-8"
      );
    },
  });
}

function payBill(url, ref_no, price, customerName, detail, id_img) {
  $.ajax({
    type: "POST",
    url: "https://api.globalprimepay.com/" + url,
    data: {
      token: customerID,
      amount: price,
      referenceNo: ref_no,
      backgroundUrl: backUrl,
      customerName: customerName,
      detail: detail,
    },
    success: function (res) {
      // console.log(res);
      let textBar = res.barcode;
      textBar = textBar.replaceAll("r", "");
      textBar = textBar.replaceAll("\\", " ");
      JsBarcode(id_img, textBar);
    },
  });
}

function fullPay(
  card,
  exm,
  exy,
  securCode,
  name,
  amount,
  refNo,
  detail = null,
  cutName = null,
  cutEmail = null,
  cutAddress = null,
  cutPhone = null,
  defined1 = null
) {
  $.ajax({
    url: "https://api.globalprimepay.com/v2/tokens",
    method: "POST",
    timeout: 0,
    headers: {
      Authorization: "Basic M1FwVUIwYndxT2N6ZDF5bmtFZGVmeXE3ckVBNzJRV0Q6",
      "Content-Type": "application/json",
    },
    data: JSON.stringify({
      rememberCard: false,
      card: {
        number: card,
        expirationMonth: exm,
        expirationYear: exy,
        securityCode: securCode,
        name: name,
      },
    }),
  }).done(function (response) {
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
      responseUrl: resUrl,
      backgroundUrl: backUrl,
    };
    $.ajax({
      url: "https://api.globalprimepay.com/v2/tokens/charge",
      method: "POST",
      timeout: 0,
      headers: {
        Authorization: "Basic VUtyTWtOTWc4alk3Wm92ek44TUlxdnBYcFpnUlN6RG46",
        "Content-Type": "application/json",
      },
      data: JSON.stringify(param_request),
    }).done(function (response) {
      console.log(response);
      if(response.resultCode != "00"){
        alert('เกิดข้อผิดพลาดจาก Response API ไม่ทราบอ่านค่า gbpReferranceNo ได้');
      }else {
        $("input[name=gbpReferenceNo]").val(response.gbpReferenceNo);
        document.forms["form-payfull"].submit();
        // alert(response);
      }
      
    });
  });
}

function installPay(customerName = "ไม่ได้ระบุชื่อ", ref_no, amount, bankCode, term){
  var hash = CryptoJS.HmacSHA256(
    document.getElementsByName('amount')[0].value +
    document.getElementsByName('referenceNo')[0].value +
    document.getElementsByName('responseUrl')[0].value +
    document.getElementsByName('backgroundUrl')[0].value +
    document.getElementsByName('bankCode')[0].value +
    document.getElementsByName('term')[0].value, 'UKrMkNMg8jY7ZovzN8MIqvpXpZgRSzDn');

  document.getElementsByName('checksum')[0].value = hash;
}


