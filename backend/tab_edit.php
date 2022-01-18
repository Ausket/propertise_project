
<?php

require('../dbconnect.php');

                $id = $_GET['id'];
                $name = $_POST['name'];
                $link = $_POST['link'];
                $icon = $_POST['icon'];
                $type = $_POST['ptype'];
               

                $sql = "UPDATE users_role
                SET page = '$name', link= '$link',icon = '$icon',type='$type'
                 WHERE p_id = '$id' ";
                $result = mysqli_query($con, $sql) or die(mysqli_error($con));

              

                    echo '<script> window.location.href = "../page/control.php";alert("แก้ไขข้อมูลเรียบร้อย") </script>';
              


?>