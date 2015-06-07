<?php
/*Author: Robert Peralta */

/*
This script will check to see if an admin is logged in.
*/

function redirect($page) {
	
	header('Location: ' . $page);
	exit();
}

function check_login_status() {

	if(isset($_SESSION['logged_in'])) {
		
		return $_SESSION['logged_in'];
	}
	return false;
}
