<?php
require_once('../dbconnect.php');

if (isset($_POST['submit'])) {

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
        header('Refresh:0; url=login.php');
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

            // if( $_SESSION["utype"] == 'admin' || $_SESSION["utype"] == 'staff'  ){
            //   header("location: index.php");
            // }
            // if( $_SESSION["utype"] == 'member'){
            //     header("location: index_member.php");
            //   }
              
            // if( $_SESSION["utype"] == 'agent'){
            //     header("location: index_agent.php");
            //   }
            header("location: index.php");

            
        } else {
            echo "<script>";
            echo "alert(\" email หรือ  password ไม่ถูกต้อง\");";
            echo "</script>";
            header('Refresh:0; url=login.php');
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Log in</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <!-- <link rel="stylesheet" href="../css/all.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="../css/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="../../index2.html"><b>LOGIN</b></a><br>

        </div>
        <!-- /.login-logo -->

        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>


                <form action="" method="post">
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="email" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <!-- /.col -->
                        <div class="col-12">
                            <button type="submit" name="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <div class="col-12">
                            <p class="text-center">- OR -</p>
                            <a href="line_login.php" class="btn btn-block btn-success">
                                <i class="fab fa-line mr-2"></i> Sign in using Line
                            </a>
                        </div>
                    </div>
                </form>
                <div class="col-12">
                    <a href="register.php">
                        <p class="text-center mt-2">I don't have a membership</p>
                    </a>
                </div>
                <!-- /.col -->

            </div>
            <!-- /.login-card-body -->
        </div>


    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="../js/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../js/adminlte.min.js"></script>
</body>

</html>