<?php
/*Author: Robert Peralta*/

/*
This script will display a form for the admin to enter data
that will allow for info to be added for a specific type of 
hazard
*/

include('dbConnect.php');

$q = intval($_GET['q']);

echo "<form method=\"post\" action=\"php/addQuery.php\">";
echo "<p>Enter the hazard level: <input type=\"text\" name=\"addVal\" id=\"addVal\"></p>";
echo "<p>Enter the hazard description: <input type=\"text\" name=\"addDesc\" id=\"addDesc\"></p>";
echo "<p>Enter the hazard mitigation: <input type=\"text\" name=\"addMit\" id=\"addMit\"></p>";
echo "<p>Enter the hazard source: <input type=\"text\" name=\"addSrc\" id=\"addSrc\"></p>";
echo "<input type=\"hidden\" id=\"hazID\" name=\"hazID\" value=\"" . $q . "\">";
echo "<input type=\"submit\" name=\"submit\">";
echo "</form>";

mysqli_close($conn);
?>