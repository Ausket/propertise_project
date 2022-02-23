<?php
require_once('../dbconnect.php');

$id = $_SESSION['u_id'];
if (empty($id)) {
    header('Location:../index.php');
}
$sqlu = "SELECT * FROM users WHERE u_id= $id ";
$resultu = mysqli_query($con, $sqlu);
$rowu = mysqli_fetch_assoc($resultu);

$sqla = "SELECT * FROM advertise WHERE u_id = $id ";
$resulta = mysqli_query($con, $sqla);
$total_record = mysqli_num_rows($resulta);

$sqlf = "SELECT * FROM favourite WHERE u_id= $id";
$resultf = mysqli_query($con, $sqlf);
$numf = mysqli_num_rows($resultf); 

$sqlv = "SELECT SUM(view) FROM advertise WHERE u_id = $id ";
$resultv = mysqli_query($con, $sqlv) or die(mysqli_error($con));
$rowv = mysqli_fetch_assoc($resultv);

// if (isset($_SESSION["name"])) {
//     if ((time() - $_SESSION['last_login_timestamp']) > 60) //
//     {
//         header("location:../page/logout.php");
//     } else {
//         $_SESSION['last_login_timestamp'] = time();
//     }
// } else {
//     header('href=#login-register-modal');
// }

?>



<div class="db-sidebar bg-white">
    <nav class="navbar navbar-expand-xl navbar-light d-block px-0 header-sticky dashboard-nav py-0">
        <div class="sticky-area shadow-xs-1 py-3">
            <div class="d-flex px-3 px-xl-6 w-100">
                <a class="navbar-brand" href="../index.php">
                    <img src="../images/logo.png" alt="HomeID">
                </a>
                <div class="ml-auto d-flex align-items-center ">
                    <div class="d-flex align-items-center d-xl-none pr-2">
                        <div class="d-flex align-items-center text-heading">
                            <div class="w-48px">
                                <img src="../image/m_img/<?php echo $rowu['img']; ?>" alt="Ronald Hunter" class="rounded-circle">
                            </div>
                            <span class="fs-13 font-weight-500 d-none d-sm-inline ml-2">
                                <?php echo $rowu['name']; ?>
                            </span>
                        </div>
                    </div>
                    <button class="navbar-toggler border-0 px-0" type="button" data-toggle="collapse" data-target="#primaryMenuSidebar" aria-controls="primaryMenuSidebar" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
            </div>
            <div class="collapse navbar-collapse bg-white" id="primaryMenuSidebar">
                <ul class="list-group list-group-flush w-100">
                    <li class="list-group-item pt-6 pb-4">
                        <h5 class="fs-13 letter-spacing-087 text-muted mb-3 text-uppercase px-3">สรุปผล</h5>
                        <ul class="list-group list-group-no-border rounded-lg">
                            <li class="list-group-item px-3 px-xl-4 py-2 sidebar-item">
                                <a href="dashboard.php" class="text-heading lh-1 sidebar-link">
                                    <span class="sidebar-item-icon d-inline-block mr-3 fs-20"><i class="fal fa-cog"></i></span>
                                    <span class="sidebar-item-text">แดชบอร์ด</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="list-group-item pt-6 pb-4">
                        <h5 class="fs-13 letter-spacing-087 text-muted mb-3 text-uppercase px-3">รายการประกาศ</h5>
                        <ul class="list-group list-group-no-border rounded-lg">
                            <li class="list-group-item px-3 px-xl-4 py-2 sidebar-item">
                                <a href="dashboard-add-property.php" class="text-heading lh-1 sidebar-link d-flex align-items-center">
                                    <span class="sidebar-item-icon d-inline-block mr-3 text-muted fs-20 fs-20">
                                        <svg class="icon icon-add-new">
                                            <use xlink:href="#icon-add-new"></use>
                                        </svg></span>
                                    <span class="sidebar-item-text">ลงประกาศ</span>
                                </a>
                            </li>
                            <li class="list-group-item px-3 px-xl-4 py-2 sidebar-item">
                                <a href="dashboard-properties.php" class="text-heading lh-1 sidebar-link d-flex align-items-center">
                                    <span class="sidebar-item-icon d-inline-block mr-3 text-muted fs-20">
                                        <svg class="icon icon-my-properties">
                                            <use xlink:href="#icon-my-properties"></use>
                                        </svg>
                                    </span>
                                    <span class="sidebar-item-text">ประกาศของฉัน</span>
                                    <span class="sidebar-item-number ml-auto text-primary fs-15 font-weight-bold"><?php echo $total_record ?></span>
                                </a>
                            </li>
                            <li class="list-group-item px-3 px-xl-4 py-2 sidebar-item">
                                <a href="dashboard-favourites.php" class="text-heading lh-1 sidebar-link d-flex align-items-center">
                                    <span class="sidebar-item-icon d-inline-block mr-3 text-muted fs-20">
                                        <svg class="icon icon-heart">
                                            <use xlink:href="#icon-heart"></use>
                                        </svg>
                                    </span>
                                    <span class="sidebar-item-text">รายการโปรด</span>
                                    <span class="sidebar-item-number ml-auto text-primary fs-15 font-weight-bold"><?php echo $numf ?></span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="list-group-item pt-6 pb-4">
                        <h5 class="fs-13 letter-spacing-087 text-muted mb-3 text-uppercase px-3">จัดการบัญชีผู้ใช้</h5>
                        <ul class="list-group list-group-no-border rounded-lg">
                            <li class="list-group-item px-3 px-xl-4 py-2 sidebar-item">
                                <a href="dashboard-my-packages.php" class="text-heading lh-1 sidebar-link d-flex align-items-center">
                                    <span class="sidebar-item-icon d-inline-block mr-3 text-muted fs-20">
                                        <svg class="icon icon-my-package">
                                            <use xlink:href="#icon-my-package"></use>
                                        </svg>
                                    </span>
                                    <span class="sidebar-item-text">แพ็คเก็จของฉัน</span>
                                    <span class="sidebar-item-number ml-auto text-primary fs-15 font-weight-bold">5</span>
                                </a>
                            </li>
                            <li class="list-group-item px-3 px-xl-4 py-2 sidebar-item">
                                <a href="dashboard-profiles.php" class="text-heading lh-1 sidebar-link d-flex align-items-center">
                                    <span class="sidebar-item-icon d-inline-block mr-3 text-muted fs-20">
                                        <svg class="icon icon-my-profile">
                                            <use xlink:href="#icon-my-profile"></use>
                                        </svg>
                                    </span>
                                    <span class="sidebar-item-text">ข้อมูลส่วนตัว</span>
                                </a>
                            </li>
                            <li class="list-group-item px-3 px-xl-4 py-2 sidebar-item">
                                <a href="../page/logout.php" class="text-heading lh-1 sidebar-link d-flex align-items-center">
                                    <span class="sidebar-item-icon d-inline-block mr-3 text-muted fs-20">
                                        <svg class="icon icon-log-out">
                                            <use xlink:href="#icon-log-out"></use>
                                        </svg>
                                    </span>
                                    <span class="sidebar-item-text">ออกจากระบบ</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>