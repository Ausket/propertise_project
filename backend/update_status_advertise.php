<?php 

require('../dbconnect.php');

        $id = $_POST['status_id'];

        echo  $id ;

        $sql ="SELECT * FROM advertise WHERE a_id = '$id' ";
        $result = mysqli_query($con, $sql);
       
        foreach($result as $value){

             $status =   $value['ad_status'];
        }

        
      

        if($status == '1'){

                $sql2 = "UPDATE advertise SET ad_status = '0' WHERE a_id =  '$id'";
        
                $result2 = mysqli_query($con, $sql2) ;


        }else{             
                   $sql3 = "UPDATE advertise SET ad_status = '1' WHERE a_id =  '$id'";
        
                $result3 = mysqli_query($con, $sql3) ;
        } 
        




?>