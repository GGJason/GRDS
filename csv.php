<?php

//////
//	Test File Zone
	$testFile1 = "./tmpData/2. MeasureData_20140901-20140930_Part 2.csv";
	$testFile2 = "./tmpData/4. Green Roof Property_Example for database.docx";

	handleCSV($testFile1);
	handleCSV($testFile2);
//
//////

	function handleCSV($csvFile){

		if(pathinfo($csvFile,PATHINFO_EXTENSION)!="csv")
		{
			AutoLogger("ERROR","The File ".$csvFile."is not a CSV File","csv.php/handleCSV()");
			return null;
		}
		
		if(($handle = fopen($csvFile,"r"))!==FALSE){
// 		Check if the file is ok

			while (($read = fgetcsv($handle,0,",",'"',"\0")) !== FALSE) {
				


////	For Checking Data
//				for($i=0 ; $i < count($read);$i++) echo $read[$i]."\t";
//				echo "<br>";
			}		
		}
		else{
			AutoLogger("ERROR","Cannot open the file.","csv.php/handleCSV()");
			return null;
		}





		return;
	}

	function findTable($schemaName){
	}
	function getDataNum($fileName,$table){
		$file = fopen($fileName,"r");
		$max=0;
		while (($read = fgetcsv($file,0,",",'"',"\0")) !== FALSE) {
////	For Checking Data
			if($read[3]==$table&&$read[4]>=$max)$max=$read[4]+1;
//				echo "<br>";
		}
		fclose($file);		
		return $max;
	}
	function getDataZIndex($table,$startTime,$endTime,$type){
		$index=1;
		while (($read = fgetcsv($table,0,",",'"',"\0")) !== FALSE) {
			echo $read[3]." ";
			if($read[3]==$type){
				if((($read[1]<=$startTime)&&($read[2]<=$startTime))||(($read[1]<=$endTime)&&($read[2]<=$endTime))){
					if($read[5]>=$index)$index=$read[5]+1;
				}
			}
		}		
		return $index;
	}
?>








