<?php 
include('dbConnect.php');

$q = intval($_GET['q']);

$sql1 = mysqli_query($conn, "SELECT hazName, hazVal, hazDesc, hazMit, hazSrc FROM hazard, hazardzone where hazard.idHazard = hazardzone.Hazard_idHazard and hazard.idHazard = '" . $q . "'");
	
echo "<table border='1'>
<tr>
<th>Hazard</th>
<th>Values</th>
<th>Description</th>
<th>Mitigation</th>
<th>Source</th>
</tr>";

while($row = mysqli_fetch_array($sql1))
{
	$hazname = $row['hazName'];
	$hazval = $row['hazVal'];
	$hazdesc = $row['hazDesc'];
	$hazmit = $row['hazMit'];
	$hazsrc = $row['hazSrc'];
	
	echo "<tr>";
	echo "<td><input value=\"" . $hazname .  "\"></input></td>";
	echo "<td>" . $hazval . "</td>";
	echo "<td><input value=\"" . $row['hazDesc'] .  "\"></input></td>";
	echo "<td><input value=\"" . $row['hazMit'] .  "\"></input></td>";
	echo "<td><input value=\"" . $row['hazSrc'] .  "\"></input></td>";
	echo "</tr>";
}
echo "</table>";
echo "<br>";

echo "<input type=\"submit\" value=\"submit\">";

if(isset($_POST['submit'])){
	
	$sql2 = mysqli_query($conn, "update hazardzone, hazard set hazName = '" . $hazname . "', hazDesc = '" . $hazdesc . "', hazMit = '" . $hazmit . "', hazSrc = '" . $hazsrc . "' where hazard.idHazard = hazardzone.Hazard_idHazard and hazard.idHazard = '" . $q . "'and hazardzone.hazVal = '" . $hazval . "'");

}

mysqli_close($conn);
?>