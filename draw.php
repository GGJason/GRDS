<?php

	require_once("log.php");
	require_once("xiData.php");
	$start=$_GET["start"];
	$end=$_GET["end"];
	$type=$_GET["type"];
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
			if(isset($weather)){
				foreach($typeIn["Weather"] as $ele){
					if ($i==$start) 
						$export[$ele]=array();
					@array_push($export[$ele],$weather[$i][$ele]);
				}
			}
			if(isset($part1)){
				foreach($typeIn["Part 1"] as $ele)
					if ($i==$start) 
						$export[$ele]=array();
					@array_push($export[$ele],$part1[$i][$ele]);
			}
			if(isset($part2)){
				foreach($typeIn["Part 2"] as $ele)
					if ($i==$start) 
						$export[$ele]=array();
					@array_push($export[$ele],$part2[$i][$ele]);
			}
		}
		include("../class/pDraw.class.php");
		include("../class/pImage.class.php");
		include("../class/pData.class.php");

		$myData = new pData();
		/*foreach($export as $key => $data){
			$myData->addPoints($data,$key);
		}*/
		$myData -> addPoints(array(VOID,3,4,3,5),"A");
		$myData -> addPoints(array(5,2,1,4,3),"B");
		$myData -> addPoints(array(0,2,VOID,2,1),"C");

		$myPicture = new pImage(700,230,$myData);
		$myPicture->setFontProperties(array("FontName"=>"../fonts/Forgotte.ttf","FontSize"=>11));

		$myPicture->setGraphArea(60,40,670,190);
		$myPicture->drawScale();
		$myPicture->drawSplineChart();

		$myPicture->Stroke();


////Weather 
//Ave AirTemp (degC)					W0
//Ave Humidity (%)						W1
//Min WndSpd (m/s)						W2
//Ave WndSpd (m/s)						W3	
//Max WndSpd (m/s)						W4	
//Ave WndDir (deg)						W5	
//Ave Sigma (deg)						W6	
//Total Rain (mm)						W7	
//Ave GSR (w/m鐃�						W8	

//Min Battery (V)						W9	
//Ave Battery (V)						W10	
//Max Battery (V)						W11	
//Ave DeltaT (degC)						W12


////Part1
//BT4 lower(AVG) (degC)					B0
//Internal Battery(RAW) (mV )			M0
//External Supply(RAW) (mV )			M1
//AT4 lower(AVG) (degC )				A0
//CT4 lower(AVG) (degC )				C0
//AT2 upper(AVG) (degC )				A1

////Part2
//BS2 Soil Moisture(RAW) (mV)			B3
//Battery(RAW) (V )						M2
//Temperature(RAW) (degC )				M3
//AS4 Soil Moisture(RAW) (mV )			A2
//AS2 Soil Moisture(RAW) (mV )			A3
//BS4 Soil Moisture(RAW) (mV )			B2
//CS2 Soil Moisture(RAW) (mV )			C2
//CS4 Soil Moisture(RAW) (mV )			C3
//Flow A(TOT) (l )						A4
//Flow Total A(RAW) (l )				A5
//Flow B(TOT) (l )						B4
//Flow Total B(RAW) (l )				B5
//Flow C(TOT) (l )		  				C4
//Flow Total C(RAW) (l )				C5
//CT2 upper(RAW) (mV )		  
//CT2 Upper Temperature (Deg C )		C1	
//BT2 upper(RAW) (mV )					
//BT2 Upper Temperature (Deg C )		B1
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


?>
