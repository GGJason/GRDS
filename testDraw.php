<?php
	require_once("./lib/pChart.php");
	require_once("./lib/pData.php");


	$MyData = new pData();
	$MyData->importFromCSV("data.csv");
	echo "Yes";
?>
