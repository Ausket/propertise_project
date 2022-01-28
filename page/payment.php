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
$sql2 = "SELECT * FROM history_package WHERE hp_id = $idp ";
$result2 = mysqli_query($con, $sql2);
$row2 = mysqli_fetch_array($result2);
$pack = $row2['packtype_id'];

$sql3 = "SELECT * FROM package_type WHERE packtype_id = $pack ";
$result3 = mysqli_query($con, $sql3);
$row3 = mysqli_fetch_array($result3);



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
                <a class="btn btn-outline-success my-2 my-sm-0" type="submit" href="../page/logout.php">ออกจากระบบ</a>
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
                    <h3 style="text-transform: uppercase">ชำระเงิน</h3>
                </div>
            </div>

            <div class="container">
                <div class="offset-2 col-10 ">
                    <div class="column" style="width: 800px;">
                        <div class="card card-dark">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-dollar"> รายละเอียดการชำระเงิน</h3>
                            </div>
                            <!-- /.card-header -->

                            <div class="card-body">
                                <strong><i class="fas fa-box"></i> แพ็คเกจ <h3><?php echo $row3['pack_name']; ?></h3>
                                    <h5>ยอดเงินที่ต้องชำระ <?php echo $row3['price']; ?> บาท</h5>
                                </strong>
                                <hr>
                                <strong><i class="fas fa-user"></i> รหัสสั่งซื้อ : <?php echo $row2['hp_id']; ?></strong>

                                <hr>

                                <strong><i class="fas fa-user"></i> ชื่อผู้ซื้อ : <?php echo $row2['u_name']; ?></strong>

                                <hr>

                                <strong><i class="fas fa-envelope"></i> อีเมล : <?php echo $row2['u_email']; ?></strong>

                                <hr>

                                <strong><i class="fas fa-phone"></i> เบอร์โทร : <?php echo $row2['u_tel']; ?></strong>

                               
                            </div> <!-- /.card-body -->
                        </div>
                    </div> 

                    <div class="column "  style="width:800px;">
                        <div class="card card-dark">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-dollar">วิธีชำระเงิน</h3>
                            </div>
                            <!-- /.card-header -->

                            <div class="card-body">
                                <strong><i class="fas fa-box"></i> แพ็คเกจ <h3><?php echo $row3['pack_name']; ?></h3>
                                    <h5>ยอดเงินที่ต้องชำระ <?php echo $row3['price']; ?> บาท</h5>
                                </strong>
                                <hr>
                                <strong>
                                    <h5>วิธีชำระเงิน </h5>
                                </strong>
                               <hr>
                                <div class="row offset-4 col-8">
                                    <a href="../backend/payment_db.php?id=<?php echo $row2['hp_id']; ?>"><button class="btn btn-warning mr-2 d-block" type="submit">ชำระเงิน</button></a>
                                    <a href="cancel_order.php?id=<?php echo $row2['hp_id']; ?>"><button class="btn btn-danger m-auto d-block" type="submit">ยกเลิกคำสั่งซื้อ</button></a>        
                                </div>  
                              
                               
                            </div> <!-- /.card-body -->
                        </div>
                    </div> 
                           
                </div>      
            </div>

         
                    
            

        </div><!-- /.container-fluid -->
</body>

</html>