
<?php

	@$csv = $_GET["filename"];
	if($csv!=""){
		echo "<a href='home.html'><button>Back to home</button></a>\n<script src='./js/jquery.min.js'></script>\n<script>\n$(document).ready(function() {\n	$('[data-toggle=\"toggle\"]').change(function(){\n		$(this).parents().next('.hide').toggle();n\	});n\});\n</script>\n<style>\n	table,td,th{border: 1pt solid black}\n	tr{text-align:center;}\n	.hide{display:none;}\n</style>";
		echo "<h1>".basename($csv)."</h1>";
		$date = 20000000;
		if((@$csv = fopen($csv,"r"))!==FALSE){
			$line = 0;
			echo "<table>\n";
			while (($data = fgetcsv($csv, 1000, ","))!==FALSE){
				if($line++ == 0){
					echo "\t<tr>\n";
						foreach($data as $ele)
							echo "\t\t<th>".$ele."</th>\n";
					echo "\t</tr>\n";
				}
				else {if($data[0]>0){
						if(floor($data[0]/1000000) > $date){
							if($date!=20000000) echo "</tbody>";
							$date = floor($data[0]/1000000);
							echo "<tbody><tr><td colspan=".count($data)."><label for='".$date."'>".$date."</label><input type='checkbox' name='".$date."' id='".$date."' data-toggle='toggle'></td></tr></tbody>";
							echo "<tbody class='hide'>\n";
						}
						echo "\t<tr>\n";
							foreach($data as $ele)
								echo "\t\t<td>".$ele."</td>\n";
						echo "\t</tr>\n";		
					}
				}
			}
			echo "</tbody>";
			echo "</table>";
		}
		else echo "<h2>ERROR FILENAME</h2>";
	}
//////
//	Test File Zone

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








