
<?php
	$link=mysqli_connect("localhost","bgbim","bgbimdb") or die ("無法開啟Mysql資料庫連結"); //建立mysql資料庫連結

	mysqli_select_db($link, "bgbim"); //選擇資料庫bgbim

	$sql = "SELECT * FROM Users WHERE name = '".$_POST['name']."';" ; //在test資料表中選擇所有欄位
	//mysqli_query($link, 'SET CHARACTER SET utf8');	// 送出Big5編碼的MySQL指令

	//mysqli_query($link,  "SET collation_connection = 'utf8_general_ci'");

	$result = mysqli_query($link,$sql); // 執行SQL查詢

	$row = mysqli_fetch_assoc($result); //將陣列以欄位名索引

	//$row = mysqli_fetch_row($result); //將陣列以數字排列索引

	if ($_POST['passwd']== $row['passwd']) {
		echo "Success";
		echo "You are ". $row($result)['nick'];
	}
	else echo "Failed";
 ?>

