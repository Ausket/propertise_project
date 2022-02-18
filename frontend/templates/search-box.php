<?php

if (isset($_GET['submits2'])) { //เมื่อกด ค้นหา 
    //กำหนดตัวแปรเก็บค่าต่างๆ 
    $project = $_GET['project'];
    $province = $_GET['province'];
    $ptype = $_GET['ptype'];
    $adtype = $_GET['adtype'];
    $bedroom = $_GET['bedroom'];
    $bathroom = $_GET['bathroom'];
    $price = $_GET['price'];
    $space = $_GET['space_area'];

    // <--------- price ------>
    $min = strchr($price, "ถึง", true);
    $max = strrchr($price, "ถึง");
    $remax = substr($max, 1);
    $remin = substr($min, 1);
    $maxx = substr($remax, 2);
    $minn = substr($remin, 2);

    // <--------- space ------>
    $areamin = strchr($space, " ตร.วา ถึง", true);
    $aremax = strchr($space, "ถึง", false);
    $aremax2 = substr($aremax, -22);
    $aremax22 = substr($aremax2, 4);
    $areamax = strchr($aremax22, " ตร.วา", true);

    // echo "+".$areamin."+";
    // echo $aremax;
    // echo $aremax2;
    // echo $aremax22;
    // echo "+".$areamax."+";

    if (isset($_POST['facility'])) {
        $facility = implode(",", $_POST["facility"]);
    }
    // $conditions = array(); //กำหนด array เก็บเงื่อนไข

    if (!empty($price)) {
        $conditions[] = "property_detail.price BETWEEN '$minn' AND '$maxx' ";
    }
    if (!empty($project)) {
        $conditions[] = "property_detail.project_name LIKE'%$project%'";
    }
    if (!empty($province)) {
        $conditions[] = "location_property.province_id='$province'";
    }
    if (!empty($adtype)) {
        $conditions[] = "advertise.atype_id='$adtype'";
    }
    if (!empty($ptype)) {
        $conditions[] = "property_detail.ptype_id='$ptype'";
    }
    if (!empty($bedroom)) {
        $conditions[] = "property_detail.bedroom='$bedroom'";
    }
    if (!empty($bathroom)) {
        $conditions[] = "property_detail.bathroom='$bathroom'";
    }
    if (!empty($facility)) {
        $conditions[] = "property_detail.facility LIKE '%$facility%'";
    }
    if (!empty($space)) {
        $conditions[] = "property_detail.space_area BETWEEN '$areamin' AND '$areamax'";
    }

    $sqlsb = "SELECT advertise.a_id,advertise.title,advertise.note,advertise_type.type,advertise_type.color,property_detail.project_name,property_detail.bedroom,property_detail.bathroom,property_detail.parking,
  property_detail.price,property_detail.space_area,property_detail.img_video,location_property.house_no, location_property.l_id,property_detail.pd_id,advertise.date,
  location_property.village_no,location_property.lane,location_property.road,location_property.province_id,location_property.district_id,advertise.ad_status,
  location_property.amphure_id,location_property.postal_code,location_property.lat,location_property.lng,property_type.p_type,property_detail.price,property_detail.facility
  FROM ((((advertise
  LEFT JOIN advertise_type ON advertise.atype_id = advertise_type.atype_id)
  LEFT JOIN location_property ON advertise.l_id = location_property.l_id)
  LEFT JOIN property_detail ON advertise.pd_id = property_detail.pd_id)
  LEFT JOIN property_type ON advertise.ptype_id = property_type.ptype_id)
  WHERE advertise.ad_status = '1' ";

    $choice = 1;
    if (count($conditions) > 0) { //ถ้า $conditions มีคามากกว่า 1
        $sqlsb .= " AND " . implode(' AND ', $conditions); //ประกอบ  sql กับ where เข้า ด้วยกัน 
    }
    if (isset($_POST['ch'])) {
        $choice = $_POST['ch'];
        if ($choice == 1) {
            $text = 'ORDER BY advertise.a_id DESC';
        }
        if ($choice == 2) {
            $text = 'ORDER BY property_detail.price DESC';
        }
        if ($choice == 3) {
            $text = 'ORDER BY property_detail.price ASC';
        }
        if ($choice == 4) {
            $text = ' ';
        }

        $sqls = "$sqlsb" . $text;
        $resultsb = mysqli_query($con, $sqls) or die(mysqli_error($con));
        $numrow = mysqli_num_rows($resultsb);
    } else {

        $sqls = "$sqlsb" . 'ORDER BY advertise.a_id DESC ';
        $resultsb = mysqli_query($con, $sqls) or die(mysqli_error($con));
        $numrow = mysqli_num_rows($resultsb);
    }
} else {

    $sqlsb = "SELECT advertise.a_id,advertise.title,advertise.note,advertise_type.type,advertise_type.color,property_detail.project_name,property_detail.bedroom,property_detail.bathroom,property_detail.parking,
  property_detail.price,property_detail.space_area,property_detail.img_video,location_property.house_no, location_property.l_id,property_detail.pd_id,advertise.date,
  location_property.village_no,location_property.lane,location_property.road,location_property.province_id,location_property.district_id,advertise.ad_status,
  location_property.amphure_id,location_property.postal_code,location_property.lat,location_property.lng,property_type.p_type,property_detail.price
  FROM ((((advertise
  LEFT JOIN advertise_type ON advertise.atype_id = advertise_type.atype_id)
  LEFT JOIN location_property ON advertise.l_id = location_property.l_id)
  LEFT JOIN property_detail ON advertise.pd_id = property_detail.pd_id)
  LEFT JOIN property_type ON advertise.ptype_id = property_type.ptype_id)
  WHERE advertise.ad_status = '1' ";

    $choice = 1;
    if (isset($_POST['ch'])) {
        $choice = $_POST['ch'];
        if ($choice == 1) {
            $text = 'ORDER BY advertise.a_id DESC';
        }
        if ($choice == 2) {
            $text = 'ORDER BY property_detail.price DESC';
        }
        if ($choice == 3) {
            $text = 'ORDER BY property_detail.price ASC';
        }
        if ($choice == 4) {
            $text = ' ';
        }

        $sqls = "$sqlsb" . $text;
        $resultsb = mysqli_query($con, $sqls) or die(mysqli_error($con));
        $numrow = mysqli_num_rows($resultsb);
    } else {

        $sqls = "$sqlsb" . 'ORDER BY advertise.a_id DESC ';
        $resultsb = mysqli_query($con, $sqls) or die(mysqli_error($con));
        $numrow = mysqli_num_rows($resultsb);
    }
}



$sql32 = "SELECT location_property.l_id,location_property.province_id,location_property.amphure_id,location_property.district_id,
  provinces.name_th,amphures.aname_th,districts.dname_th
  FROM (((location_property
  INNER JOIN provinces ON location_property.province_id = provinces.id)
  INNER JOIN amphures ON location_property.amphure_id = amphures.id)
  INNER JOIN districts ON location_property.district_id = districts.id)
  ";
$result32 = mysqli_query($con, $sql32) or die(mysqli_error($con));

$sql4 = "SELECT * FROM advertise WHERE ad_status = '1' ";
$result4 = mysqli_query($con, $sql4);
$total = mysqli_num_rows($result4);

$sql5 = "SELECT * FROM favourite ";
$result5 = mysqli_query($con, $sql5);


$sqlpr = "SELECT * FROM provinces";
$resultpr = mysqli_query($con, $sqlpr);

$sqlt = "SELECT * FROM property_type  ";
$resultt = mysqli_query($con, $sqlt);

$sqlat = "SELECT * FROM advertise_type  ";
$resultat = mysqli_query($con, $sqlat);


$sqlpr2 = "SELECT * FROM provinces";
$resultpr2 = mysqli_query($con, $sqlpr2);

$sqlt2 = "SELECT * FROM property_type  ";
$resultt2 = mysqli_query($con, $sqlt2);

$sqlat2 = "SELECT * FROM advertise_type  ";
$resultat2 = mysqli_query($con, $sqlat2);
?>
<section class="bg-secondary">
    <div class="container">
        <form class="property-search d-none d-lg-block" action="frontend/listing-home.php" method="GET">
            <div class="row align-items-lg-center" id="accordion-2">
                <div class="col-xl-8 col-lg-7 d-md-flex">
                    <select class="form-control shadow-none form-control-lg selectpicker rounded-right-md-0 rounded-md-top-left-0 rounded-lg-top-left flex-md-1 mt-3 mt-md-0" title="จังหวัด" data-style="btn-lg py-2 h-52 border-right bg-white" id="type-1" name="province">
                        <?php while ($rowpr = mysqli_fetch_assoc($resultpr)) : ?>
                            <option value="<?= $rowpr['id'] ?>"><?= $rowpr['name_th'] ?></option>
                        <?php endwhile; ?>
                    </select>
                    <select class="form-control shadow-none form-control-lg selectpicker rounded-right-md-0 rounded-md-top-left-0 rounded-lg-top-left flex-md-1 mt-3 mt-md-0" title="ประเภทอสังหา" data-style="btn-lg py-2 h-52 border-right bg-white" id="type-1" name="ptype">
                        <?php while ($rowt = mysqli_fetch_array($resultt)) { ?>
                            <?php
                            if ($rowt['pt_status'] == '1') {
                                echo " <option  value=" . $rowt['ptype_id'] . "> " . $rowt['p_type'] . " </option> ";
                            }
                            ?>
                        <?php  } ?>
                    </select>
                    <select class="form-control shadow-none form-control-lg selectpicker rounded-right-md-0 rounded-md-top-left-0 rounded-lg-top-left flex-md-1 mt-3 mt-md-0" id="type-1" title="ประเภทประกาศ" data-style="btn-lg py-2 h-52 bg-white" name="adtype">
                        <?php while ($rowat = mysqli_fetch_array($resultat)) { ?>
                            <?php
                            if ($rowat['at_status'] == '1') {
                                echo " <option  value=" . $rowat['atype_id'] . "> " . $rowat['type'] . " </option> ";
                            }
                            ?>
                        <?php  } ?>
                    </select>
                    <div class="form-group mb-0 position-relative flex-md-3 mt-3 mt-md-0">
                        <input type="text" class="form-control form-control-lg border-0 shadow-none rounded-left-md-0 pr-8 bg-white placeholder-muted" id="keyword" name="project" placeholder="ใส่ชื่อหมู่บ้าน หรือโครงการ...">
                        <button type="submit" name="submits2" class="btn position-absolute pos-fixed-right-center p-0 text-heading fs-20 mr-4 shadow-none">
                            <i class="far fa-search"></i>
                        </button>
                    </div>
                </div>
                <div class="col-lg-2">
                    <a href="#advanced-search-filters-2" class="icon-primary btn advanced-search w-100 shadow-none text-white text-left rounded-0 fs-14 font-weight-800 position-relative collapsed px-0 d-flex align-items-center" data-toggle="collapse" data-target="#advanced-search-filters-2" aria-expanded="true" aria-controls="advanced-search-filters-2">
                        ค้นหาขั้นสูง
                    </a>
                </div>
                <div class="col-lg-2">
                    <button type="submit" name="submits2" class="btn btn-primary border-0 shadow-xs-1 fs-14 text-white font-weight-500" data-toggle="collapse" data-target="#advanced-search-filters-5" aria-expanded="true" aria-controls="advanced-search-filters-5">
                        <span> ค้นหา </span>
                    </button>
                </div>
                <div id="advanced-search-filters-2" class="col-12 pb-6 pt-lg-2 collapse" data-parent="#accordion-2">
                    <div class="row mx-n2">
                        <div class="col-sm-6 col-md-4 pt-4 px-2">
                            <select class="form-control border-0 shadow-none form-control-lg selectpicker bg-white" name="bedroom" title="ห้องนอน" data-style="btn-lg py-2 h-52 bg-white">
                                <option>ห้องนอน</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                        </div>
                        <div class="col-sm-6 col-md-4 pt-4 px-2">
                            <select class="form-control border-0 shadow-none form-control-lg selectpicker bg-white" name="bathroom" title="ห้องน้ำ" data-style="btn-lg py-2 h-52 bg-white">
                                <option>ห้องน้ำ</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                        </div>
                        <div class="col-sm-6 col-md-4 pt-4 px-2">
                            <select class="form-control border-0 shadow-none form-control-lg selectpicker bg-white" name="parking" title="ที่จอดรถ" data-style="btn-lg py-2 h-52 bg-white">
                                <option>ที่จอดรถ</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-5 pt-6 slider-range slider-range-primary">
                            <label for="price-2" class="mb-4 text-white">ราคา</label>
                            <div data-slider="true" data-slider-options='{"min":0,"max":50000000,"values":[0,8000000],"type":"currency"}'></div>
                            <div class="text-center mt-2">
                                <input id="price-2" type="text" readonly class="border-0 amount text-center text-white bg-transparent font-weight-500" name="price">
                            </div>
                        </div>
                        <div class="col-md-6 pt-6 slider-range slider-range-primary">
                            <label for="area-size-2-mobile" class="mb-4 text-white">ขนาดพื้นที่</label>
                            <div data-slider="true" data-slider-options='{"min":0,"max":1000,"values":[0,500],"type":"sqrwa"}'></div>
                            <div class="text-center mt-2">
                                <input id="area-size-2-mobile" type="text" readonly class="border-0 amount text-center text-white bg-transparent font-weight-500" name="space_area">
                            </div>
                        </div>
                        <div class="col-12 pt-4 pb-2">
                            <a class="lh-17 d-inline-block other-feature collapsed" data-toggle="collapse" href="#other-feature-2" role="button" aria-expanded="false" aria-controls="other-feature-2">
                                <span class="fs-15 text-white font-weight-500 hover-primary">สิ่งอำนวยความสะดวก</span>
                            </a>
                        </div>
                        <div class="collapse row mx-0 w-100" id="other-feature-2">
                            <div class="col-sm-6 col-md-4 col-lg-3 py-2">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="check1-2" name="facility[]" value="สระว่ายน้ำ">
                                    <label class="custom-control-label text-white" for="check1-2"> สระว่ายน้ำ </label>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 py-2">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="check2-2" name="facility[]" value="ห้องสมุด">
                                    <label class="custom-control-label text-white" for="check2-2"> ห้องสมุด </label>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 py-2">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="check4-2" name="facility[]" value="สวนสาธารณะ">
                                    <label class="custom-control-label text-white" for="check4-2"> สวนสาธารณะ </label>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 py-2">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="check5-2" name="facility[]" value="ฟิตเนส">
                                    <label class="custom-control-label text-white" for="check5-2"> ฟิตเนส </label>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 py-2">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="check6-2" name="facility[]" value="ร้านสะดวกซื้อ">
                                    <label class="custom-control-label text-white" for="check6-2"> ร้านสะดวกซื้อ </label>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 py-2">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="check7-2" name="facility[]" value="สนามเด็กเล่น">
                                    <label class="custom-control-label text-white" for="check7-2"> สนามเด็กเล่น </label>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 py-2">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="check8-2" name="facility[]" value="เครื่องปรับอากาศ">
                                    <label class="custom-control-label text-white" for="check8-2"> เครื่องปรับอากาศ </label>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 py-2">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="check9-2" name="facility[]" value="Wi-Fi">
                                    <label class="custom-control-label text-white" for="check9-2"> Wi-Fi</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <form class="property-search property-search-mobile d-lg-none py-6" action="frontend/listing-home.php" method="GET">
            <div class="row align-items-lg-center" id="accordion-2-mobile">
                <div class="col-12">
                    <div class="form-group mb-0 position-relative">
                        <a href="#advanced-search-filters-2-mobile" class="icon-primary btn advanced-search shadow-none pr-3 pl-0 d-flex align-items-center position-absolute pos-fixed-left-center py-0 h-100 border-right collapsed" data-toggle="collapse" data-target="#advanced-search-filters-2-mobile" aria-expanded="true" aria-controls="advanced-search-filters-2-mobile">
                        </a>
                        <input type="text" class="form-control form-control-lg border-0 shadow-none pr-9 pl-11 bg-white placeholder-muted" name="project" placeholder="ใส่ชื่อหมู่บ้าน หรือโครงการ...">
                        <button type="submit" name="submits2" class="btn position-absolute pos-fixed-right-center p-0 text-heading fs-20 px-3 shadow-none h-100 border-left bg-white">
                            <i class="far fa-search"></i>
                        </button>
                    </div>
                </div>
                <div id="advanced-search-filters-2-mobile" class="col-12 pt-2 collapse" data-parent="#accordion-2-mobile">
                    <div class="row mx-n2">
                        <div class="col-sm-6 pt-4 px-2">
                            <select class="form-control border-0 shadow-none form-control-lg selectpicker bg-white" title="ประเภทประกาศ" data-style="btn-lg py-2 h-52 bg-white" name="adtype">
                                <?php while ($rowat2 = mysqli_fetch_array($resultat2)) { ?>
                                    <?php
                                    if ($rowat2['at_status'] == '1') {
                                        echo " <option  value=" . $rowat2['atype_id'] . "> " . $rowat2['type'] . " </option> ";
                                    }
                                    ?>
                                <?php  } ?>
                            </select>
                        </div>
                        <div class="col-sm-6 pt-4 px-2">
                            <select class="form-control border-0 shadow-none form-control-lg selectpicker bg-white" title="จังหวัด" data-style="btn-lg py-2 h-52 border-right bg-white" name="province">
                                <?php while ($rowpr2 = mysqli_fetch_assoc($resultpr2)) : ?>
                                    <option value="<?php $rowpr2['id'] ?>"><?php echo $rowpr2['name_th'] ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="col-sm-6 pt-4 px-2">
                            <select class="form-control border-0 shadow-none form-control-lg selectpicker bg-white" title="ประเภทอสังหา" data-style="btn-lg py-2 h-52 border-right bg-white" name="ptype">
                                <?php while ($rowt2 = mysqli_fetch_array($resultt2)) { ?>
                                    <?php
                                    if ($rowt2['pt_status'] == '1') {
                                        echo " <option  value=" . $rowt2['ptype_id'] . "> " . $rowt2['p_type'] . " </option> ";
                                    }
                                    ?>
                                <?php  } ?>
                            </select>
                        </div>
                        <div class="col-sm-6 pt-4 px-2">
                            <select class="form-control border-0 shadow-none form-control-lg selectpicker bg-white" name="bedroom" title="ห้องนอน" data-style="btn-lg py-2 h-52 bg-white">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                        </div>
                        <div class="col-sm-6 pt-4 px-2">
                            <select class="form-control border-0 shadow-none form-control-lg selectpicker bg-white" name="bathroom" title="ห้องน้ำ" data-style="btn-lg py-2 h-52 bg-white">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                        </div>
                        <div class="col-sm-6 pt-4 px-2">
                            <select class="form-control border-0 shadow-none form-control-lg selectpicker bg-white" name="parking" title="ที่จอดรถ" data-style="btn-lg py-2 h-52 bg-white">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-5 pt-6 slider-range slider-range-primary">
                            <label for="price-2" class="mb-4 text-white">ราคา</label>
                            <div data-slider="true" data-slider-options='{"min":0,"max":50000000,"values":[0,8000000],"type":"currency"}'></div>
                            <div class="text-center mt-2">
                                <input id="price-2" type="text" readonly class="border-0 amount text-center text-white bg-transparent font-weight-500" name="price">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-5 pt-6 slider-range slider-range-primary offset-lg-1">
                            <label for="area-size-2" class="mb-4 text-white">ขนาดพื้นที่</label>
                            <div data-slider="true" data-slider-options='{"min":0,"max":1000,"values":[0,500],"type":"sqrwa"}'></div>
                            <div class="text-center mt-2">
                                <input id="area-size-2" type="text" readonly class="border-0 amount text-center text-white bg-transparent font-weight-500" name="space_area">
                            </div>
                        </div>
                        <div class="col-12 pt-4 pb-2">
                            <a class="lh-17 d-inline-block other-feature collapsed" data-toggle="collapse" href="#other-feature-2" role="button" aria-expanded="false" aria-controls="other-feature-2">
                                <span class="fs-15 text-white font-weight-500 hover-primary">สิ่งอำนวยความสะดวก</span>
                            </a>
                        </div>
                        <div class="collapse row mx-0 w-100" id="other-feature-2">
                            <div class="col-sm-6 col-md-4 col-lg-3 py-2">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="check1-2" name="facility[]" value="สระว่ายน้ำ">
                                    <label class="custom-control-label text-white" for="check1-2"> สระว่ายน้ำ </label>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 py-2">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="check2-2" name="facility[]" value="ห้องสมุด">
                                    <label class="custom-control-label text-white" for="check2-2"> ห้องสมุด </label>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 py-2">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="check4-2" name="facility[]" value="สวนสาธารณะ">
                                    <label class="custom-control-label text-white" for="check4-2"> สวนสาธารณะ </label>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 py-2">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="check5-2" name="facility[]" value="ฟิตเนส">
                                    <label class="custom-control-label text-white" for="check5-2"> ฟิตเนส </label>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 py-2">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="check6-2" name="facility[]" value="ร้านสะดวกซื้อ">
                                    <label class="custom-control-label text-white" for="check6-2"> ร้านสะดวกซื้อ </label>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 py-2">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="check7-2" name="facility[]" value="สนามเด็กเล่น">
                                    <label class="custom-control-label text-white" for="check7-2"> สนามเด็กเล่น </label>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 py-2">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="check8-2" name="facility[]" value="เครื่องปรับอากาศ">
                                    <label class="custom-control-label text-white" for="check8-2"> เครื่องปรับอากาศ </label>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 py-2">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="check9-2" name="facility[]" value="Wi-Fi">
                                    <label class="custom-control-label text-white" for="check9-2"> Wi-Fi</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>