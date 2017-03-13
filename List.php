<?php
	
	function showdir ($dir,$level){
		echo "<h".$level.">".iconv("BIG5", "UTF-8",basename($dir))."</h".$level.">";
		echo "<ul>";
		$arr = scandir($dir);
		foreach($arr as $sub){
			if($sub[0]!='.'){
				if(is_dir($dir."/".$sub))
					showdir($dir."/".$sub,$level+1);
				else{
					$showdir = @iconv("BIG5", "UTF-8",$dir);
					$showsub = @iconv("BIG5", "UTF-8",$sub);	
					if(substr($showsub,-3,3)!="php")
						echo "<li> <a href = \"csv.php?filename=".$showdir."/".$showsub."\">".$showsub."</a> </li>";
				}
			}
		}
		echo "</ul>";
	}
	$found = false;
	function search ($dir,$search){
		echo "<ul>";
		$arr = scandir($dir);
		foreach($arr as $sub){
			if($sub[0]!='.'){
				if(is_dir($dir."/".$sub))
					search($dir."/".$sub,$search);
				else{
					$showdir = @iconv("BIG5", "UTF-8",$dir);
					$showsub = @iconv("BIG5", "UTF-8",$sub);	
					if(strpos($showsub, $search) !== false)
						echo "<li> <a href = \"".$showdir."/".$showsub."\">".$showsub."</a> </li>";
				}
			}
		}
		echo "</ul>";
	}

	

if (strpos($a, 'are') !== false) {
    echo 'true';
}

	if(isset($_GET["search"])) search(".",$_GET["search"]);
	else showdir("./xiData",0);
?>
