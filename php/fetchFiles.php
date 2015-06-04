<?php 

	echo "<select name=\"fileName\" onchange=\"addFile(this.value)\">";
	
	echo "<option value=\"default\"> ....Select.....</option>";

	$sql = mysqli_query($conn, "SELECT fileName FROM files");
	while ($row = mysqli_fetch_array($sql, MYSQL_ASSOC)){
		
		$name=$row["fileName"]; 
		
		echo '<option value=' . $name . '>' . $name . '</option>';
	}
	
	echo "</select>";
	
?>