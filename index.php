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

					<script>
						function changeDisplay(){
							var selection = document.getElementById('chooseTableList');
							/*var formW = document.getElementById('Weather_Station');
							var formA = document.getElementById('Green_Roof_A');
							var formB = document.getElementById('Green_Roof_B');
							var formC = document.getElementById('Green_Roof_C');
							var formM = document.getElementById('Measure_Instrument');*/
							for (var i = 0 ; i != selection.options.length; i++) {
								if(selection.options[i].index == selection.selectedIndex)
									document.getElementById(selection.options[i].text).style.display = "block";
								else{
									document.getElementById(selection.options[i].text).style.display = "none";
								}
							}
						}
					</script>

					<input type="submit" name="Draw_Button" value="Draw" id="Draw_Button" class="myButton" />
					 <select name="chooseTableList" id="chooseTableList" onchange="changeDisplay()">
						<option selected="selected" value="Weather_Station">Weather_Station</option>
						<option value="Green_Roof_A" >Green_Roof_A</option>
						<option value="Green_Roof_B">Green_Roof_B</option>
						<option value="Green_Roof_C">Green_Roof_C</option>
						<option value="Measure_Instrument">Measure_Instrument</option>
						<!-- <option value="Files">Files</option> -->
					</select>
					</br></br>

					<!-- cannot find secure class -->
					<form id="Weather_Station" method = "post" style = "display: none">
						<input id="Weather_Station_0" type="checkbox" name="Weather_Station$0" value="Ave AirTemp (degC)" />Ave AirTemp (degC)</input></br>
						<input id="Weather_Station_1" type="checkbox" name="Weather_Station$1" value="Ave Humidity (%)" />Ave Humidity (%)</input></br>
						<input id="Weather_Station_2" type="checkbox" name="Weather_Station$2" value="Min WndSpd (m/s)" />Min WndSpd (m/s)</input></br>
						<input id="Weather_Station_3" type="checkbox" name="Weather_Station$3" value="Ave WndSpd (m/s)" />Ave WndSpd (m/s)</input></br>
						<input id="Weather_Station_4" type="checkbox" name="Weather_Station$4" value="Max WndSpd (m/s)" />Max WndSpd (m/s)</input></br>
						<input id="Weather_Station_5" type="checkbox" name="Weather_Station$5" value="Ave WndDir (deg)" />Ave WndDir (deg)</input></br>
						<input id="Weather_Station_6" type="checkbox" name="Weather_Station$6" value="Ave Sigma (deg)" />Ave Sigma (deg)</input></br>
						<input id="Weather_Station_7" type="checkbox" name="Weather_Station$7" value="Total Rain (mm)" />Total Rain (mm)</input></br>
						<input id="Weather_Station_8" type="checkbox" name="Weather_Station$8" value="Ave GSR (w/m?" />Ave GSR (w/m?</input></br>
						<input id="Weather_Station_9" type="checkbox" name="Weather_Station$9" value="Min Battery (V)" />Min Battery (V)</input></br>
						<input id="Weather_Station_10" type="checkbox" name="Weather_Station$10" value="Ave Battery (V)" />Ave Battery (V)</input></br>
						<input id="Weather_Station_11" type="checkbox" name="Weather_Station$11" value="Max Battery (V)" />Max Battery (V)</input></br>
						<input id="Weather_Station_12" type="checkbox" name="Weather_Station$12" value="Ave DeltaT (degC)" />Ave DeltaT (degC)</input></br>
					</form>

					<form id="Green_Roof_A" method = "post" style = "display: none">
						<!-- in part1 -->
						<input id="Green_Roof_A_0" type="checkbox" name="Green_Roof_A$0" value="Lower_Temperature" />Lower_Temperature</input></br>
						<input id="Green_Roof_A_1" type="checkbox" name="Green_Roof_A$1" value="Upper_Temperature" />Upper_Temperature</input></br>
						<!-- in part1 end-->
						<input id="Green_Roof_A_2" type="checkbox" name="Green_Roof_A$2" value="Lower_Soil_Moisture" />Lower_Soil_Moisture</input></br>
						<input id="Green_Roof_A_3" type="checkbox" name="Green_Roof_A$3" value="Upper_Soil_Moisture" />Upper_Soil_Moisture</input></br>
						<input id="Green_Roof_A_4" type="checkbox" name="Green_Roof_A$4" value="Flow_Total" />Flow_Total</input></br>
						<input id="Green_Roof_A_5" type="checkbox" name="Green_Roof_A$5" value="Flow_(TOT)" />Flow_(TOT)</input></br>
					</form>

					<form id="Green_Roof_B" method = "post" style = "display: none">
						<!-- in part1 -->
						<input id="Green_Roof_B_0" type="checkbox" name="Green_Roof_B$0" value="Lower_Temperature" />Lower_Temperature</input></br>
						<!-- in part1 end-->
						<input id="Green_Roof_B_1" type="checkbox" name="Green_Roof_B$1" value="Upper_Temperature" />Upper_Temperature</input></br>
						<input id="Green_Roof_B_2" type="checkbox" name="Green_Roof_B$2" value="Lower_Soil_Moisture" />Lower_Soil_Moisture</input></br>
						<input id="Green_Roof_B_3" type="checkbox" name="Green_Roof_B$3" value="Upper_Soil_Moisture" />Upper_Soil_Moisture</input></br>
						<input id="Green_Roof_B_4" type="checkbox" name="Green_Roof_B$4" value="Flow_Total" />Flow_Total</input></br>
						<input id="Green_Roof_B_5" type="checkbox" name="Green_Roof_B$5" value="Flow_(TOT)" />Flow_(TOT)</input></br>
					</form>

					<form id="Green_Roof_C" method = "post" style = "display: none">
						<!-- in part1 -->
						<input id="Green_Roof_C_0" type="checkbox" name="Green_Roof_C$0" value="Lower_Temperature" />Lower_Temperature</input></br>
						<!-- in part1 end-->
						<input id="Green_Roof_C_1" type="checkbox" name="Green_Roof_C$1" value="Upper_Temperature" />Upper_Temperature</input></br>
						<input id="Green_Roof_C_2" type="checkbox" name="Green_Roof_C$2" value="Lower_Soil_Moisture" />Lower_Soil_Moisture</input></br>
						<input id="Green_Roof_C_3" type="checkbox" name="Green_Roof_C$3" value="Upper_Soil_Moisture" />Upper_Soil_Moisture</input></br>
						<input id="Green_Roof_C_4" type="checkbox" name="Green_Roof_C$4" value="Flow_Total" />Flow_Total</input></br>
						<input id="Green_Roof_C_5" type="checkbox" name="Green_Roof_C$5" value="Flow_(TOT)" />Flow_(TOT)</input></br>
					</form>

					<form id="Measure_Instrument" method = "post" style = "display: none">
						<!-- in part1-->
						<input id="Measure_Instrument_0" type="checkbox" name="Measure_Instrument$0" value="Internal_Battery" />Internal_Battery</input></br>
						<input id="Measure_Instrument_1" type="checkbox" name="Measure_Instrument$1" value="External_Supply" />External_Supply</input></br>
						<!-- in part1 end-->
						<input id="Measure_Instrument_2" type="checkbox" name="Measure_Instrument$2" value="Battery" />Battery</input></br>
						<input id="Measure_Instrument_3" type="checkbox" name="Measure_Instrument$3" value="Temperature" />Temperature</input></br>
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
					<style>

					svg {
					  font: 10px sans-serif;
					  shape-rendering: crispEdges;
					}

					rect {
					  fill: #ddd;
					}

					.axis path,
					.axis line {
					  fill: none;
					  stroke: #fff;
					}

					</style>
					<script src="//d3js.org/d3.v3.min.js"></script>
					<script>
					function drawD3(){
					    var margin = {top: 20, right: 20, bottom: 30, left: 40},
					        width = 960 - margin.left - margin.right,
					        height = 500 - margin.top - margin.bottom;

					    var x = d3.scale.linear()
					        .domain([-width / 2, width / 2])
					        .range([0, width]);

					    var y = d3.scale.linear()
					        .domain([-height / 2, height / 2])
					        .range([height, 0]);

					    var xAxis = d3.svg.axis()
					        .scale(x)
					        .orient("bottom")
					        .tickSize(-height);

					    var yAxis = d3.svg.axis()
					        .scale(y)
					        .orient("left")
					        .ticks(5)
					        .tickSize(-width);

					    var zoom = d3.behavior.zoom()
					        .x(x)
					        .y(y)
					        .scaleExtent([1, 32])
					        .on("zoom", zoomed);

					    var svg = d3.select("body").append("svg")
					        .attr("width", width + margin.left + margin.right)
					        .attr("height", height + margin.top + margin.bottom)
					      .append("g")
					        .attr("transform", "translate(" + margin.left + "," + margin.top + ")")
					        .call(zoom);

					    svg.append("rect")
					        .attr("width", width)
					        .attr("height", height);

					    svg.append("g")
					        .attr("class", "x axis")
					        .attr("transform", "translate(0," + height + ")")
					        .call(xAxis);

					    svg.append("g")
					        .attr("class", "y axis")
					        .call(yAxis);

					    function zoomed() {
					      svg.select(".x.axis").call(xAxis);
					      svg.select(".y.axis").call(yAxis);
					    }
					}
					drawD3();
					//d3.json("data.php", drawD3());
					/*
					d3.json("data.php", function(error, data) {
					    data.forEach(function(d) {
					        d.date = parseDate(d.date);
					        d.close = +d.close;
					    });
					*/
					</script>


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