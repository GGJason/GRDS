<?php

	require_once("log.php");
	require_once("xiData.php");
//	require_once("session.php");
//	print_r(getData($type,$start,$end));
	function addtime($str,$addT){
		$str+=$addT;
		if(substr($str,-2) == 60){
			$str += 40;
		}
		if(substr($str,-4) == 6000){
			$str += 4000;
		}
		if(substr($str,-6) == 240000){
			$str += 760000;
		}

		if( (fmod(substr($str,4,2),2)=="01" && substr($str,4,2) <= "07") || (fmod(substr($str,4,2),2)==0 && substr($str,4,2) >= 8) ){
			if(substr($str,6) == 32000000){
				$str += 68000000;	
			}
		}
		elseif(substr($str,4,2) == "02" ){

			if(fmod(substr($str,0,4),4) == 0){
				if(!(fmod(substr($str,0,4),100) == 0)){
					if(substr($str,6) == 30000000){
						$str += 70000000;	
					}
				}
				else{
					if(substr($str,6) == 29000000){
						$str += 71000000;	
					}
				}
			}
			else{
				if(substr($str,6) == 29000000){
					$str += 71000000;	
				}
			}
		}
		else{
			if(substr($str,6) == 31000000){
				$str += 69000000;	
			}
		}

		return $str;
	}
	function download($start,$end,$type){
	$time = new DateTime();
	header('Content-type: text/csv');
	header('Content-Disposition: attachment; filename="'.$time->format("Y-m-d_H:i:s").'-download.csv"');
$Name["Weather"] = array(
	1=> "Ave AirTemp (degC)",	
	2=> "Ave Humidity (%)",	
	3=> "Min WndSpd (m/s)",	
	4=> "Ave WndSpd (m/s)",	
	5=> "Max WndSpd (m/s)",	
	6=> "Ave WndDir (deg)",	
	7=> "Ave Sigma (deg)",	
	8=> "Total Rain (mm)",	
	9=> "Ave GSR (w/m鐃�",	
	10=> "Min Battery (V)",
	11=> "Ave Battery (V)",
	12=> "Max Battery (V)",
	13=> "Ave DeltaT (degC)");

$Name["Part 1"] = array(
	1=> "BT4 lower(AVG) (degC)",
	2=> "Internal Battery(RAW) (mV )	",
	3=> "External Supply(RAW) (mV )",
	4=> "AT4 lower(AVG) (degC )	",
	5=> "CT4 lower(AVG) (degC )	",
	6=> "AT2 upper(AVG) (degC )");

$Name["Part 2"] = array(
	1=> "BS2 Soil Moisture(RAW) (mV)",
	2=> "Batter(RAW) (V )	",
	3=> "Temperature(RAW) (degC )	",
	4=> "AS4 Soil Moisture(RAW) (mV )",
	5=> "AS2 Soil Moisture(RAW) (mV )",
	6=> "BS4 Soil Moisture(RAW) (mV )",
	7=> "CS2 Soil Moisture(RAW) (mV )",
	8=> "CS4 Soil Moisture(RAW) (mV )",
	9=> "Flow A(TOT) (l )",
	10=> "Flow Total A(RAW) (l )	",
	11=> "Flow B(TOT) (l )	",
	12=> "Flow Total B(RAW) (l )	",
	13=> "Flow C(TOT) (l )",
	14=> "Flow Total C(RAW) (l )	",
	15=> "CT2 upper(RAW) (mV )	",	  
	16=> "CT2 Upper Temperature (Deg C )	",
	17=> "BT2 upper(RAW) (mV )",			
	18=> "BT2 Upper Temperature (Deg C )	");

		//          W     GA    GB    GC    M
		$typeArr=[false,false,false,false,false];
		//           W     1     2
		$tableArr=[false,false,false];
		$typeIn["Weather"] = array();
		$typeIn["Part 1"] = array();
		$typeIn["Part 2"] = array();
//		print_r( $type);
		for($i = 0 ; $i < 5 ; $i++){
			if(count($type[$i])!=0){
				$typeArr[$i]=true;
				switch ($i){
					case 0:
						$tableArr[0]=true;
						foreach($type[0] as $ele)
							array_push($typeIn["Weather"],$ele);
						break;	
					case 1:
						$tableArr[1]=true;
						$tableArr[2]=true;
						foreach($type[0] as $ele){
							if($ele==0||$ele==1)array_push($typeIn["Part 1"],$ele);
							else array_push($typeIn["Part 2"],$ele);
						}
						break;
					case 2:
						$tableArr[1]=true;
						$tableArr[2]=true;
						foreach($type[0] as $ele){
							if($ele==1)array_push($typeIn["Part 1"],$ele);
							else array_push($typeIn["Part 2"],$ele);
						}
						break;
					case 3:
						$tableArr[1]=true;
						$tableArr[2]=true;
						foreach($type[0] as $ele){
							if($ele==1)array_push($typeIn["Part 1"],$ele);
							else array_push($typeIn["Part 2"],$ele);
						}
						break;
					case 4: 
						$tableArr[1]=true;
						$tableArr[2]=true;
						foreach($type[0] as $ele){
							if($ele==1||$ele==2)array_push($typeIn["Part 1"],$ele);
							else array_push($typeIn["Part 2"],$ele);
						}
						break;	
				}			
			}
			
		}
		if($tableArr[0]) $weather = getData("Weather",$start,$end);
		if($tableArr[1]) $part1 = getData("Part 1",$start,$end);
		if($tableArr[2]) $part2 = getData("Part 2",$start,$end);
		$export = array();
		for($i = $start ; $i <= $end ; $i = addtime($i,500))
		{
			
			$line = array();
			if(isset($weather)){
				foreach($typeIn["Weather"] as $ele)
					@array_push($line,$weather[$i][$ele]);
			}
			if(isset($part1)){
				foreach($typeIn["Part 1"] as $ele)
					@array_push($line,$part1[$i][$ele]);
			}
			if(isset($part2)){
				foreach($typeIn["Part 2"] as $ele)
					@array_push($line,$part2[$i][$ele]);
			}
			$export[$i] = $line;
		}
		$title = array();
		if(isset($weather)){
			foreach($typeIn["Weather"] as $ele)
				@array_push($title,$Name["Weather"][$ele]);
		}
		if(isset($part1)){
			foreach($typeIn["Part 1"] as $ele)
				@array_push($title,$Name["Part 1"][$ele]);
		}
		if(isset($part2)){
			foreach($typeIn["Part 2"] as $ele)
				@array_push($title,$Name["Part 2"][$ele]);
		}
//		$writefile = fopen("data.csv","w+");
		$count = 0;
		echo ("Date Time");
		foreach($title as $ele)
			echo (",".$ele);
		echo ("\n");
		foreach($export as $time => $line){
			if(count($line) > 0){
				$count = 0;
				echo (parsetime($time));
				foreach($line as $ele)
					echo (",".$ele);
				echo ("\n");
			}
		}			
//		fclose($writefile);
	}
	function parsetime($str){
		return substr($str,0,4)."-".substr($str,4,2)."-".substr($str,6,2)." ".substr($str,8,2).":".substr($str,10,2).":".substr($str,12,2);
	}

?>
