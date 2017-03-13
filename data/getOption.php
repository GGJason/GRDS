<?php
	echo "2016/01/01#00##";
	echo "2016/12/31#24##";

	echo "###";

	echo "2016/01/01#00##";
	echo "2016/12/31#24##";

	echo "###";

	echo "2016/01/01#00##";
	echo "2016/12/31#24##";

	echo "###";

	echo "2016/01/01#00##";
	echo "2016/12/31#24##";

	$fileName = "./xiData/table.csv";
	$nameArray= ["time","start","end","type","number","index"];
	$dataTable = fopen($fileName,"r") or die("No data!!");

	$count = 0;
	while (($read = fgetcsv($dataTable)) !== FALSE) {
		foreach($read as $val){		
			echo "\t\t<td>".$val."</td>\n";
		}
	}

//	$data = fread($dataTable,filesize($fileName));
//	echo "<script>var data = ".json_encode($data)."</script>";
	fclose($dataTable);

?>

