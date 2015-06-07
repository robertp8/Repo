<?php
/*Author: Robert Peralta*/

/*
This script will display a form for the admin to enter
that will allow for a button to be added that corresponds
to the KML files in the server.
*/

	$q = strval($_GET['q']);
	echo '<form action="php/addBtnMod.php" method="post">';
	echo '<input type="text" placeholder="button name" name="btnName"><br>';
	echo '<input type="text" placeholder="hazard type" name="hazType">Please do not add any spaces to this text.<br>';
	echo '<input type="hidden" name="files" value="' . $q . '">';
	echo '<input type="submit">';
	echo '</form>';
	
?>