<?php

require('../dbconnect.php');

                $id = $_GET['id'];
                $type = $_POST['type'];
               
                $sql = "UPDATE advertise_type
                SET type = '$type'
                 WHERE atype_id = '$id' ";
                $result = mysqli_query($con, $sql) or die(mysqli_error($con));

                echo '<script> window.location.href = "../page/advertise_type.php";alert("แก้ไขข้อมูลเรียบร้อย") </script>';
               


?>