<!DOCTYPE html>
<!--For PC & Desktop Version-->
<html>
	<head>
		<title>BGBIM - Green Roof Data Station</title>
<!--		<script src="./path/to/dropzone.js"></script>-->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="css/index.css">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<?php session_start();
			if($_SESSION['login']=='OK');
			else echo "<style>.secure{visibility:hidden;}</style>"; 		
		?>
	</head>
	<body>
		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container">
				<div class="navbar-header"><button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button> <a class="navbar-brand" href="https://kkbruce.tw/bs3/Examples/starter-template#">Blue Green BIM</a></div>
				<div id="navbar" class="collapse navbar-collapse">
					<ul class="nav navbar-nav">
						<li class="active"><a href="https://kkbruce.tw/bs3/Examples/starter-template#">Home</a></li>
						<li><a href="https://kkbruce.tw/bs3/Examples/starter-template#about">About</a></li>
						<li><a href="https://kkbruce.tw/bs3/Examples/starter-template#contact">Contact</a></li>
						
					</ul>
					<?php 
						if($_SESSION['login']=='OK') {
						echo "<form action='logout.php' class='log'><button>Logout</button></form></li>";
						}
						else{
							echo "<form action='auth.php' method='post' class='log'>";
								echo "<input type='text' name='name' id='name' value='username'></input>";
								echo "<input type='password' name='passwd' id='passwd' value='password'></input>";
								echo "<input type='submit' id='authsubmit' name = 'submit'></input>";
							echo "</form>";
						}
				?>
				</div>

			</div>
		</nav>
		
		<div class="container" id="interface">
			<div class="starter-template">
				<div id="menu">
					
					
					<br>
					<form action="upload.php" method="post" enctype="multipart/form-data" id="inputForm" class="secure">
						<p>Select image to upload:</p>
						<input type="file" name="fileToUpload"  id="fileToUpload"style="width:50%;float:left"></input><br>
						<input type="submit" value="Upload Image" name="submit" class="btn btn-sm btn-primary" style="float:left"></input><br>
					</form>
					<br><br>
					<form id="timeForm" class="secure">
						Starting Time:<br>
						<select id="startH"></select>
						<select id="startD"></select>
						<select id="startM"></select><br>
						Endding Time:<br>
						<select id="endH"></select>
						<select id="endD"></select>
						<select id="endM"></select><br>
						<input type="button" id="download" value="Download" class="btn btn-primary" ></input>
						<input type="button" id="draw" value="Draw" class="btn btn-primary"> </input><br>
					</form>
					<form id="selectForm" class="secure">
						<input type="checkbox">Greenroof Data</input><br>
						<input type="checkbox">Greenroof A</input><br>
						<input type="checkbox">Greenroof B</input><br>
						<input type="checkbox">Greenroof C</input><br>
						<input type="checkbox"></input>
					</form>
				</div>
				<div id="main">
					<h3>Green Roof Data Station</h3>
					Welcome To Blue Green BIM.
					This is the data station for greenroof experiment
					<?php 
						if($_SESSION['login']=='OK') {
							echo "Welcome to GRDS of BGBIM TW,". $_SESSION['nick'];
							
					}?>
				</div>
			</div>
		</div>
		<footer >
					Start from 2015<br>
					Designed by Kyra<br>
					Developed by Kyra and GGJason of BGBIM<br>
					Powered by <a href="http://getbootstrap.com/">Bootstrap</a>
		</footer> 
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>
