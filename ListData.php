<?php

	$fileName = "./xiData/table.csv";
	$nameArray= ["time","start","end","type","number","index"];
	$dataTable = fopen($fileName,"r") or die("No data!!");

	echo "<table style='text-align:center;border:solid'>\n";
	echo "<tr><th>time\t\t</th>\n\t\t<th>start\t\t</th>\n\t\t<th>end\t\t</th>\n\t\t<th>type\t\t</th>\n\t\t<th>number\t\t</th>\n\t\t<th>index\t\t</th>\n\t</tr>";
	while (($read = fgetcsv($dataTable)) !== FALSE) {
		echo "\t<tr>\n";
		foreach($read as $val)
			echo "\t\t<td>".$val."</td>\n";
		echo "\t</tr>\n";
	}
	echo "</table>\n";
//	$data = fread($dataTable,filesize($fileName));
//	echo "<script>var data = ".json_encode($data)."</script>";
	fclose($dataTable);

?>

