<?php
require_once('../../dbconnect.php');

$id = $_SESSION['u_id'];
if (empty($id)) {
    header('Location:login.php');
}
$sql = "SELECT * FROM users WHERE u_id= $id ";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);

$sqlp = "SELECT * FROM users_role  ";
$resultp = mysqli_query($con, $sqlp);

$sqlt = "SELECT * FROM property_type  ";
$resultt = mysqli_query($con, $sqlt);

$sqla = "SELECT * FROM advertise_type  ";
$resulta = mysqli_query($con, $sqla);

$sqlpr = "SELECT * FROM provinces";
$resultpr = mysqli_query($con, $sqlpr);



?>
<!DOCTYPE html>
<html lang="en">
<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome Icons -->
<!-- <link rel="stylesheet" href="../css/all.min.css"> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- Theme style -->
<link rel="stylesheet" href="../../css/adminlte.min.css">
<script src="//cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advertise</title>
</head>

<body>
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
                    <h3 style="text-transform: uppercase">?????????????????????????????????</h3>
                </div>
            </div>
            <section class="content">
                <form action="../../backend/addadvertise_db.php" enctype="multipart/form-data" method="POST">
                    <div class="container">
                        <div class="column m-auto">
                            <!-- general form elements -->
                            <div class="column m-auto " style="width: 700px;">
                                <div class="card card-dark">
                                    <div class="card-header">
                                        <h3 class="card-title">????????????????????????????????????????????????</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->


                                    <div class="card-body">
                                        <div class="form-group">

                                            <label for="exampleInputEmail1">????????????????????????????????????</label>
                                            <select class="custom-select" name="ptype" id="ptype">
                                                <option class="text-center">???????????????????????????????????????????????????</option>
                                                <?php while ($rowt = mysqli_fetch_array($resultt)) { ?>
                                                    <?php
                                                    if ($rowt['pt_status'] == '1') {
                                                        echo " <option  value=" . $rowt['ptype_id'] . "> " . $rowt['p_type'] . " </option> ";
                                                    }
                                                    ?>
                                                <?php  } ?>
                                            </select>

                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">?????????????????????????????????</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1" name="project_name" value="" placeholder="?????????????????????????????????">
                                        </div>
                                        <div class="row ">
                                            <div class="form-group col-md-4">
                                                <label for="exampleInputPassword1">????????????????????????????????????</label>
                                                <input type="number" class="form-control" id="exampleInputPassword1" name="bedroom" value="" placeholder="????????????????????????????????????" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="exampleInputPassword1">????????????????????????????????????</label>
                                                <input type="number" class="form-control" id="exampleInputPassword1" name="bathroom" value="" placeholder="????????????????????????????????????" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="exampleInputPassword1">???????????????????????????????????????/?????????</label>
                                                <input type="number" class="form-control" id="exampleInputPassword1" name="parking" value="" placeholder="???????????????????????????????????????/?????????" required>
                                            </div>
                                        </div>
                                        <div class="form-group">

                                            <label for="exampleInputEmail1">????????????</label>
                                            <input type="type" class="form-control" id="price" name="price" value="" placeholder="????????????" required>

                                        </div>
                                        <div class="form-group">

                                            <label for="exampleInputEmail1">?????????????????????????????????</label>
                                            <input type="type" class="form-control" id="exampleInputEmail1" name="space_area" value="" placeholder="?????????????????????????????????" required>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="column m-auto " style="width: 700px;">
                                <div class="card card-dark">
                                    <div class="card-header">
                                        <h3 class="card-title">???????????????????????????????????????</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->

                                    <div class="card-body">
                                        <div class="row ">
                                            <div class="form-group col-md-6">
                                                <label for="exampleInputEmail1">??????????????????????????????</label>
                                                <input type="text" class="form-control" id="exampleInputPassword1" name="house_no" value="" placeholder="??????????????????????????????" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="exampleInputPassword1">????????????</label>
                                                <input type="text" class="form-control" id="exampleInputPassword1" name="village_no" value="" placeholder="????????????" required>
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="form-group col-md-6">
                                                <label for="exampleInputPassword1">?????????</label>
                                                <input type="text" class="form-control" id="exampleInputPassword1" name="lane" value="" placeholder="?????????">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="exampleInputPassword1">?????????</label>
                                                <input type="text" class="form-control" id="exampleInputPassword1" name="road" value="" placeholder="?????????">
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="form-group col-md-4">
                                                <label for="province">?????????????????????</label>
                                                <select name="province_id" id="province" class="form-control">
                                                    <option value="">????????????????????????????????????</option>
                                                    <?php while ($rowpr = mysqli_fetch_assoc($resultpr)) : ?>
                                                        <option value="<?= $rowpr['id'] ?>"><?= $rowpr['name_th'] ?></option>
                                                    <?php endwhile; ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="amphure">???????????????</label>
                                                <select name="amphure_id" id="amphure" class="form-control">
                                                    <option value="">??????????????????????????????</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="district">????????????</label>
                                                <select name="district_id" id="district" class="form-control">
                                                    <option value="">???????????????????????????</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">????????????????????????</label>
                                            <input type="text" class="form-control" id="postal_code" name="postal_code" value="" placeholder="????????????????????????" required>
                                        </div>

                                        <!-- /.card-body -->
                                    </div>
                                </div>

                                <div class="column m-auto " style="width: 700px;">
                                    <div class="card card-dark">
                                        <div class="card-header">
                                            <h3 class="card-title">??????????????????????????????????????????????????????</h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <!-- form start -->

                                        <div class="card-body">
                                            <div class="row">
                                                <div class="form-group col-md-12 ">
                                                    <input type="checkbox" id="pool" name="facility[]" value="??????????????????????????????">
                                                    <label class="mr-5"> ??????????????????????????????</label>
                                                    <input type="checkbox" id="library" name="facility[]" value="????????????????????????">
                                                    <label class="mr-5"> ????????????????????????</label>
                                                    <input type="checkbox" id="park" name="facility[]" value="??????????????????????????????">
                                                    <label class="mr-5"> ??????????????????????????????</label>
                                                    <input type="checkbox" id="fitnet" name="facility[]" value="??????????????????">
                                                    <label class="mr-5"> ??????????????????</label><br>
                                                    <input type="checkbox" id="store" name="facility[]" value="???????????????????????????????????????">
                                                    <label class="mr-4"> ???????????????????????????????????????</label>
                                                    <input type="checkbox" id="playground" name="facility[]" value="????????????????????????????????????">
                                                    <label class="mr-4"> ????????????????????????????????????</label>
                                                    <input type="checkbox" id="air" name="facility[]" value="????????????????????????????????????????????????">
                                                    <label class="mr-4"> ????????????????????????????????????????????????</label>
                                                    <input type="checkbox" id="wifi" name="facility[]" value="Wi-Fi">
                                                    <label class="mr-5"> Wi-Fi</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="column m-auto" style="width: 700px;">
                                    <div class="card card-dark">
                                        <div class="card-header">
                                            <h3 class="card-title">??????????????????</h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <!-- form start -->
                                        <div class="card-body">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label>
                                                        ??????????????????????????????</label>
                                                    <input type="file" name="img" id="fileToUpload">
                                                </div>
                                                <div></div>
                                            </div>
                                            <hr>
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label>?????????????????????????????????????????????</label>
                                                    <input type="text" name="ids" value="<?php echo $ids ?>" hidden>
                                                    <input hidden name="date" type="datetime" value=<?php date_default_timezone_set("Asia/Bangkok");
                                                                                                    echo date("Y-m-d\TH:i:s"); ?>>
                                                    <input name="btnCreate" type="button" class="btn  btn-warning" value="???????????????????????????" onClick="JavaScript:fncCreateElement();">
                                                    <input name="btnDelete" type="button" class="btn  btn-danger" value="??????????????????" onClick="JavaScript:fncDeleteElement();"><br><br>
                                                    <input name="hdnLine" id="hdnLine" type="hidden" value=0>

                                                    <div class="card">
                                                        <div class="card-body ">
                                                            <div id="mySpan" name="mySpan">(???????????????????????????) <br>
                                                            </div>
                                                            <script language="javascript">
                                                                function fncCreateElement() {

                                                                    var mySpan = document.getElementById('mySpan');
                                                                    var myLine = document.getElementById('hdnLine');
                                                                    myLine.value++;

                                                                    var myElement4 = document.createElement('br');
                                                                    myElement4.setAttribute('name', "br" + myLine.value);
                                                                    myElement4.setAttribute('id', "br" + myLine.value);
                                                                    mySpan.appendChild(myElement4);

                                                                    var div = document.createElement('div');
                                                                    div.id = 'div' + myLine.value;
                                                                    div.className = 'card-body bg-light';
                                                                    div.innerHTML = '????????????????????? ' + myLine.value;


                                                                    var myElement4 = document.createElement('br');
                                                                    myElement4.setAttribute('name', "br" + myLine.value);
                                                                    myElement4.setAttribute('id', "br" + myLine.value);
                                                                    div.appendChild(myElement4);

                                                                    var myElement2 = document.createElement('input');
                                                                    myElement2.setAttribute('type', "file");
                                                                    myElement2.setAttribute('name', "file[]");
                                                                    myElement2.setAttribute('id', "file" + myLine.value);
                                                                    myElement2.setAttribute('required', 'true');
                                                                    div.appendChild(myElement2);

                                                                    var myElement4 = document.createElement('br');
                                                                    myElement4.setAttribute('name', "br" + myLine.value);
                                                                    myElement4.setAttribute('id', "br" + myLine.value);
                                                                    div.appendChild(myElement4);

                                                                    mySpan.appendChild(div);


                                                                }

                                                                function fncDeleteElement() {

                                                                    var mySpan = document.getElementById('mySpan');
                                                                    var myLine = document.getElementById('hdnLine');

                                                                    var deleteSpan = document.getElementById('div' + myLine.value);
                                                                    mySpan.removeChild(deleteSpan);

                                                                    var deleteBr = document.getElementById("br" + myLine.value);
                                                                    mySpan.removeChild(deleteBr);
                                                                    // var deleteFile = document.getElementById("file" + myLine.value);
                                                                    // mySpan.removeChild(deleteFile);
                                                                    // var deleteBr = document.getElementById("br" + myLine.value);
                                                                    // mySpan.removeChild(deleteBr);


                                                                    myLine.value--;

                                                                }
                                                            </script>
                                                        </div>
                                                    </div>

                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="column m-auto" style="width: 700px;">
                                        <div class="card card-dark">
                                            <div class="card-header">
                                                <h3 class="card-title">????????????????????????????????????????????????</h3>
                                            </div>
                                            <!-- /.card-header -->
                                            <!-- form start -->

                                            <div class="card-body">
                                                <div class="form-group">

                                                    <label for="exampleInputEmail1">????????????????????????????????????</label>
                                                    <select class="custom-select" name="atype" id="atype">
                                                        <option class="text-center">???????????????????????????????????????????????????</option>
                                                        <?php while ($rowa = mysqli_fetch_array($resulta)) { ?>
                                                            <?php
                                                            if ($rowa['at_status'] == '1') {
                                                                echo " <option  value=" . $rowa['atype_id'] . "> " . $rowa['type'] . " </option> ";
                                                            }
                                                            ?>
                                                        <?php  } ?>
                                                    </select>

                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">??????????????????</label>
                                                    <input type="text" class="form-control" id="exampleInputPassword1" name="title" value="" placeholder="??????????????????" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">??????????????????</label>
                                                    <textarea type="text" class="form-control" id="exampleInputPassword1" name="describe" value="" placeholder="??????????????????" required></textarea>
                                                    <script>
                                                        CKEDITOR.replace('describe');

                                                        function CKupdate() {
                                                            for (instance in CKEDITOR.instances)
                                                                CKEDITOR.instances[instance].updateElement();
                                                        }
                                                    </script>
                                                </div>


                                                <!-- /.card-body -->
                                            </div>

                                        </div>
                                        <button type="submit" name="submit" class="btn btn-success m-auto d-block " style="width: 150px;">??????????????????</button>
                                    </div>
                </form>
            </section>
            <script src="../../js/jquery.min.js"></script>

            <script>
                /* ---------------------------------------get_amphure  -------------------------------------------------   */

                $('#province').change(function() {
                    var id = $(this).val();
                    $.ajax({
                        type: "post",
                        url: "../../backend/get_amphure.php",
                        data: {
                            province: id
                        },

                        success: function(data) {

                            $('#amphure').html(data);
                            console.log(data);

                        }
                    });

                });

                /* ---------------------------------------  -------------------------------------------------   */

                $('#amphure').change(function() {
                    var id = $(this).val();
                    $.ajax({
                        type: "post",
                        url: "../../backend/get_district.php",
                        data: {
                            amphure: id
                        },

                        success: function(data) {

                            $('#district').html(data);
                            console.log(data);

                        }
                    });

                });


                function updateTextView(_obj) {
                        var num = getNumber(_obj.val());
                        if (num == 0) {
                            _obj.val('');
                        } else {
                            _obj.val(num.toLocaleString());
                        }
                    }

                    function getNumber(_str) {
                        var arr = _str.split('');
                        var out = new Array();
                        for (var cnt = 0; cnt < arr.length; cnt++) {
                            if (isNaN(arr[cnt]) == false) {
                                out.push(arr[cnt]);
                            }
                        }
                        return Number(out.join(''));
                    }
                    $(document).ready(function() {
                        $('#price').on('keyup', function() {
                            updateTextView($(this));
                        });
                    });
            </script>
</body>

</html>