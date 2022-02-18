<?php

require('../dbconnect.php');

                $id = $_GET['id'];
                $type = $_POST['type'];
                $color= $_POST['color'];
               
                $sql = "UPDATE advertise_type
                SET type = '$type', color = '$color'
                 WHERE atype_id = '$id' ";
                $result = mysqli_query($con, $sql) or die(mysqli_error($con));

                echo '<script> window.location.href = "../page/advertise_type.php";alert("แก้ไขข้อมูลเรียบร้อย") </script>';
               


?>