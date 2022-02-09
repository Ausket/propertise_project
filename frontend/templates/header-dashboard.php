<?php
require_once('../dbconnect.php');

$id = $_SESSION['u_id'];
if (empty($id)) {
    header('Location:../index.php');
}
$sqlu = "SELECT * FROM users WHERE u_id= $id ";
$resultu = mysqli_query($con, $sqlu);
$rowu = mysqli_fetch_assoc($resultu);


?>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    * {
        font-family: 'Prompt', sans-serif;
    }
</style>
 
<header class="main-header shadow-none shadow-lg-xs-1 bg-white position-relative d-none d-xl-block">
    <div class="container-fluid">
        <nav class="navbar navbar-light py-0 row no-gutters px-3 px-lg-0">
            <div class="col-md-12 d-flex flex-wrap justify-content-md-end order-0 order-md-1">
                <div class="dropdown border-md-right border-0 py-3 text-right">
                    <a href="#" class="dropdown-toggle text-heading pr-3 pr-sm-6 d-flex align-items-center justify-content-end" data-toggle="dropdown">
                        <div class="mr-4 w-48px">
                        <img  src="../image/m_img/<?php echo $rowu['img'] ?>" width="50"  class="rounded-circle">
                        </div>
                        <div class="fs-13 font-weight-500 lh-1">
                        <?php echo $rowu['name'] ?>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right w-100">
                        <a class="dropdown-item" href="../frontend/dashboard-profiles.php">ข้อมูลส่วนตัว</a>
                        <a class="dropdown-item" href="../page/logout.php">ออกจากระบบ</a>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>