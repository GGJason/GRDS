<?php
	$time = time();
	$target_dir = "uploads/";


	$file_name=$time . basename($_FILES["fileToUpload"]["name"]);
	$info = pathinfo($target_file);
	$FileType = $info['extension'];

	$target_file = $target_dir . $time . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;


	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		echo "Sorry, your file was not uploaded.";

	// if everything is ok, try to upload file
	} else {
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
		{
		    echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded."."\n".$FileType." Type";

				$link=mysqli_connect("localhost","bgbim","bgbimdb") or die ("無法開啟Mysql資料庫連結"); //建立mysql資料庫連結

				mysqli_select_db($link, "bgbim"); //選擇資料庫bgbim

				$sql = "INSERT INTO Files(time,filename,location) VALUES('".$time."','".$file_name."','".$target_dir."');" ; //在test資料表中選擇所有欄位
				//mysqli_query($link, 'SET CHARACTER SET utf8');	// 送出Big5編碼的MySQL指令

				//mysqli_query($link,  "SET collation_connection = 'utf8_general_ci'");

				$result = mysqli_query($link,$sql); // 執行SQL查詢


		} 
		else 
		{
		    echo "Sorry, there was an error uploading your file.";
		}
	}
?>
