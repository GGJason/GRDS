<?php

//////
//
//	This is a auto logger for GRDS.
//	The logger will record the action
//	
//	Three Parameters
//		1. Log Type (logType): The type of the log
//		2. Log Action (action): The action of the log
//		3. Log Sender (logger): The file/function who log the action
//
//////

function AutoLogger($logType,$action,$logger){
	if(!(is_dir("./log/")))mkdir("log",0777);
	$timestamp = "UTC+8 ".date("Ymd_h:i:s")."\t".round(microtime(true) * 1000);
	$logFile = fopen("./log/".$logType.".log", "a+");
	$log = $timestamp."\t : ".$logger."\t : ".$action."\n";
	fwrite($logFile, $log);
	fclose($logFile);
	
	$Date = date_create();
	$interval=date_format($Date,"ym");
	$totalLog = fopen("./log/".$interval.".System.log", "a+");
	fwrite($totalLog, $log);
	fclose($totalLog);
}
?>
