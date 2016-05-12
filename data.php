<?php
/*
    $username = "bgbim"; 
    $password = "bgbimdb";   
    $host = "localhost";
    $database="homedb";
    
    $server = mysql_connect($host, $username, $password);
    $connection = mysql_select_db($database, $server);
*/
    $link=mysqli_connect("localhost","bgbim","bgbimdb") or die ("無法開啟Mysql資料庫連結"); //建立mysql資料庫連結
    mysqli_select_db($link, "bgbim"); //選擇資料庫bgbim

    $myquery1 = "
SELECT  'date', 'time'";
    $checkOutput = false;
    for($i = 0; $i != 13; $i++){
        $loopstr = 'Weather_Station$'.$i;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (!empty($_POST[$loopstr])) {
                $myquery1 .= $_POST[$loopstr];
                $checkOutput = true;
            }
        }
    }
    if($checkOutput == false)
        $myquery1 = '';
    $myquery1 .= 'FROM Weather_Station;';
    

    $myquery2 = "
SELECT  'date', 'time'";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $checkOutput = false;
        if (!empty($_POST['Green_Roof_A$0'])) {
            $myquery2 .= $_POST['Green_Roof_A$0'];
            $checkOutput = true;
        }
        if (!empty($_POST['Green_Roof_A$1'])) {
            $myquery2 .= $_POST['Green_Roof_A$1'];
            $checkOutput = true;
        }
        if (!empty($_POST['Green_Roof_B$0'])) {
            $myquery2 .= $_POST['Green_Roof_B$0'];
            $checkOutput = true;
        }
        if (!empty($_POST['Green_Roof_C$0'])) {
            $myquery2 .= $_POST['Green_Roof_C$0'];
            $checkOutput = true;
        }
        if (!empty($_POST['Measure_Instrument$0'])) {
            $myquery2 .= $_POST['Measure_Instrument$0'];
            $checkOutput = true;
        }
        if (!empty($_POST['Measure_Instrument$1'])) {
            $myquery2 .= $_POST['Measure_Instrument$1'];
            $checkOutput = true;
        }

        if($checkOutput == false)
            $myquery2 = '';
        $myquery2 .= 'FROM Part_1;';
    }
    

    $myquery3 = "
SELECT  'date', 'time'";

    $checkOutput = false;
    for($i = 2; $i != 6; $i++){
        $loopstr = 'Green_Roof_A$'.$i;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (!empty($_POST[$loopstr])) {
                $myquery3 .= $_POST[$loopstr];
                $checkOutput = true;
            }
        }
    }
    for($i = 1; $i != 6; $i++){
        $loopstr = 'Green_Roof_B$'.$i;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (!empty($_POST[$loopstr])) {
                $myquery3 .= $_POST[$loopstr];
                $checkOutput = true;
            }
        }
    }
    for($i = 1; $i != 6; $i++){
        $loopstr = 'Green_Roof_C$'.$i;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (!empty($_POST[$loopstr])) {
                $myquery3 .= $_POST[$loopstr];
                $checkOutput = true;
            }
        }
    }
    for($i = 2; $i != 4; $i++){
        $loopstr = 'Measure_Instrument$'.$i;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (!empty($_POST[$loopstr])) {
                $myquery .= $_POST[$loopstr];
                $checkOutput = true;
            }
        }
    }
    if($checkOutput == false)
        $myquery3 = '';
    $myquery3 .= 'FROM Part_2;';

    $myquery1 .= $myquery2 . $myquery3;
    $query = mysql_query($myquery1);
    
    if ( ! $query ) {
        echo mysql_error();
        die;
    }
    
    $data = array();
    
    for ($x = 0; $x < mysql_num_rows($query); $x++) {
        $data[] = mysql_fetch_assoc($query);
    }
    
    echo json_encode($data);     
     
    mysql_close($server);
?>