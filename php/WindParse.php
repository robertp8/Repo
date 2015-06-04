<?php

	$file = "../datafiles/hawaii_50mwind.kml";
	$data = file_get_contents($file);

	$pattern = '/\<Placemark\>/';
	$update = preg_match_all($pattern, $data, $results);
	
	print_r($results);

?>