<?php
	include("log.php");

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

	function findTable($schemaName){Weather
	switch ($schemaName){
	}


?>
