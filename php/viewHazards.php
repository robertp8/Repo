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

	echo "<tr>";
	echo "<td>" . $row['hazName'] . "</td>";
	echo "<td>" . $row['hazVal'] . "</td>";
	echo "<td>" . $row['hazDesc'] . "</td>";
	echo "<td>" . $row['hazMit'] . "</td>";
	echo "<td>" . $row['hazSrc'] . "</td>";
	echo "</tr>";
}
echo "</table>";

mysqli_close($conn);
?>