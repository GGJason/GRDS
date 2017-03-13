<?php
	require_once("./session.php");
//////
//	Show Error Infomation
//	ini_set("display_errors", "On");
//
//////


//////
//	Include the Functions
	require_once ("log.php");
	require_once ("xiData.php");
//
//////


//////
//	Record Time and Ensure The Folder
//	Upload to "./Uploads/YYMM/" and Set The Auth Mode as 777 (Owned by www-data)
	$time = time();
	$Date = date_create();
	$interval=date_format($Date,"ym");
	if(!(is_dir("./Uploads/")))mkdir("./Uploads/",0771);
	if(!(is_dir("./Uploads/".$interval."/")))mkdir("./Uploads/".$interval."/",0771);
//
//////
	$fileType = pathinfo($target_file,PATHINFO_EXTENSION);
//	Get File Type
//
//////

//////
//	Set the File Upload Directory and The Filename (timestamp_OriginalName))
	$target_dir = "./Uploads/".$interval."/";
	$target_file = $target_dir . $time ."_". basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
//	Set the uploadOk var. to 1 (means Ok)
	$fileType = pathinfo($target_file,PATHINFO_EXTENSION);
//	Get File Type
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
//	File Upload Stage
// 	Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
    	echo "Sorry, your file was not uploaded.";
		AutoLogger("UPLOAD","Fail to Upload ","upload.php/ ");
// 	if everything is ok, try to upload file
	} 

	else {
//		Issue: 無法中文檔名
//		iconv("UTF-8", "big5", $target_file )
    	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        	echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
			AutoLogger("UPLOAD","File ".$fileName." Upload to ".$target_dir,"upload.php/ ");

//////
// 			Check File Format and Handling. 
			if($FileType == "jpg" || $FileType == "png" || $FileType == "jpeg" || $FileType == "gif" ) 				{
//			Image: jpg, png, jpeg, gif
			AutoLogger("FILE","File ".$fileName." is checked to be an image with ".$FileType." extention and be record in history.","upload.php/ ");

			}

			else if($FileType == "csv" || $FileType == "tsv"||$FileType == "CSV" || $FileType == "TSV"){
//				data: csv,tsv
				AutoLogger("FILE","File ".$fileName." is checked to be a data table with ".$FileType." extention and be record in history. Prepare for update to database.","upload.php/ ");
				data($target_file);

			}

			else if($FileType == "doc" ||$FileType == "docx" || $FileType == "xls"||$FileType == "xlsx" || $FileType == "txt")
			{
//			Document: doc,docx,xls,xlsx,txt
			AutoLogger("FILE","File ".$fileName." is checked to be a document with ".$FileType." extention and be record in history.","upload.php/ ");

			}

			else{
//			Else
			AutoLogger("FILE","File ".$fileName." is checked to be a/an ".$FileType." file whose extention is not default and be record in history.","upload.php/ ");

			}
//
//////

    	} 
		else {
        	echo "Sorry, there was an error uploading your file.";
			AutoLogger("UPLOAD","Fail to Upload ","upload.php/ ");
    	}
	}
//
//////

?>
