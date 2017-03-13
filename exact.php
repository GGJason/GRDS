<?php
	require_once("log.php");
	$data = array();
	array_push($data,@$_GET["W"]);
	array_push($data,@$_GET["GA"]);
	array_push($data,@$_GET["GB"]);
	array_push($data,@$_GET["GC"]);
	array_push($data,@$_GET["M"]);
	$start = str_replace("-","",$_GET["startDate"]).str_replace(":","",$_POST["startTime"])."00";
	$end = str_replace("-","",$_GET["endDate"]).str_replace(":","",$_POST["endTime"])."00";
//	echo $start." ".$end."<br>";
	if(isset($_GET["download"])){	
//		echo "Download<br>";	
		require_once("downloadcsv.php");
		download($start,$end,$data);
	}
	elseif(isset($_GET["draw"])){
		echo "Draw<br>";
		require_once("draw.php");
		draw($start,$end,$data);
	}
	else{
		echo "No action<br>";
	}
?>
