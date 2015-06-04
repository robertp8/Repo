<?php 
include('dbConnect.php');

$q = intval($_GET['q']);

$sql1 = mysqli_query($conn, "SELECT idHazardZone, hazName, hazVal, hazDesc, hazMit, hazSrc FROM hazard, hazardzone where hazard.idHazard = hazardzone.Hazard_idHazard and hazard.idHazard = '" . $q . "'");

$i=1;

echo "<input type=\"hidden\" name=\"HazID\" id=\"HazID\" value=\"" . $q . "\">";

echo "<div class=\"container\">";
echo "<table class=\"table table-bordered\">
<thead>
	<tr>
		<th>Delete</th>
		<th>Values</th>
		<th>Description</th>
		<th>Mitigation</th>
		<th>Source</th>
	</tr>
</thead>
<tbody>";
while($row = mysqli_fetch_array($sql1)) {
	
	$zoneID = $row['idHazardZone'];
	$hazname = $row['hazName'];
	$hazval = $row['hazVal'];
	$hazdesc = $row['hazDesc'];
	$hazmit = $row['hazMit'];
	$hazsrc = $row['hazSrc'];
	
	echo "<input type=\"hidden\" name=\"zoneID_" . $i . "\" id=\"zoneID_" . $i . "\" value=\"" . $zoneID . "\">";
	
	
	if($i%2){
		echo "<tr id=\"" . $i . "\" class=\"editRow\">";
	}else{
		echo "<tr id=\"" . $i . "\" bgcolor=\"C2C2C2\" class=\"editRow\">";
	}
	
	echo "<td><input id=\"" . $i . "\" type=\"checkbox\" class=\"case\"/></td>";
	echo "<td class=\"edit_td\">
			<span id=\"hazv_" . $i . "\" class=\"text\" style=\"display: inline; \">" . $hazval . "</span>
			<input type=\"text\" class=\"editCell\" name=\"hazVal\" id=\"hazval_" . $i . "\" value=\"" . $hazval .  "\"></td>";
	echo "<td class=\"edit_td\">
			<span id=\"hazd_" . $i . "\" class=\"text\" style=\"display: inline; \">" . $hazdesc . "</span>
			<input type=\"text\" class=\"editCell\" name=\"hazDesc\" id=\"hazdesc_" . $i . "\" value=\"" . $hazdesc .  "\"></td>";
	echo "<td class=\"edit_td\">
			<span id=\"hazm_" . $i . "\" class=\"text\" style=\"display: inline; \">" . $hazmit . "</span>
			<input type=\"text\" class=\"editCell\" name=\"hazMit\" id=\"hazmit_" . $i . "\" value=\"" . $hazmit .  "\"></td>";
	echo "<td class=\"edit_td\">
			<span id=\"hazs_" . $i . "\" class=\"text\" style=\"display: inline; \">" . $hazsrc . "</span>
			<input type=\"text\" class=\"editCell\" name=\"hazSrc\" id=\"hazsrc_" . $i . "\" value=\"" . $hazsrc .  "\"></td>";
	echo "</tr>";
	
	$i++;
}	

echo "</tbody>";
echo "</table>";
echo "</div>";
echo "<br>";
echo "<button type=\"button\" class=\"deleteRow\">- Delete</button>
	  <button type=\"button\" class=\"addRow\">+ Add More</button>";
	  
mysqli_close($conn);
?>