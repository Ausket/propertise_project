<?php 

require('../dbconnect.php');

        $id = $_POST['status_id'];

        echo  $id ;

        $sql ="SELECT * FROM advertise_type WHERE atype_id = '$id' ";
        $result = mysqli_query($con, $sql);
       
        foreach($result as $value){

             $status =   $value['at_status'];
        }

        
      

        if($status == '1'){

                $sql2 = "UPDATE advertise_type SET at_status = '0' WHERE atype_id =  '$id'";
        
                $result2 = mysqli_query($con, $sql2) ;


        }else{             
                   $sql3 = "UPDATE advertise_type SET at_status = '1' WHERE atype_id =  '$id'";
        
                $result3 = mysqli_query($con, $sql3) ;
        } 
        




?>