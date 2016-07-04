<?php
//Data,		,xiData/
	include("csv.php");
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

			$file=fopen($fileName,"r");
			$writeFile=fopen($save,"w+");
//			echo fgetcsv($file);
			$times=0;
			while (($read = fgetcsv($file)) !== FALSE) {
//				if($read[0]=="")continue;
//				echo "run<br>";
				if($type=="Weather"){
					$day = explode("/",$read[0]);
					$tim = explode(":",$read[1]);	
					if(count($day)==3)$date = $day[2].$day[1].$day[0].$tim[0].$tim[1].$tim[2];
//					echo $date."<br>";
				}
				else{ 
					$time= explode(" ",$read[0]);				
					$day = explode("/",$time[0]);
					$tim = explode(":",$time[1]);
					if(count($day)==3)$date = $day[2].$day[1].$day[0].$tim[0].$tim[1]."00";
				}
				if($times==1)$min=$date;				
				else if($date<$min)$min=$date;
				if($date>$max)$max=$date;
				$write=$date;
				for(($i=(($type=="Weather")?2:1));$i<count($read);$i++)$write =$write.",".$read[$i];
				$write = $write."\n";
				fwrite($writeFile,$write);
				$times++;
			}
			fclose($file);
			fclose($writeFile);
			fwrite($table,$timestamp.",".$min.",".$max.",".$type.",".getDataNum("./xiData/table.csv",$type).",".getDataZIndex($table,$min,$max,$type)."\n");
//			fwrite($table,);
	}
?>
