<?php

	function findArrMin($array,$find){
		$min[$find] = -1;
		foreach($array as $ele){
			if($min[$find] == -1) $min = $ele;
			else if($ele[$find] < $min[$find]) $min = $ele; 
		}
		return $min;
	}
	$start = $_GET["start"];
	$end = $_GET["end"];
	$type["Part 1"]=true;
	$type["Part 2"]=true;
	$type["Weather"]=false;

	$tableFile = fopen("./xiData/table.csv","r");

	$table = array();
	while(($read = fgetcsv($tableFile))!==FALSE){
		$datarow["time"] = $read[0];
		$datarow["start"] = $read[1];
		$datarow["end"] = $read[2];
		$datarow["type"] = $read[3];
		$datarow["number"] = $read[4];
		$datarow["index"] = $read[5];
		array_unshift($table,$datarow);
	}
	echo "<h1>Check Data Table</h1><br>";
	foreach($table as $show)
		echo $show["start"]."\t".$show["end"]."\t".$show["type"]."<br>";
	$shiftorder = array();

	$count = 0;
	foreach($table as $row){
		if(($row["end"] < $start)||($row["start"] > $end)) array_splice($table,$count--,1);
		$count++;			
	}

	$minrow = findArrMin($table,"start");
	$minindex = $minrow["index"];
	$count = 0;
	$prev["Part 1"]=-1;
	$prev["Part 2"]=-1;
	$prev["Weather"]=-1;

	foreach($table as $ele){
		if($prev[$ele["type"]]==-1){
			if(!$type[$ele["type"]])
				array_splice($table,$count--,1);
			else			
				$prev[$ele["type"]]==$count;
		}
		else{
			if(!$type[$ele["type"]])
				array_splice($table,$count--,1);
			else if(($ele["start"] == $minrow["start"])&&($ele["type"] == $minrow["type"])&&($ele["index"] > $minindex)){
				array_splice($table,$prev--,1);
				$count--;
				$prev = $count;
			}		
			else if(($ele["start"] == $minrow["start"])&&($ele["type"] == $minrow["type"])&&($ele["index"] < $minindex))
				array_splice($table,$count--,1);
		}
		$count++;
	}
	echo "<br><h1>Check Data Table</h1><br>";
	if(sizeof($table)==0) echo "Empty Table";
	foreach($table as $show)
		echo $show["start"]."\t".$show["end"]."\t".$show["type"]."<br>";
		
?>
