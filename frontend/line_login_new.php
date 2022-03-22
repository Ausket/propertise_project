<?php

include('../dbconnect.php');

$oa_id = $_SESSION['oa_id']

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Line log in </title>

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
            <a href="#"><b style="color:black">INFORMATION</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body" style="border-radius:10px">
                <p class="login-box-msg">Please enter your number</p>

                <form class="form" id="test" action="../backend/line_add_member.php" method="POST">
                    <img class="d-block m-auto" style="border-radius:50%" id="pictureUrl" width="100">

                    <p id="displayName" class="text-center">Name : </p>


                    <!-- <span class="tag-p" style="display: none;">
                        <p id="statusMessage">Status : </p>
                        <p id="userId">userId : </p>
                        <p id="decodedIDToken"><b>email:</b> </p>
                        <p id="os"><b>OS:</b> </p>
                        <p id="language"><b>Language:</b> </p>
                        <p id="version"><b>Version:</b> </p>
                        <p id="isInClient"><b>isInClient:</b> </p>
                        <div class="token">
                            <p id="accessToken"><b>AccessToken:</b>
                        </div>
                        <p id="type"><b>type:</b> </p>
                        <p id="viewType"><b>viewType:</b> </p>
                        <p id="utouId"><b>utouId:</b> </p>
                        <p id="roomId"><b>roomId:</b> </p>
                        <p id="groupId"><b>groupId:</b> </p>
                    </span> -->

    
                    <input type="text" id="name" name="name" readonly
                     placeholder="name" hidden>
                    <input type="" id="user" name="user" hidden>

                    <input type="" id="access" name="accessToken" hidden>
                    <input type="" id="link_img" name="link_img" hidden>

                    <input type="" id="oa_id" name="oa_id" value="<?php echo $oa_id ?>" hidden>

                    <input class="d-block m-auto" type="text" name="phone" placeholder="Phone" required>
                    <br>
                    <input class="btn btn-success d-block m-auto" id="btn" type="submit" value="SAVE"></input>

                </form>

            </div>

            
            <!-- /.login-card-body -->
        </div>
    </div>

    
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <script src="https://static.line-scdn.net/liff/edge/2/sdk.js"></script>
    <script>
        function logOut() {
            liff.logout();
            window.location.reload();
        }

        function logIn() {
            liff.login({
                redirectUri: window.location.href
            });

        }


        async function getUserProfile() {

            const profile = await liff.getProfile();
            document.getElementById("pictureUrl").style.display = "block";
            document.getElementById("pictureUrl").src = profile.pictureUrl;
            document.getElementById("displayName").append(profile.displayName);
            document.getElementById("name").value = profile.displayName;
            document.getElementById("user").value = profile.userId;
            document.getElementById("access").value = (liff.getAccessToken());
            document.getElementById("link_img").value =  profile.pictureUrl;
           
        }

        async function main() {
            await liff.init({
                liffId: "1656973328-Oae71Lxj"
            });
            if (liff.isInClient()) {
                getUserProfile();
                
            } else {
                if (liff.isLoggedIn()) {
                    getUserProfile();
                   
                  
                    // document.getElementById("name").value = profile.displayName;
                    // document.getElementById("link_img").value =  profile.pictureUrl;
                    // document.getElementById("user").value = profile.userId;

                    // document.getElementById("access").value = (liff.getAccessToken());

                    // const profile = await liff.getProfile();

                    // document.getElementById("name").value = profile.displayName;
                    // document.getElementById("status").value = profile.statusMessage;
                    // document.getElementById("access").value = liff.getAccessToken();
                    // document.getElementById("email").value = (liff.getDecodedIDToken().email);
                   



                    // document.getElementById("btnLogIn").style.display = "none";
                    // document.getElementById("btnLogOut").style.display = "block";


                } else {
                    liff.login(

                        {
                            redirectUri: window.location.href = "https://lifejung.com/frontend/line_login_new.php"
                        }


                    )

                    document.getElementById("btnLogIn").style.display = "block";
                    document.getElementById("btnLogOut").style.display = "none";


                }
            }
        }


        main();
    </script>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="../js/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../js/adminlte.min.js"></script>
</body>

</html>