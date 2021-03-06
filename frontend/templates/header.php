<?php
require_once('dbconnect.php');

if (isset($_POST['g-recaptcha-response'])) {
    $captcha = $_POST['g-recaptcha-response'];
    // $captcha = $_GET["g-recaptcha-response"];
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LcCCf4eAAAAAMWzSwJw_owYszOf91DfcGxp7S_Z&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
    $g_response = json_decode($response);


    if (isset($_POST['submit'])) {

        if ($g_response->success === true) {

            $email = $con->real_escape_string($_POST['email']);
            $password = $con->real_escape_string($_POST['password']);

            $sql = "SELECT * FROM users
                  WHERE  email='" . $email . "' 
                  AND  password='" . $password . "' ";

            $result = $con->query($sql);
            $row = $result->fetch_assoc();

            if ($row["ustatus"] == '0') {
                echo "<script>";
                echo "alert(\"บัญชีนี้ถูกระงับการใช้งานแล้ว\");";
                echo "</script>";
                header('Refresh:0; url=index.php');
            } else {

                if (!empty($row)) {

                    $_SESSION["u_id"] = $row["u_id"];
                    $_SESSION["email"] = $row["email"];
                    $_SESSION["password"] = $row["password"];
                    $_SESSION["name"] = $row["name"];
                    $_SESSION["address"] = $row["address"];
                    $_SESSION["tel"] = $row["tel"];
                    $_SESSION["id_card"] = $row["id_card"];
                    $_SESSION["company"] = $row["company"];
                    $_SESSION["birth_date"] = $row["birth_date"];
                    $_SESSION["img"] = $row["img"];
                    $_SESSION["utype"] = $row["utype"];
                    $_SESSION["ustatus"] = $row["ustatus"];
                    $_SESSION['last_login_timestamp'] = time();


                    if (!empty($_POST['remember'])) {


                        // setcookie('user_login', $_POST['username'], time() + (10 * 365 * 24 * 60 * 60));
                        setcookie('user_login', $_POST['email'], time() + (1 * 24 * 60 * 60));

                        setcookie('user_password', $_POST['password'], time() + (1 * 24 * 60 * 60));
                    } else {

                        if (isset($_COOKIE['user_login'])) {
                            setcookie('user_login', '');

                            if (isset($_COOKIE['user_password'])) {
                                setcookie('user_password', '');
                            }
                        }
                    }


                    if ($_SESSION["utype"] == 'admin' || $_SESSION["utype"] == 'staff') {
                        header("location: page/profile.php");
                    }
                    if ($_SESSION["utype"] == 'member' || $_SESSION["utype"] == 'agent') {
                        header("location: frontend/dashboard-profiles.php");
                    }
                } else {
                    echo "<script>";
                    echo "alert(\" email หรือ  password ไม่ถูกต้อง\");";
                    echo "</script>";
                    header('Refresh:0; url=index.php');
                }
            }
        }else {
            echo "<script>";
            echo "alert(\" กรุณายืนยันตัวตน \");";
            echo "</script>";
            header('Refresh:0; url=index.php');
        }
    }
}

// if (isset($_SESSION["name"])) {
//     if ((time() - $_SESSION['last_login_timestamp']) > 120) //
//     {
//         header("location:page/logout.php");
//     } else {
//         $_SESSION['last_login_timestamp'] = time();
//     }
// } else {
//     header('href=#login-register-modal');
// }
$linkpri = "frontend/privacypolicy.php";
$linkcook = "frontend/cookiepolicy.php";

?>
<!-- Google fonts -->
<style>
    @import url('https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    * {
        font-family: 'Prompt', sans-serif;
    }

    .line {
        background-color: #00B900;
    }
</style>
<?php include 'cookies.php'; ?>
<header class="main-header navbar-light header-sticky header-sticky-smart header-mobile-lg">
    <div class=" sticky-area">
        <div class="container container-xxl">
            <div class="d-flex align-items-center">
                <nav class="navbar navbar-expand-xl bg-transparent px-0 w-100 w-xl-auto">
                    <a class="navbar-brand mr-7" href="index.php">
                        <img src="images/logo_new.png" alt="HomeID" class="d-none d-lg-inline-block">
                        <img src="images/logo_new2.png" alt="HomeID" class="d-inline-block d-lg-none">
                    </a>
                    <?php if (isset($_SESSION['u_id']) ? $_SESSION['u_id'] : '') {
                        $id = $_SESSION['u_id'];
                        $sqlfa = "SELECT * FROM favourite WHERE u_id= $id";
                        $resultfa = mysqli_query($con, $sqlfa);
                        $numf = mysqli_num_rows($resultfa); ?>
                        <a class="d-block d-xl-none ml-auto mr-4 position-relative text-white p-2" href="frontend/dashboard-favourites.php">
                            <i class="fal fa-heart fs-large-4"></i>
                            <span class="badge badge-primary badge-circle badge-absolute"><?php echo $numf ?></span>
                        </a>
                    <?php } ?>
                    <button class="navbar-toggler border-0 px-0" type="button" data-toggle="collapse" data-target="#primaryMenu02" aria-controls="primaryMenu02" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="text-white fs-24"><i class="fal fa-bars"></i></span>
                    </button>
                    <div class="collapse navbar-collapse mt-3 mt-xl-0" id="primaryMenu02">
                        <ul class="navbar-nav hover-menu main-menu px-0 mx-xl-n4">
                            <li id="navbar-item-home" aria-haspopup="true" aria-expanded="false" class="nav-item dropdown py-2 py-xl-5 px-0 px-xl-4">
                                <a class="nav-link p-0" href="index.php">
                                    หน้าแรก
                                    <span class="caret"></span>
                                </a>
                            </li>
                            <li id="navbar-item-listing" aria-haspopup="true" aria-expanded="false" class="nav-item dropdown py-2 py-xl-5 px-0 px-xl-4">
                                <a class="nav-link p-0" href="frontend/listing-grid.php">
                                    ค้นหาอสังหาริมทรัพย์
                                    <span class="caret"></span>
                                </a>
                            </li>
                            <li id="navbar-item-listing" aria-haspopup="true" aria-expanded="false" class="nav-item dropdown py-2 py-xl-5 px-0 px-xl-4">
                                <a class="nav-link p-0" href="frontend/agents.php">
                                    ค้นหานายหน้า
                                    <span class="caret"></span>
                                </a>
                            </li>
                            <!-- <li id="navbar-item-dashboard" aria-haspopup="true" aria-expanded="false" class="nav-item dropdown py-2 py-xl-5 px-0 px-xl-4">
                                <a class="nav-link p-0" href="frontend/calculator.php">
                                    คำนวณสินเชื่อที่อยู่อาศัย
                                    <span class="caret"></span>
                                </a>
                            </li> -->
                            <li id="navbar-item-dashboard" aria-haspopup="true" aria-expanded="false" class="nav-item dropdown py-2 py-xl-5 px-0 px-xl-4">
                                <a class="nav-link p-0" href="frontend/packages.php">
                                    แพ็คเกจโฆษณา
                                    <span class="caret"></span>
                                </a>
                            </li>
                            <li id="navbar-item-dashboard" aria-haspopup="true" aria-expanded="false" class="nav-item dropdown py-2 py-xl-5 px-0 px-xl-4">
                                <a class="nav-link p-0" href="frontend/blog.php">
                                    บทความ
                                    <span class="caret"></span>
                                </a>
                            </li>
                            <li id="navbar-item-dashboard" aria-haspopup="true" aria-expanded="false" class="nav-item dropdown py-2 py-xl-5 px-0 px-xl-4">
                                <a class="nav-link p-0" href="frontend/contact.php">
                                    ติดต่อเรา
                                    <span class="caret"></span>
                                </a>
                            </li>
                        </ul>
                        <div class="d-block d-xl-none">
                            <ul class="navbar-nav flex-row ml-auto align-items-center justify-content-lg-end flex-wrap py-2">
                                <?php if (isset($_SESSION['u_id']) ? $_SESSION['u_id'] : '') {
                                    $id = $_SESSION['u_id'];
                                    $sqlfa = "SELECT * FROM favourite WHERE u_id= $id";
                                    $resultfa = mysqli_query($con, $sqlfa);
                                    $numf = mysqli_num_rows($resultfa); ?>
                                    <li class="nav-item ">
                                        <a class="nav-link " href="page/logout.php" onclick="logOut();">ออกจากระบบ</a>
                                    </li>
                                <?php } else { ?>
                                    <li class="nav-item ">
                                        <a class="nav-link " data-toggle="modal" href="#login-register-modal">เข้าสู่ระบบ</a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </nav>
                <div class="ml-auto d-none d-xl-block">
                    <ul class="navbar-nav flex-row ml-auto align-items-center justify-content-lg-end flex-wrap py-2">
                        <?php if (isset($_SESSION['u_id']) ? $_SESSION['u_id'] : '') {
                            $id = $_SESSION['u_id'];
                            $sqlh = "SELECT * FROM users WHERE u_id= $id ";
                            $resulth = mysqli_query($con, $sqlh);
                            $rowh = mysqli_fetch_assoc($resulth); ?>
                            <li class="nav-item ">
                                <div class="dropdown border-md-right border-0 py-3 text-right">
                                    <a href="#" class="dropdown-toggle text-heading pr-3 pr-sm-6 d-flex align-items-center justify-content-end" data-toggle="dropdown">
                                        <div class="mr-4 w-48px">
                                            <img src="image/m_img/<?php echo $rowh['img'] ?>" width="50" class="rounded-circle">
                                        </div>
                                        <div class="fs-13 font-weight-500 lh-1">
                                            <h6><?php echo $rowh['name'] ?></h6>
                                        </div>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right w-100">
                                        <a class="dropdown-item" href="frontend/dashboard-profiles.php">ข้อมูลส่วนตัว</a>
                                        <a class="dropdown-item" href="page/logout.php" onclick="logOut();">ออกจากระบบ</a>
                                    </div>
                                </div>
                            </li>
                        <?php } else { ?>

                            <li class="nav-item ">
                                <a class="nav-link pl-3 pr-2" data-toggle="modal" href="#login-register-modal">เข้าสู่ระบบ</a>
                            </li>

                        <?php } ?>
                        <?php if (isset($_SESSION['u_id']) ? $_SESSION['u_id'] : '') {
                            $id = $_SESSION['u_id'];
                            $sqlf = "SELECT * FROM favourite WHERE u_id= $id";
                            $resultf = mysqli_query($con, $sqlf);
                            $numf = mysqli_num_rows($resultf); ?>
                            <li class="nav-item mr-auto mr-lg-6">
                                <a class="nav-link px-2 position-relative" href="frontend/dashboard-favourites.php">
                                    <i class="fal fa-heart fs-large-4"></i>
                                    <span class="badge badge-primary badge-circle badge-absolute"><?php echo $numf ?></span>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="modal fade login-register login-register-modal" id="login-register-modal" tabindex="-1" role="dialog" aria-labelledby="login-register-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mxw-571" role="document">
        <div class="modal-content">
            <div class="modal-header border-0 p-0">
                <div class="nav nav-tabs row w-100 no-gutters" id="myTab" role="tablist">
                    <a class="nav-item col-sm-4 ml-0 nav-link pr-6 py-4 pl-9 active fs-18" id="login-tab" data-toggle="tab" href="#login" role="tab" aria-controls="login" aria-selected="true">เข้าสู่ระบบ</a>
                    <a class="nav-item col-sm-4 ml-0 nav-link py-4 px-6 fs-18" id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="false">สมัครสมาชิก</a>
                    <div class="nav-item col-sm-4 ml-0 d-flex align-items-center justify-content-end">
                        <button type="button" class="close m-0 fs-30" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="margin-right: 35px;">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="modal-body p-4 py-sm-7 px-sm-8">
                <div class="tab-content shadow-none p-0" id="myTabContent">
                    <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
                        <form action="" method="post">
                            <div class="form-group mb-4">
                                <label for="username" class="sr-only">Email</label>
                                <div class="input-group input-group-lg">
                                    <div class="input-group-prepend ">
                                        <span class="input-group-text bg-gray-01 border-0 text-muted fs-18" id="inputGroup-sizing-lg">
                                            <i class="far fa-user"></i></span>
                                    </div>
                                    <input type="email" class="form-control border-0 shadow-none fs-13" id="email" name="email" value="<?php if (isset($_COOKIE['user_login'])) {

                                                                                                                                            echo $_COOKIE['user_login'];
                                                                                                                                        } ?>" required placeholder=" อีเมล">
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="password" class="sr-only">Password</label>
                                <div class="input-group input-group-lg">
                                    <div class="input-group-prepend ">
                                        <span class="input-group-text bg-gray-01 border-0 text-muted fs-18">
                                            <i class="far fa-lock"></i>
                                        </span>
                                    </div>
                                    <input type="password" class="form-control border-0 shadow-none fs-13" id="password" name="password" value="<?php if (isset($_COOKIE['user_login'])) {
                                                                                                                                                    echo $_COOKIE['user_password'];
                                                                                                                                                } ?>" required placeholder="รหัสผ่าน">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-gray-01 border-0 text-body fs-18">
                                            <i class="far fa-eye-slash"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" <?php if (isset($_COOKIE['user_login'])) { ?> checked <?php }  ?> id="remember-me" name="remember">
                                    <label class="form-check-label" for="remember-me">
                                        บันทึกการเข้าสู่ระบบ
                                    </label>
                                </div>
                                <!-- <a href="password-recovery.html" class="d-inline-block ml-auto text-orange fs-15">
                                    ลืมรหัสผ่านใช่หรือไม่
                                </a> -->

                            </div>
                            <div align="center">
                                <div id="html_element"></div>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block mt-5">เข้าสู่ระบบ</button>
                        </form>
                        <div class="divider text-center my-2">
                            <span class="px-4 bg-white lh-17 text">
                                หรือเชื่อมต่อผ่าน
                            </span>
                        </div>
                        <div class="row no-gutters mx-n2">
                            <div class="col-12 px-2 mb-4">
                                <a href="frontend/line_login.php" class="btn btn-lg btn-block line text-white px-0">
                                    <i class="fab fa-line fa-fw fa-2x"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                        <form action="backend/regis_db.php" id="regisform" method="post">
                            <div class="form-group mb-4">
                                <label for="username01" class="sr-only">Email</label>
                                <div class="input-group input-group-lg">
                                    <div class="input-group-prepend ">
                                        <span class="input-group-text bg-gray-01 border-0 text-muted fs-18">
                                            <i class="far fa-user"></i></span>
                                    </div>
                                    <input type="email" class="form-control border-0 shadow-none fs-13" id="email" name="email" required placeholder="อีเมล">
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="password01" class="sr-only">Password</label>
                                <div class="input-group input-group-lg">
                                    <div class="input-group-prepend ">
                                        <span class="input-group-text bg-gray-01 border-0 text-muted fs-18">
                                            <i class="far fa-lock"></i>
                                        </span>
                                    </div>
                                    <input type="password" class="form-control border-0 shadow-none fs-13" id="password" name="password" required placeholder="รหัสผ่าน">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-gray-01 border-0 text-body fs-18">
                                            <i class="far fa-eye-slash"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="full-name" class="sr-only">Full name</label>
                                <div class="input-group input-group-lg">
                                    <div class="input-group-prepend ">
                                        <span class="input-group-text bg-gray-01 border-0 text-muted fs-18">
                                            <i class="far fa-address-card"></i></span>
                                    </div>
                                    <input type="text" class="form-control border-0 shadow-none fs-13" id="name" name="name" required placeholder="ชื่อและนามสกุล">
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="phone01" class="sr-only">Phone</label>
                                <div class="input-group input-group-lg">
                                    <div class="input-group-prepend ">
                                        <span class="input-group-text bg-gray-01 border-0 text-muted fs-18">
                                            <i class="far fa-phone-alt"></i></span>
                                    </div>
                                    <input type="number" class="form-control border-0 shadow-none fs-13" id="tel" name="tel" required placeholder="เบอร์โทรศัพท์">
                                </div>
                            </div>

                            <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block">สมัครสมาชิก</button>
                        </form>
                        <div class="divider text-center my-2">
                            <span class="px-4 bg-white lh-17 text">
                                หรือเชื่อมต่อผ่าน
                            </span>
                        </div>
                        <div class="row no-gutters mx-n2">
                            <div class="col-12 px-2 mb-4">
                                <a href="frontend/line_login.php" class="btn btn-lg btn-block line text-white px-0">
                                    <i class="fab fa-line fa-fw fa-2x"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var onloadCallback = function() {
        grecaptcha.render('html_element', {
            'sitekey': '6LcCCf4eAAAAALIttIMJvPMaY8MmdWfy_Z-awrO2'
        });
    };
</script>
<script src="https://static.line-scdn.net/liff/edge/2/sdk.js"></script>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>

<script>
    function logOut() {
        liff.init({
            liffId: "1656973328-Oae71Lxj"
        });
        liff.logout();

    }
</script>