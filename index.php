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
		<script type="text/javascript" src="d3.js"></script>
    <style>
    .axis {
        font-family: arial;
        font-size:0.6em;
    }
    path {
        fill:none;
        stroke:black;
        stroke-width:2px;
    }
    .tick {
        fill:none;
        stroke:black;
    }
    circle{
        stroke:black;
        stroke-width:0.5px;
    }
    circle.times_square{
        fill:DeepPink;
    }
    circle.grand_central{
        fill:MediumSeaGreen;
    }
    path.times_square{
        stroke:DeepPink;
    }
    path.grand_central{
        stroke:MediumSeaGreen;
    }
    
    
    
    </style>
    




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
					</br>
					<form id="timeForm" class="secure">
						Starting Time:<br>
						<select id="startH"></select>
						<select id="startD"></select>
						<select id="startM"></select><br>
						Endding Time:<br>
						<select id="endH"></select>
						<select id="endD"></select>
						<select id="endM"></select><br>
						<input type="button" id="download" value="Download" formaction="download.php" ></input>
						<input type="button" id="draw" value="Draw" onclick="inputData()"> </input><br>
					</form>
					</br>

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
					<script src="//d3js.org/d3.v3.min.js"></script>
					<script>
				    function draw(data) {
				        "use strict";
				        var margin = 50,
				            width = 700 - margin,
				            height = 300 - margin;
				        
				        var count_extent = d3.extent(
				            data.times_square.concat(data.grand_central),
				            function(d){return d.count}
				        );

				        var time_extent = d3.extent(
				            data.times_square.concat(data.grand_central),
				            function(d){return d.time}
				        )
				        
				        var count_scale = d3.scale.linear()
				            .domain(count_extent)
				            .range([height, margin]);
				        
				        var time_scale = d3.time.scale()
				            .domain(time_extent)
				            .range([margin, width])
				        
				        var time_axis = d3.svg.axis()
				            .scale(time_scale)
				        
				        var count_axis = d3.svg.axis()
				            .scale(count_scale)
				            .orient("left")
				        
				        var line = d3.svg.line()
				            .x(function(d){return time_scale(d.time)})
				            .y(function(d){return count_scale(d.count)})
				            .interpolate("linear")
				                    
				        d3.select("#main") 
				          .append("svg")
				            .attr("class","chart") 
				            .attr("width", width+margin)
				            .attr("height", height+margin)
				        
				        d3.select('svg')
				          .append('path')
				            .attr('d', line(data.times_square))
				            .attr('class', 'times_square')
				        
				        d3.select('svg')
				          .append('path')
				            .attr('d', line(data.grand_central))
				            .attr('class', 'grand_central')
				        
				        
				        d3.select("svg")
				          .selectAll("circle.times_square")
				          .data(data.times_square)
				          .enter()
				          .append("circle")
				            .attr("class", "times_square")

				        d3.select("svg")
				          .selectAll("circle.grand_central")
				          .data(data.grand_central)
				          .enter()
				          .append("circle")
				            .attr("class", "grand_central")
				    
				        d3.selectAll("circle")
				            .attr("cy", function(d){return count_scale(d.count);})
				            .attr("cx", function(d){return time_scale(d.time);})
				            .attr("r", 3)
				            
				        d3.select("svg")
				          .append("g")
				          .attr("class", "x axis")
				          .attr("transform", "translate(0," + height + ")")
				          .call(time_axis);
				         
				        d3.select("svg")
				          .append("g")
				          .attr("class", "y axis")
				          .attr("transform", "translate(" + margin + ",0)")
				          .call(count_axis);
				    
				      d3.select('.y.axis')
				          .append('text')
				          .text('mean number of turnstile revolutions')
				          .attr('transform', "rotate (90, " + -margin + ", 0)")
				          .attr('x', 20)
				          .attr('y', 0)
				                    
				      d3.select('.x.axis')
				        .append('text')
				          .text('time')
				          .attr('x', function(){return (width / 1.6) - margin})
				          .attr('y', margin/1.5)
				    
				    }
				    function inputData(){
				    	d3.json('http://140.112.12.21/vie2015/data/turnstile_traffic.json', draw);
					}
				    </script>
				    <!--
					<script>
        			
        			//draw();
    				</script>-->



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