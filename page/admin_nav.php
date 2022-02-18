<?php
/* @ini_set('display_errors', '0'); */

$u_id = $_SESSION['u_id'];
if (empty($u_id)) {
    header('Location:../index.php');
}
 
$type = $_SESSION['utype'];
if ($type == 'member' || $type == 'agent') {
    header('Location:../index.php');
}

$sql_id = "SELECT * FROM users WHERE u_id = $u_id ";
$result_id = mysqli_query($con, $sql_id);
$row_id = mysqli_fetch_array($result_id);


$sqlr = "SELECT * FROM users_role  ";
$resultr = mysqli_query($con, $sqlr);

$sqlrt = "SELECT * FROM user_role_type  ";
$resultrt = mysqli_query($con, $sqlrt);


?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Prompt:wght@300&display=swap');

    * {
        font-family: 'Prompt', sans-serif;

    }
</style>


<div class="wrapper">

    <!-- Navbar -->

    <nav class="main-header navbar navbar-expand navbar-info ">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars" style="color: white;"></i></a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">

            <!-- Messages Dropdown Menu -->
            <li class="nav-item dropdown">
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <div class="dropdown-divider"></div>
                    <!-- Message Start -->
                    <!-- Message End -->
            </li>
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt" style="color: white;"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                    <i class="fas fa-th-large" style="color: white;"></i>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="profile.php" class="brand-link">
            <span class="brand-text font-weight-light" style="margin-left: 20px; text-transform: uppercase;"><?php echo $row_id['utype']; ?> Managment</span>
        </a>


        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 mb-3 d-block">


               
                <?php
                if ($_SESSION['utype'] == 'admin' || $_SESSION['utype'] == 'staff' ) {
                ?>
                    <img class="d-block m-auto" style="border-radius:50% ; width:3rem;" src="../image/m_img/<?php echo $row_id['img'] ?>" width="150" alt="img">

                <?php
                }
                ?>

                <div class="info d-block text-center ">
                    <h5 style="color:white;"><?php echo $row_id['name']; ?></h5>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2" id="connavbar">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <?php

                    if ($_SESSION['utype'] == 'admin') {
                        while ($rowrt = mysqli_fetch_array($resultrt)) {
                            echo " <li class='nav-item'>
            <a href='#' class='nav-link'>
              <i class='nav-icon $rowrt[type_icon]'></i>
              <p>
               $rowrt[name]
                <i class='fas fa-angle-left right'></i>
              </p>
            </a>
            <ul class='nav nav-treeview'>";
                            foreach ($resultr as $value) {
                                if ($value['admin'] == '1') {
                                    if ($rowrt['id'] == $value['type']) {
                                        echo " <li class='nav-item ml-2' ><a href='$value[link]' class='nav-link '>
                 <i class='$value[icon]'></i>
                    <p>
                 $value[page]
                     </p>
                     </a>
                    </li> ";
                                    }
                                }
                            }
                            echo  "</ul></li>";
                        }
                    }

                    if ($_SESSION['utype'] == 'member') {
                        while ($rowrt = mysqli_fetch_array($resultrt)) {
                            echo " <li class='nav-item'>
            <a href='#' class='nav-link'>
              <i class='nav-icon $rowrt[type_icon]'></i>
              <p>
               $rowrt[name]
                <i class='fas fa-angle-left right'></i>
              </p>
            </a>
            <ul class='nav nav-treeview'>";
                            foreach ($resultr as $value) {
                                if ($value['member'] == '1') {
                                    if ($rowrt['id'] == $value['type']) {
                                        echo " <li class='nav-item ml-2' ><a href='$value[link]' class='nav-link '>
                 <i class='$value[icon]'></i>
                    <p>
                 $value[page]
                     </p>
                     </a>
                    </li> ";
                                    }
                                }
                            }
                            echo  "</ul></li>";
                        }
                    }
                    if ($_SESSION['utype'] == 'agent') {
                        while ($rowrt = mysqli_fetch_array($resultrt)) {
                            echo " <li class='nav-item'>
            <a href='#' class='nav-link'>
              <i class='nav-icon $rowrt[type_icon]'></i>
              <p>
               $rowrt[name]
                <i class='fas fa-angle-left right'></i>
              </p>
            </a>
            <ul class='nav nav-treeview'>";
                            foreach ($resultr as $value) {
                                if ($value['agent'] == '1') {
                                    if ($rowrt['id'] == $value['type']) {
                                        echo " <li class='nav-item ml-2' ><a href='$value[link]' class='nav-link '>
                 <i class='$value[icon]'></i>
                    <p>
                 $value[page]
                     </p>
                     </a>
                    </li> ";
                                    }
                                }
                            }
                            echo  "</ul></li>";
                        }
                    }
                    if ($_SESSION['utype'] == 'staff') {
                        while ($rowrt = mysqli_fetch_array($resultrt)) {
                            echo " <li class='nav-item'>
            <a href='#' class='nav-link'>
              <i class='nav-icon $rowrt[type_icon]'></i>
              <p>
               $rowrt[name]
                <i class='fas fa-angle-left right'></i>
              </p>
            </a>
            <ul class='nav nav-treeview'>";
                            foreach ($resultr as $value) {
                                if ($value['staff'] == '1') {
                                    if ($rowrt['id'] == $value['type']) {
                                        echo " <li class='nav-item ml-2' ><a href='$value[link]' class='nav-link '>
                 <i class='$value[icon]'></i>
                    <p>
                 $value[page]
                     </p>
                     </a>
                    </li> ";
                                    }
                                }
                            }
                            echo  "</ul></li>";
                        }
                    }
                    ?>


                    <li class="nav-item">
                        <a href="logout.php" class="nav-link" id="btnLogOut" onclick="logOut();">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>
                                ออกจากระบบ
                            </p>



                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>