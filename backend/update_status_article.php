<?php 

require('../dbconnect.php');

        $id = $_POST['status_id'];

        echo  $id ;

        $sql ="SELECT * FROM article WHERE a_id = '$id' ";
        $result = mysqli_query($con, $sql);
       
        foreach($result as $value){

             $status =   $value['a_status'];
        }
   

        if($status == '1'){

                $sql2 = "UPDATE article SET a_status = '0' WHERE a_id =  '$id'";
        
                $result2 = mysqli_query($con, $sql2) ;


        }else{             
                   $sql3 = "UPDATE article SET a_status = '1' WHERE a_id =  '$id'";
        
                $result3 = mysqli_query($con, $sql3) ;
        } 
        




?>