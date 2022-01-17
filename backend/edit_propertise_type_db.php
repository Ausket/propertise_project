<?php

require('../dbconnect.php');

                $id = $_GET['id'];
                $type = $_POST['type'];
               
                $sql = "UPDATE property_type
                SET p_type = '$type'
                 WHERE ptype_id = '$id' ";
                $result = mysqli_query($con, $sql);

                if ($result) {

                    echo '<script> window.location.href = "../page/propertise_type.php";alert("Update success") </script>';
                }


?>