
<?php

require('../dbconnect.php');

                $id = $_GET['id'];               
                $icon = $_POST['icon'];
                $type = $_POST['type'];
               

                $sql = "UPDATE user_role_type
                SET type_icon = '$icon',name='$type'
                 WHERE id = '$id' ";
                $result = mysqli_query($con, $sql) or die(mysqli_error($con));

                echo '<script> window.location.href = "../page/page_type.php";alert("แก้ไขข้อมูลเรียบร้อย") </script>';
              


?>