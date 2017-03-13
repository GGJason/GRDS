<html>
<body>

<style>
form.hide{
	display: none;
}
form.visible{
	display: block;
}
</style>


<input type="submit" name="Draw_Button" value="Draw" id="Draw_Button" class="myButton" />
 <select name="chooseTableList" id="chooseTableList">
	<option selected="selected" value="Weather_Station">Weather_Station</option>
	<option value="Green_Roof A">Green_Roof A</option>
	<option value="Green_Roof B">Green_Roof B</option>
	<option value="Green_Roof C">Green_Roof C</option>
	<option value="Measure_Instrument">Measure_Instrument</option>
	<option value="Files">Files</option>
</select>
<input type="submit" name="chooseTableButton" value="Choose" id="chooseTableButton" class="myButton" style="border-style:None;" />
</br>

<!-- cannot find secure class -->
<form id="Weather_Station" class="hide" method = "post">
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

<form id="Green_Roof_A" class="hide" method = "post">
	<!-- in part1 -->
	<input id="Green_Roof_A_0" type="checkbox" name="Green_Roof_A$0" value="Lower_Temperature" />Lower_Temperature</input></br>
	<input id="Green_Roof_A_1" type="checkbox" name="Green_Roof_A$1" value="Upper_Temperature" />Upper_Temperature</input></br>
	<!-- in part1 end-->
	<input id="Green_Roof_A_2" type="checkbox" name="Green_Roof_A$2" value="Lower_Soil_Moisture" />Lower_Soil_Moisture</input></br>
	<input id="Green_Roof_A_3" type="checkbox" name="Green_Roof_A$3" value="Upper_Soil_Moisture" />Upper_Soil_Moisture</input></br>
	<input id="Green_Roof_A_4" type="checkbox" name="Green_Roof_A$4" value="Flow_Total" />Flow_Total</input></br>
	<input id="Green_Roof_A_5" type="checkbox" name="Green_Roof_A$5" value="Flow_(TOT)" />Flow_(TOT)</input></br>
</form>

<form id="Green_Roof_B" class="hide" method = "post">
	<!-- in part1 -->
	<input id="Green_Roof_B_0" type="checkbox" name="Green_Roof_B$0" value="Lower_Temperature" />Lower_Temperature</input></br>
	<!-- in part1 end-->
	<input id="Green_Roof_B_1" type="checkbox" name="Green_Roof_B$1" value="Upper_Temperature" />Upper_Temperature</input></br>
	<input id="Green_Roof_B_2" type="checkbox" name="Green_Roof_B$2" value="Lower_Soil_Moisture" />Lower_Soil_Moisture</input></br>
	<input id="Green_Roof_B_3" type="checkbox" name="Green_Roof_B$3" value="Upper_Soil_Moisture" />Upper_Soil_Moisture</input></br>
	<input id="Green_Roof_B_4" type="checkbox" name="Green_Roof_B$4" value="Flow_Total" />Flow_Total</input></br>
	<input id="Green_Roof_B_5" type="checkbox" name="Green_Roof_B$5" value="Flow_(TOT)" />Flow_(TOT)</input></br>
</form>

<form id="Green_Roof_C" class="hide" method = "post">
	<!-- in part1 -->
	<input id="Green_Roof_C_0" type="checkbox" name="Green_Roof_C$0" value="Lower_Temperature" />Lower_Temperature</input></br>
	<!-- in part1 end-->
	<input id="Green_Roof_C_1" type="checkbox" name="Green_Roof_C$1" value="Upper_Temperature" />Upper_Temperature</input></br>
	<input id="Green_Roof_C_2" type="checkbox" name="Green_Roof_C$2" value="Lower_Soil_Moisture" />Lower_Soil_Moisture</input></br>
	<input id="Green_Roof_C_3" type="checkbox" name="Green_Roof_C$3" value="Upper_Soil_Moisture" />Upper_Soil_Moisture</input></br>
	<input id="Green_Roof_C_4" type="checkbox" name="Green_Roof_C$4" value="Flow_Total" />Flow_Total</input></br>
	<input id="Green_Roof_C_5" type="checkbox" name="Green_Roof_C$5" value="Flow_(TOT)" />Flow_(TOT)</input></br>
</form>

<form id="Measure_Instrument" class="hide" method = "post">
	<!-- in part1-->
	<input id="Measure_Instrument_0" type="checkbox" name="Measure_Instrument$0" value="Internal_Battery" />Internal_Battery</input></br>
	<input id="Measure_Instrument_1" type="checkbox" name="Measure_Instrument$1" value="External_Supply" />External_Supply</input></br>
	<!-- in part1 end-->
	<input id="Measure_Instrument_2" type="checkbox" name="Measure_Instrument$2" value="Battery" />Battery</input></br>
	<input id="Measure_Instrument_3" type="checkbox" name="Measure_Instrument$3" value="Temperature" />Temperature</input></br>
</table>


</body>
</html>