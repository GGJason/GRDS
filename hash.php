<?php
//................................................................//
//
//	Not in use
//
//................................................................//
	$array = ["1","2","3"];
//	makeHashTable("test",$array);
	dataHash("test","2");

	include ("log.php");

	function makeHashTable($hashName,$hashArray){
		if(!(is_dir("./Hash/")))mkdir("./Hash/",0777);
//		Write a new file
		$hashFile = fopen("./Hash/".$hashName.".hash","w+");
		for( $i = 0 ; $i < count($hashArray) ; $i++){
//			echo  hash("md5",$hashArray[$i])."=>".$hashArray[$i]."\n";
			$hashSchema =hash("md5",$hashArray[$i])."\t".$hashArray[$i]."\n";
			fwrite($hashFile,$hashSchema );
			
		}
		fclose($hashFile);

	}

	function dataHash($hashName,$str){

//		Read Hashtable
		if(($handle = fopen("./Hash/".$hashName.".hash","r"))!==FALSE){
			$array = array();			
			while (($read = fgetcsv($handle,0,"\t",'"',"\0")) !== FALSE) $array[$read[0]]=$read[1];

////		Test Array	
//			foreach ($array as $value) echo $value."\t";
//			echo "\n";

	
//		Find Value in Hashtable
			

		}
		else{
			AutoLogger("ERROR","Failed to Open Hashtable ".$hashName,"hash.php/dataHash()");
		}
	}
?>
