
<?php
	require_once("config.php");
	require_once("log.php");
	
	 // 顯示錯誤是否打開( On=開, Off=關 )
	error_reporting(E_ALL & ~E_NOTICE);
	$link=mysqli_connect($db_host,$db_user,$db_passwd) or die ("無法開啟Mysql資料庫連結"); //建立mysql資料庫連結

	mysqli_select_db($link, $db_name); //選擇資料庫bgbim

	$sql = "SELECT * FROM Users WHERE id = '".$_POST['name']."';" ; //在test資料表中選擇所有欄位
	//mysqli_query($link, 'SET CHARACTER SET utf8');	// 送出Big5編碼的MySQL指令

	//mysqli_query($link,  "SET collation_connection = 'utf8_general_ci'");

	$result = mysqli_query($link,$sql) or die("使用者名稱錯誤"); // 執行SQL查詢

	$row = mysqli_fetch_assoc($result); //將陣列以欄位名索引

	//$row = mysqli_fetch_row($result); //將陣列以數字排列索引

	if (($_POST['passwd']== $row['passwd']) && ($_POST['name']!='')&&($_POST['passwd']!='')) {
		//echo "Success";
		session_start();
		$_SESSION['id']=$row['id'];
		$_SESSION['name']=$row['name'];
		$_SESSION['login']='OK';
		echo "You are ". $_SESSION['nick'];
		AutoLogger("AUTH","User \"".$row["id"]."@".$_SERVER['REMOTE_ADDR']."\" login successed.","auth.php");
		header("Location: home.html");
	}
	else 
	{
		echo "Failed";
		$_SESSION['']='Fail';
		AutoLogger("AUTH","User \"".$row["id"]."@".$_SERVER['REMOTE_ADDR']."\" login failed.","auth.php");
		header("Location: home.html");
	}
 ?>

