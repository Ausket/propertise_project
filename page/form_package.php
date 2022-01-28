<?php
require_once('../dbconnect.php');

$id = $_SESSION['u_id'];
if (empty($id)) {
    header('Location:login.php');
}
$sql = "SELECT * FROM users WHERE u_id= $id ";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);

$sqlp = "SELECT * FROM users_role  ";
$resultp = mysqli_query($con, $sqlp);

$idp = $_GET["id"];
$sql2 = "SELECT * FROM package_type WHERE packtype_id = $idp ";
$result2 = mysqli_query($con, $sql2);
$row2 = mysqli_fetch_array($result2)

?>
<!DOCTYPE html>
<html lang="en">
<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome Icons -->
<!-- <link rel="stylesheet" href="../css/all.min.css"> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- Theme style -->
<link rel="stylesheet" href="../css/adminlte.min.css">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
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
                <a class="btn btn-outline-success my-2 my-sm-0" type="submit" href="../logout.php">ออกจากระบบ</a>
            </div>
        </nav>
        <div class="mt-5">
            <div class="container">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="profile.php">ข้อมูลส่วนตัว</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="advertise.php">ประกาศของฉัน</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="favourite.php">รายการโปรด</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="reset_pass.php">เปลี่ยนรหัสผ่าน</a>
                    </li>
                </ul>
                <div class="mt-3">
                    <h3 style="text-transform: uppercase">แพ็คเกจ</h3>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row ">
                    <div class="offset-sm-3 col-md-6">

                        <div class="card card-dark">
                            <div class="card-header">
                                <h3 class="card-title">กรุณากรอกข้อมูลในการซื้อแพ็คเกจ</h3>
                            </div>
                            <!-- /.card-header -->
                            <form class="form-horizontal" action="../backend/buy_package.php?id=<?php echo $row2['packtype_id']; ?>" method="post">
                                <div class="card-body">
                                <strong><i class="fas fa-box"></i> แพ็คเกจ <h3><?php echo $row2['pack_name']; ?></h3>
                                <h3>ยอดเงินที่ต้องชำระ <?php echo $row2['price']; ?> บาท</h3></strong>
                                <hr>
                                    <div class="form-group">
                                        <strong><i class="fas fa-user"></i> ชื่อ</strong>
                                        <input type="text" method="post" class="form-control" name="name" value="<?php echo $row['name']; ?>" placeholder="" required>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <strong><i class="fas fa-envelope"></i> อีเมล</strong>
                                        <input type="email" method="post" class="form-control" name="email" value="<?php echo $row['email']; ?>" placeholder="" required>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <strong><i class="fas fa-phone"></i> เบอร์โทร </strong>
                                        <input type="text" method="post" class="form-control" name="tel" value="<?php echo $row['tel']; ?>" placeholder="" required>
                                    </div>

                                    <div class="col-12">
                                        <button class="btn btn-warning d-block m-auto" name="submit" type="submit"> ดำเนินการชำระเงิน</button>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </div><!-- /.container-fluid -->
</body>

</html>