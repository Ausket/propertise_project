<?php

//upload.php

if(isset($_POST["img"])) {

 $data = $_POST["img"];
 $path = "../image/p_img/"; 
 $image_array_1 = explode(";", $data);
 $image_array_2 = explode(",", $image_array_1[1]);
 $data = base64_decode($image_array_2[1]);
 $imageName = time() . '.png';
 
 file_put_contents($path . $imageName, $data );
 echo $path .$imageName;



}

?>