<?php
ini_set("max_execution_time","200");
include("../class/pDraw.class.php");
include("../class/pImage.class.php");
include("../class/pData.class.php");

$fileName = "data.csv";

$myData = new pData();
$width = 1600;
$height = 900;
$myData->importFromCSV($fileName,array("SkipColumns"=>array(0)));

//print_r($myData->Data);

$myPicture = new pImage($width,$height,$myData);
$myPicture->setFontProperties(array("FontName"=>"../fonts/Forgotte.ttf","FontSize"=>11));


$myPicture->setGraphArea(60,40,$width-30,$height-40);
$myPicture->drawLegend($width-200,100,$Format="");
$myPicture->drawScale(array("Mode"=> SCALE_MODE_ADDALL_START0,"MinDivHeight"=>2,"Factors"=>array(100),"LabelSkip"=>49));
$myPicture->drawSplineChart();
$myPicture->Stroke();

?>
