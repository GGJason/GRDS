<?php
//Data,		,xiData/
	if(@$_GET["max"]=="true"){
		 getMaxDate(TRUE);
		 exit(-1);
	}
	elseif(@$_GET["min"]=="true"){ 
		getMinDate(TRUE);
		 exit(-1);
	}

	require_once("csv.php");
	require_once("log.php");

	
	function data($fileName){

		if(!(is_dir("./xiData/")))mkdir("./xiData/",0771);
		$file=fopen($fileName,"r");
		$table=fopen("./xiData/table.csv","a+");


		if(stripos($fileName,"weather")){
			echo "<br>Weather Data<br>";
			insert($fileName,$table,"Weather");
		}
		else if(stripos($fileName,"Part 1")){
			echo "Measure Data Part1<br>";
			insert($fileName,$table,"Part 1");
		}
		else if(stripos($fileName,"Part 2")){
			echo "Measure Data Part2<br>";
			insert($fileName,$table,"Part 2");
		}
		else{
			
		}

	}
	
	function insert($fileName,$table,$type){
			$timestamp = "UTC+8 ".date("Ymd_h:i:s");
			$save="./xiData/".$type."_".getDataNum("./xiData/table.csv",$type).".csv";
//			copy($fileName,$save);
			$min="20000101000000";
			$max="20000101000000";
			$title="";
			$file=fopen($fileName,"r");
			$writeFile=fopen($save,"w+");
//			echo fgetcsv($file);
			$times=0;
		    $_file_write = array();
			while (($read = fgetcsv($file)) !== FALSE) {
				if($type=="Weather"){
					$day = explode("/",$read[0]);
					$tim = explode(":",$read[1]);	
					if(count($day)==3)$date = str_pad($day[2], 2, '0', STR_PAD_LEFT).str_pad($day[1], 2, '0', STR_PAD_LEFT).str_pad($day[0], 2, '0', STR_PAD_LEFT).str_pad($tim[0], 2, '0', STR_PAD_LEFT).str_pad($tim[1], 2, '0', STR_PAD_LEFT).str_pad($tim[2], 2, '0', STR_PAD_LEFT);
//					echo $date."<br>";
				}
				else{ 
					$time= explode(" ",$read[0]);				
					$day = explode("/",$time[0]);
					$tim = explode(":",$time[1]);
					if(count($day)==3)$date = str_pad($day[2], 2, '0', STR_PAD_LEFT).str_pad($day[1], 2, '0', STR_PAD_LEFT).str_pad($day[0], 2, '0', STR_PAD_LEFT).str_pad($tim[0], 2, '0', STR_PAD_LEFT).str_pad($tim[1], 2, '0', STR_PAD_LEFT)."00";
				}
				if(@$time[2]=="PM"){
					$date+=120000;
//				echo substr($date,-6)."==>";
					if(substr($date,-6)>=240000)$date-=120000;
				}
				else{
					if(substr($date,-6)>=120000)$date-=120000;
				}
//				ec
				if($times==1)$min=$date;				
				else if($date<$min)$min=$date;
				if($date>$max)$max=$date;
//				echo substr($date,-6)."<br>";
				$write=$date;
				for(($i=(($type=="Weather")?2:1));$i<count($read);$i++)$write =$write.",".$read[$i];
				if($type=="Weather")array_push($_file_write,$write);
				else array_unshift($_file_write,$write);
				if($times++==0)$title=$write;
			}
			if(!($type=="Weather"))
				array_unshift($_file_write,$title);



			foreach($_file_write as $line)
				fwrite($writeFile,$line."\n");

			saveData($type,$_file_write);
			fclose($file);
			fclose($writeFile);
			fwrite($table,$timestamp.",".$min.",".$max.",".$type.",".getDataNum("./xiData/table.csv",$type).",".getDataZIndex($table,$min,$max,$type)."\n");
//			fwrite($table,);


			header("Location: csv.php?filename=".$save);
	}



	function saveData($type,$inArray){
		$datafile = fopen("./xiData/".$type."_data.csv","r");
		$inTableArr = array();
//		echo fgetcsv($datafile);
		$writeArray = array();
		foreach ($inArray as $ele){
			$exp = explode(",",$ele);
			array_push($writeArray,$exp);
		}			
		while (($read = fgetcsv($datafile)) !== FALSE) {
			$inTableArr[$read[0]] = $read; 
		}
		fclose($datafile);
//		print_r($writeArray);
		foreach($writeArray as $row){
//			echo $row[0]." ==> ".array_key_exists($row[0],$inTableArr)."<br>";
			if(@$inTableArr[$row[0]][count($row)-1] < getDataNum("./xiData/table.csv",$type)){
					array_push($row,getDataNum("./xiData/table.csv",$type));
					$inTableArr[$row[0]] = $row;					
			}
			else
				$inTableArr[$row[0]] = $row;
		}
//		print_r($inTableArr);
//		echo count($inTableArr);

		ksort($inTableArr);

		$datafile = fopen("./xiData/".$type."_data.csv","w+");
		foreach($inTableArr as $line){
			$write = "";
			$count = 0;
			foreach($line as $ele){
				if($count++ != 0) $write.=",";
				$write .= $ele;
			}
			fwrite($datafile,$write."\n");
		}
		fclose($datafile);
//		echo "<br><br><br><br>";
	}
	function getData($type,$start,$end){
		if((@$file = fopen("./xiData/".$type."_data.csv","r"))!==FALSE){
			$arr = array();
			while(($read = fgetcsv($file))!==FALSE){
				if($start <= $read[0] && $end >= $read[0] )
					$arr[$read[0]] = $read ;
			}
			if(count($arr)!=0)return $arr;
			else return FALSE;
		}
		else{
			echo "No ".$type." type data";
		}
	}
	function getMaxDate($e=FALSE){
		$file = fopen("./xiData/table.csv","r");
		$max = 20130101000000;

		while(($read = fgetcsv($file))!==FALSE)
			if($read[2] > $max) $max = $read[2];
		if($e) echo $max;
		fclose($file);
		return $max;
	}
	function getMinDate($e=FALSE){
		$file = fopen("./xiData/table.csv","r");
		$min = 30000101000000;

		while(($read = fgetcsv($file))!==FALSE)
			if($read[1] < $min) $min = $read[1];
		if($e) echo $min;
		fclose($file);
		return $min;
	}
?>
