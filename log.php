<?php
function AutoLogger($logType,$action){
	if(!(is_dir("./log/")))mkdir("log",0777);
	$timestamp = round(microtime(true) * 1000);
	$logFile = fopen("./log/".$logType.".log", "a+");
	$log = $timestamp."\t".$action."\n";
	fwrite($logFile, $log);
	fclose($logFile);
	
	$Date = date_create();
	$interval=date_format($Date,"ym");
	$totalLog = fopen("./log/".$interval.".System.log", "a+");
	$log = $timestamp."\t".$action."\n";
	fwrite($totalLog, $log);
	fclose($totalLog);
}
?>
