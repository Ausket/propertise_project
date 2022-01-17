<?php 

require('../dbconnect.php');

        $id = $_POST['status_id'];

        echo  $id ;

        $sql ="SELECT * FROM users WHERE u_id = '$id' ";
        $result = mysqli_query($con, $sql);
       
        foreach($result as $value){

             $status =   $value['ustatus'];
        }

        
      

        if($status == '1'){

                $sql2 = "UPDATE users SET ustatus = '0' WHERE u_id =  '$id'";
        
                $result2 = mysqli_query($con, $sql2) ;


        }else{             
                   $sql3 = "UPDATE users SET ustatus = '1' WHERE u_id =  '$id'";
        
                $result3 = mysqli_query($con, $sql3) ;
        } 
        




?>