<?php 

	echo "<select class=\"selectpicker\" name=\"hazName\" onchange=\"modifyHazard(this.value)\">";
	
	echo "<option value=\"default\"> ....Select.....</option>";

	$sql = mysqli_query($conn, "SELECT idHazard, hazName FROM hazard");
	while ($row = mysqli_fetch_array($sql, MYSQL_ASSOC)){
		
		$id=$row["idHazard"];
		$name=$row["hazName"]; 
		
		echo '<option value=' . $id . '>' . $name . '</option>';
	}
	
	echo "</select>";
?>