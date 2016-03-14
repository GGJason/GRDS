<?php
	$target_dir = "uploads/";
	$target_file=target_dir.basename($_FILES["fileToUpload"]["name"]);
	$uploadOK=1;
	$imageFileType=pathinfo($target_file,PAHTINFO_EXTENSION);

	if(isset($_POST["submit"])){
		$check=getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if ($check !== false) {
			echo "File is an image - " . $check["mime"] . ".";
        			$uploadOk = 1;
    			} 
		else {
       			 echo "File is not an image.";
        			$uploadOk = 0;
		}
	}
?>