<?php

//////
//	Show Error Infomation
//	ini_set("display_errors", "On");
//
//////


//////
//	Include the Logger Function
	include ("log.php");
//
//////


//////
//	Record Time and Ensure The Folder
//	Upload to "./Uploads/YYMM/" and Set The Auth Mode as 777 (Owned by www-data)
	$time = time();
	$Date = date_create();
	$interval=date_format($Date,"ym");
	if(!(is_dir("./Uploads/")))mkdir("./Uploads/",0777);
	if(!(is_dir("./Uploads/".$interval."/")))mkdir("./Uploads/".$interval."/",0777);
//
//////


//////
//	Set the File Upload Directory and The Filename (timestamp_OriginalName))
//	Set the uploadOk var. to 1 (means Ok)
	$target_dir = "./Uploads/".$interval."/";
	$target_file = $target_dir . $time ."_". basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
//
//////


//////
//	Get File Basic Infomation
	$fileName=$time . basename($_FILES["fileToUpload"]["name"]);
	$info = pathinfo($target_file);
	$FileType = $info['extension'];
//
//////


//////
//	Check File Type (Not Implement Now(20160622))
//	if(isset($_POST["submit"])) {
//	}
//
//////


//////
// 	Check file size (Not Used Now(20160622))
//	if ($_FILES["fileToUpload"]["size"] > 500000) {
//    	echo "Sorry, your file is too large.";
//    	$uploadOk = 0;
//	}*/
//////


//////
// 	Allow certain file formats (Not Used Now(20160622))
//	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"&& $imageFileType != "gif" ) {
//    	echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
//   	$uploadOk = 0;
//	}*/
//////


//////
//	File Upload Stage
// 	Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
    	echo "Sorry, your file was not uploaded.";
		AutoLogger("UPLOAD","Fail to Upload ");
// 	if everything is ok, try to upload file
	} 

	else {
    	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        	echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
			AutoLogger("UPLOAD","File ".$fileName." Upload to ".$target_dir);
    	} 
		else {
        	echo "Sorry, there was an error uploading your file.";
			AutoLogger("UPLOAD","Fail to Upload ");
    	}
	}
//
//////

?>
