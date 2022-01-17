
<?php

require('../dbconnect.php');

                $id = $_GET['id'];
                $name = $_POST['name'];
                $link = $_POST['link'];
                $icon = $_POST['icon'];
                $type = $_POST['ptype'];
               

                $sql2 = "UPDATE users_role
                SET page = '$name', link= '$link',icon = '$icon',type='$type'
                 WHERE p_id = '$id' ";
                $result2 = mysqli_query($con, $sql2);

                if ($result2) {

                    echo '<script> window.location.href = "../page/control.php";alert("Update success") </script>';
                }


?>