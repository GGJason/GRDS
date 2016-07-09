<?php
	

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
//	File Upload Stage
// 	Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
    	echo "Sorry, your file was not uploaded.";
// 	if everything is ok, try to upload file
	} 

	else {
//		Issue: 無法中文檔名
//		iconv("UTF-8", "big5", $target_file )
    	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        	echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";

//////
// 			Check File Format and Handling. 
			if($FileType == "jpg" || $FileType == "png" || $FileType == "jpeg" || $FileType == "gif" ) 				{
//			Image: jpg, png, jpeg, gif	
			echo "<script>window.location.replace('image.html');</script>";

			}

			else if($FileType == "csv" || $FileType == "tsv"||$FileType == "CSV" || $FileType == "TSV"){
//				data: csv,tsv
					echo "<script>window.location.replace('csv.html');</script>";

			}

			else if($FileType == "doc" ||$FileType == "docx" || $FileType == "xls"||$FileType == "xlsx" || $FileType == "txt")
			{
//			Document: doc,docx,xls,xlsx,txt
				echo "<script>window.location.replace('doc.html');</script>";

			}

			else{
//			Else
				echo "<script>window.location.replace('other.html');</script>";

			}
//
//////

    	} 
		else {
        	echo "Sorry, there was an error uploading your file.";
			echo "<script>window.location.replace('wrong.html');</script>";
    	}
	}
//
//////


?>
