<?php

	if(!(is_dir("./uploads/")))mkdir("uploads",0777);
	$time = time();
	$target_dir = "uploads/";
	$file_name=$time . basename($_FILES["fileToUpload"]["name"]);
	$info = pathinfo($target_file);
	$FileType = $info['extension'];

	$target_file = $target_dir . $time . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;








?>
