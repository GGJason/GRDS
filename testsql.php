<p>

<?php

$link=mysqli_connect("localhost","bgbim","bgbimdb") or die ("無法開啟Mysql資料庫連結"); //建立mysql資料庫連結

mysqli_select_db($link, "bgbim"); //選擇資料庫abc

$sql = "SELECT * FROM Users"; //在test資料表中選擇所有欄位

//mysqli_query($link, 'SET CHARACTER SET utf8');	// 送出Big5編碼的MySQL指令

//mysqli_query($link,  "SET collation_connection = 'utf8_general_ci'");

$result = mysqli_query($link,$sql); // 執行SQL查詢

//$row = mysqli_fetch_assoc($result); //將陣列以欄位名索引

//$row = mysqli_fetch_row($result); //將陣列以數字排列索引

$total_fields=mysqli_num_fields($result); // 取得欄位數

$total_records=mysqli_num_rows($result);  // 取得記錄數

?>

</p>

<table  border="1">

<tr>

<td>id</td>

<td>name</td>

<td>age</td>

</tr>

<?php for ($i=0;$i<$total_records;$i++) {$row = mysqli_fetch_assoc($result); //將陣列以欄位名索引   ?>

<tr>

<td><?php echo $row[id];   ?></td>        <!–印出id欄位的值–>

<td><?php echo $row[name];   ?></td> <!–印出name欄位的值–>

<td><?php echo $row[nick]; ?></td>       <!–印出age欄位的值–>

</tr>

<?php    }   ?>

</table>

