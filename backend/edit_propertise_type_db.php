<?php

require('../dbconnect.php');

                $id = $_GET['id'];
                $type = $_POST['type'];
                $x = "";
                $check = "SELECT p_type FROM property_type ";
                $qr = mysqli_query($con, $check) or die(mysqli_error($con));
                while ($row = mysqli_fetch_array($qr)) {
                
                    if ($row['p_type'] == $type) {
                        echo '<script> window.location.href = "../page/edit_propertise_type.php?id='.$id.'";alert("ชื่อหมวดหมู่นี้ซ้ำ")</script>';
                        $x = 1;
                    }
                }
                if ($x !== 1) {
                
                $sql = "UPDATE property_type
                SET p_type = '$type'
                 WHERE ptype_id = '$id' ";
                $result = mysqli_query($con, $sql) or die(mysqli_error($con));

                echo '<script> window.location.href = "../page/propertise_type.php";alert("แก้ไขข้อมูลเรียบร้อย") </script>';
 
                }
