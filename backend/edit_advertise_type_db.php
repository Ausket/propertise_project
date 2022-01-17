<?php

require('../dbconnect.php');

                $id = $_GET['id'];
                $type = $_POST['type'];
               
                $sql = "UPDATE advertise_type
                SET type = '$type'
                 WHERE atype_id = '$id' ";
                $result = mysqli_query($con, $sql);

                if ($result) {

                    echo '<script> window.location.href = "../page/advertise_type.php";alert("Update success") </script>';
                }


?>