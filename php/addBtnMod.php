<?php
	require_once('config.php');
	require_once('functions.php');
	session_start();

	$btnName = $_POST['btnName'];
	$hazType = $_POST['hazType'];
	$files = $_POST['files'];
	
	
	
	$checkSpc = preg_match('/\s/', $hazType);

	if($checkSpc == 0){
		
	/************************************************************************************************/
		
		$file = "viewButtons.php";
		$data = file_get_contents($file);

		$pattern = '/echo\s\"<\/div>\"/';

		$str = 'echo "<button id=\"' . $hazType . '\" type=\"button\" class=\"btn btn-default\">' . $btnName . '</button>"; ';
		$str .= ' echo "</div>"';
		
		$update = preg_match_all($pattern, $data, $result);
		$swap = str_replace($result[0][0], $str, $data);

		file_put_contents($file, $swap);
		
	/************************************************************************************************/	

		$file2 = "../js/display.js";
		$data2 = file_get_contents($file2);
		
		$pattern2 = '/geoXml.parse\(\[[\'a-z 0-9 \/ \_ \.\, A-Z ]*/';
		$update2 = preg_match_all($pattern2, $data2, $result1);
		
		$str2 = $result1[0][0] . ', \'datafiles/' . $files . '\']);  ';
		
		$str3 = preg_replace($pattern2, $str2, $data2);
		$str3 = array_unique(explode($str2, $str3));
		
		//print_r($str3[0]);
		//echo $str2;
		
		
		
		
		$pattern3 = '/[\/\/ a-z A-z \. \, \s]*function displayKml\(doc\){/';
		
		preg_match_all($pattern3, $data2, $result2);
		
		//echo $result2[0][0];
		
		//file_put_contents($file2, $swap2);

	/************************************************************************************************/
		
		$pattern4 = '/var numberOfPolys[\s | 0-9 \= \[ \] \. a-z]*;/';
		$update3 = preg_match_all($pattern4, $data2, $result3);

		$arrayLength = count($result3[0]);
		$newArrayLength = $arrayLength + 1;

		$str4 = '';
		
		for($i = 0; $i < 1; $i++){
			for($j = 0; $j < $arrayLength; $j++){
				$str4 .= $result3[$i][$j] . ' ';
			}
		}
		
		$str4 .= ' var numberOfPolys' . $newArrayLength . ' = doc[' . $arrayLength . '].gpolygons.length; ';	
		//echo $str4;
		
		//file_put_contents($file2, $swap3);
		
	/************************************************************************************************/

		$pattern5 = '/for\(var[\s \= \; \< \+ \) \{  a-z A-Z 0-9 \[ \] \. \( ]*}/';
		$update4 = preg_match_all($pattern5, $data2, $result3);
		
		$str5 = '';
		$str7 = '';

		for($i = 0; $i < 1; $i++){
			for($j = 0; $j < $arrayLength; $j++){
				$str5 .= $result3[$i][$j];
				$str7 .= $result3[$i][$j];
			}
		}

		$str5 .= ' for(var i = 0; i < numberOfPolys' . $newArrayLength . '; i++){ ';
		$str5 .= ' doc[' . $arrayLength . '].gpolygons[i].setMap(null); } ';

		$str6 = ' for(var i = 0; i < numberOfPolys' . $newArrayLength . '; i++){ ';
		$str6 .= ' doc[' . $arrayLength . '].gpolygons[i].setMap(null); } ';

		$str7 .= ' for(var i = 0; i < numberOfPolys' . $newArrayLength . '; i++){ ';
		$str7 .= ' doc[' . $arrayLength . '].gpolygons[i].setMap(map); } ';

		
		$swap4 = str_replace($result3[0][$arrayLength-1], $str5, $data2);

		//echo $str5;
		//file_put_contents($file2, $swap4);
		
	/************************************************************************************************/

		$pattern6 = '/\$[\W a-z 0-9]*[.click][\s \= \; \< \+ \) \{ \}  a-z A-Z 0-9 \[ \] \. \( ]*\}[\s]/';	
		$update6 = preg_match_all($pattern6, $data2, $result4);
		
		$str8 = '';
			
		for($i = 0; $i < 1; $i++){
			for($j = 0; $j < $arrayLength; $j++){	
				$str8 .= $result4[$i][$j] . $str6 . '}); ';
				
			}
		}
		
		//echo $str8;
		
	/************************************************************************************************/
		
		$pattern7 = '/\$[\W a-z 0-9]*[.click][\s \= \; \< \+ \) \{  a-z A-Z 0-9 \[ \] \. \( \}]*\}\)\;/';
		$update5 = preg_match_all($pattern7, $data2, $result4);

		$str9 = '';
		
		$str9 = ' $("#' . $hazType . '").click(function(){ ';
		$str9 .= $str7 . '}); ';
		
		//echo $str9;
		
		$newFile = $str3[0] . $str2 . $result2[0][0] . ' ' . $str4 . $str5 . $str8 . $str9 . '}';
		
		//echo $newFile;
		file_put_contents($file2, $newFile);
		
		
		//file_put_contents($file2, $swap5);
		
	/************************************************************************************************/
		
		header('Location: ../Home1.php');
		
	}else{
		echo 'Please do not add spaces in hazard type address box:<a href="../Home1.php">Click here</a> to go back.';
	}
?>