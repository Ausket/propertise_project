<?php 

require('../dbconnect.php');

        $id = $_POST['status_id'];

        echo  $id ;

        $sql ="SELECT * FROM article_type WHERE at_id = '$id' ";
        $result = mysqli_query($con, $sql);
       
        foreach($result as $value){

             $status =   $value['at_status'];
        }

          

        if($status == '1'){

                $sql2 = "UPDATE article_type SET at_status = '0' WHERE at_id =  '$id'";
        
                $result2 = mysqli_query($con, $sql2) ;


        }else{             
                   $sql3 = "UPDATE article_type SET at_status = '1' WHERE at_id =  '$id'";
        
                $result3 = mysqli_query($con, $sql3) ;
        } 
        




?>