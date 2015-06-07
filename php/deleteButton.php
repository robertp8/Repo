<?php
/*Author: Robert Peralta */

/*
This script will display a form for the admin to enter
that will allow for a button to be deleted that corresponds
to the KML files in the server.
*/

	echo '<form action="php/deleteBtnMod.php" method="post">';
	echo '<input type="text" placeholder="button name" name="btnName"><br>';
	echo '<input type="submit">';
	echo '</form>';
	
?>