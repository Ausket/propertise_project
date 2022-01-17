<?php 

require('../dbconnect.php');

        $id = $_POST['status_id'];

        echo  $id ;

        $sql ="SELECT * FROM property_type WHERE ptype_id = '$id' ";
        $result = mysqli_query($con, $sql);
       
        foreach($result as $value){

             $status =   $value['pt_status'];
        }

        
      
        if($status == '1'){

                $sql2 = "UPDATE property_type SET pt_status = '0' WHERE ptype_id =  '$id'";
        
                $result2 = mysqli_query($con, $sql2) ;


        }else{             
                   $sql3 = "UPDATE property_type SET pt_status = '1' WHERE ptype_id =  '$id'";
        
                $result3 = mysqli_query($con, $sql3) ;
        } 
        




?>