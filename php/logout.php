<?php
/*Author: Robert Peralta */

/*
This script will log a user out of the system
*/

session_start();
session_destroy();

header('location: ../Index1.php');
?>