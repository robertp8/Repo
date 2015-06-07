<?php
/*Author: Robert Peralta */

/*
This script will allow the admin to delete buttons to
the site and automatically modify the display.js script
and the viewbutton.js script. This script uses php 
regular expressions  to match specific patterns and modify
them to add or delete data.
*/

	session_start();
	
	$btnName = $_POST['btnName'];
	//$files = $_POST['files'];
	
	
	$file = "viewButtons.php";
	$data = file_get_contents($file);
	
	$update = '';
	$update2 = '';
	
	$pattern = '/echo[\s]*\\"\<button id[\s a-z A-z 0-9 \\" \= \-]*>'.$btnName.'\<\/button\>\\"\;/';
	$update = preg_match_all($pattern, $data, $result);

	$pattern2 = '/\"[a-z A-Z 0-9]*/';
	
	$update2 = preg_match_all($pattern2, $result[0][0], $result2);
	
	//print_r($result);
	//print_r($result2);

	$str = '';
	$swap = preg_replace($pattern, $str, $data);
	
	//echo $swap;
	
	file_put_contents($file, $swap);
	
/*************************************************************************************************************/
	
	$pattern3 = '/[a-z A-Z 0-9]*/';
	$update3 = preg_match_all($pattern3, $result2[0][1], $result3);
	
	//print_r($result3);
	
	$file2 = "../js/display.js";
	$data2 = file_get_contents($file2);
	
/*************************************************************************************************************/	
	//Finds Specified object
	$pattern4 = '/\$\(\\"\#'.$result3[0][1].'\\"\)\.click[\s a-z A-z 0-9 \( \) \{ \= \; \< \+ \[ \] \. \}]*;/'; 
	$update4 = preg_match_all($pattern4, $data2, $result4);
	
	//echo $result3[0][1];
	//print_r($result4);
	
	$swap2 = preg_replace($pattern4, $str, $data2);
	//echo $swap2;
	
	//print_r($result6);
	
	//Finds objects of same pattern
	$pattern5 = '/\$[\W a-z 0-9]*[.click][\s \= \; \< \+ \) \{  a-z A-Z 0-9 \[ \] \. \( \}]*\}\)\;/';
	$update5 = preg_match_all($pattern5, $data2, $result5);
	
	$arrayLength = count($result5[0]);
	$str4 = '';
		
	for($i = 0; $i < 1; $i++){
		for($j = 0; $j < $arrayLength; $j++){
			$str4 .= $result5[$i][$j] . ' ';
		}
	}
	
	$str5 = '';
	
	$swap3 = preg_replace($pattern4, $str5, $str4);
	
	/***echo $swap3;***/
	//echo $swap3;
	
/*************************************************************************************************************/
	
	$pattern6 = '/for\([\= \; \< \+ \[ \] \) a-z A-Z 0-9 \{ \s]*[\s \[ \] \. \( \) \; a-z A-Z 0-9]*\(map\)\;[\s]*\}/';
	$update6 = preg_match_all($pattern6, $result4[0][0], $result6);	

	//print_r($result6);
	
	$pattern8 = '/doc\[[0-9]\]/';
	$update8 = preg_match_all($pattern8, $result6[0][0], $result7);
	
	//print_r($result7);
	
	$pattern9 = '/[0-9]/';
	$update9 = preg_match_all($pattern9, $result7[0][0], $result9);
	
	//print_r($result8);
	$str6 = $result9[0][0];
	
	//echo $str6;
	
/*************************************************************************************************************/
	
	$pattern10 = '/for\([\= \; \< \+ \[ \] \) a-z A-Z 0-9 \{ \s]*doc\['.$str6.'\][\s \[ \] \. \( \) \; a-z A-Z 0-9]*\}/';
	$update10 = preg_match_all($pattern10, $data2, $result10);
	
	//print_r($result10);
	
	$str8 = '';
	$str9 = '';
	
	$arrayLength3 = count($result10[0]);
	
	for($i = 0; $i < 1; $i++){
		for($j = 0; $j < $arrayLength3; $j++){
			$str9 .= $result10[$i][$j] . ' ';
		}
	}
	//echo $str9;
	
	$swap4 = preg_replace($pattern10, $str8, $swap3);
	
	//echo $swap4;
	
/*************************************************************************************************************/
	
	$pattern11 = '/for\([\= \; \< \+ \[ \] \) a-z A-Z 0-9 \{ \s]*[\s \[ \] \. \( \) \; a-z A-Z 0-9]*\(map\)\;[\s]*\}/';
	$update11 = preg_match_all($pattern11, $swap4, $result11);
	
	//print_r($result11);
	
	$arrayLength2 = count($result11[0]);
	$str10 = '';
	
	for($i = 0; $i < 1; $i++){
		for($j = 0; $j < $arrayLength2; $j++){
			$str10 .= $result11[$i][$j];
		}
	}
	
	//echo $str10;
	
	$pattern12 = '/i[\s \< a-z A-Z 0-9]*;/';
	$update12 = preg_match_all($pattern12, $str10, $result12);
	
	//print_r($result12);
	$arrayLength4 = count($result12[0]);
	
	$str11 = '';
	
	for($i = 0; $i < 1; $i++){
		for($j = 0; $j < $arrayLength2; $j++){
			$str11 .= $result12[$i][$j];
		}
	}
	
	//echo $str11;
	
	$pattern13 = '/n[a-h j-z A-H J-Z 0-9]*/';
	$update13 = preg_match_all($pattern13, $str11, $result13);
	
	
	//print_r($result13);
	$arrayLength5 = count($result13[0]);
	
	$str12 = '';
	$count2 = 0;
	
	for($i = 0; $i < 1; $i++){
		for($j = 0; $j < $arrayLength5; $j++){
			
			if($j == 0){
				$str12 .= 'for(var i = 0; i < numberOfPolys; i++){ doc[0].gpolygons[i].setMap(null); } ';
				$count2++;
			}else{
				$str12 .= 'for(var i = 0; i < numberOfPolys' . $count2 . '; i++){ doc[' . $count2 . '].gpolygons[i].setMap(null); } ';
				$count2++;
			}
		}
	}
	
	//echo $swap4;
	//echo $str12;
	
/*************************************************************************************************************/
	
	$pattern15 = '/var numberOfPolys[\s | 0-9 \= \[ \] \. a-z]*;/';
	$update15 = preg_match_all($pattern15, $data2, $result15);

	$arrayLength6 = count($result15[0]);
	//print_r($result15);
	
	$str13 = '';
	$count3 = 0;
	
	for($i = 0; $i < 1; $i++){
		for($j = 0; $j < $arrayLength6; $j++){
			
			$str13 .= $result15[$i][$j] . ' '; 
		}
	}
	
	//echo $str13;
	
	$str16 = '';
	
	$pattern16 = '/[\s a-z A-Z 0-9]*\=[\s]*doc\['.$str6.']\.gpolygons\.length\;/';
	$swap5 = preg_replace($pattern16, $str16, $str13);
	
	//echo $swap5;
	
	$str14 = '';
	$str15 = '';
	$count3 = 0;
	
	for($i = 0; $i < 1; $i++){
		for($j = 0; $j < $arrayLength6-1; $j++){
			
			if($j == 0){
				$str14 .= 'var numberOfPolys = doc[0].gpolygons.length; ';
				$count3++;
			}else{
				$str14 .= 'var numberOfPolys'.$count3.'= doc['.$count3.'].gpolygons.length; ';
				$count3++;
			}
		}
	}
	
	//echo $str14;
	
/*************************************************************************************************************/

	$pattern9 = '/geoXml.parse\(\[[\'a-z 0-9 \/ \_ \.\, A-Z ]*/';
	$update9 = preg_match_all($pattern9, $data2, $result8);
	
	$str2 = $result8[0][0] . ']); ';
	
	$str3 = preg_replace($pattern9, $str2, $data2);
	$str3 = array_unique(explode($str2, $str3));
	
	//print_r($str3[0]);
	//echo $str2;
	
	$pattern17 = '/\'datafiles\/[a-z A-Z 0-9 \_]*\.kml\'/';
	$update16 = preg_match_all($pattern17, $str2, $result16);
	
	//print_r($result16);
	$arrayLength7 = count($result16[0]);
	$str17 = 'geoXml.parse([';
	
	//echo $arrayLength7;
	for($i = 0; $i < 1; $i++){
		for($j = 0; $j < $arrayLength7; $j++){
			
			if($j == $str6){
				$str17 .= '';
			}else{	
				$str17 .= $result16[$i][$j] . ', ';
			}
		}
	}
	$str17 .= ']); ';
	
	$update22 = preg_match_all($pattern17, $str17, $result22);
	
	$arrayLength20 = count($result22[0]);
	$str27 = 'geoXml.parse([';
	
	//echo $arrayLength7;
	for($i = 0; $i < 1; $i++){
		for($j = 0; $j < $arrayLength20; $j++){
			
			if($j == $arrayLength20-1){
				$str27 .= $result22[$i][$j];
			}else{	
				$str27 .= $result22[$i][$j] . ', ';
			}
		}
	}
	$str27 .= ']); ';
	
	//echo $str27;
	
	//echo $str17; 

/*************************************************************************************************************/
	
	$pattern18 = '/for\([\= \; \< \+ \[ \] \) a-z A-Z 0-9 \{ \s]*doc[\s \[ \] \. \( \) \; a-z A-Z 0-9]*\}/';
	$update17 = preg_match_all($pattern18, $data2, $result17);
	
	//print_r($result17);
	$str18 = '';
	$count4 = 0;
	
	for($i = 0; $i < 1; $i++){
		for($j = 0; $j < $arrayLength; $j++){
			
			if($j == 0){
				$str18 .= 'for(var i = 0; i < numberOfPolys; i++) { doc[0].gpolygons[i].setMap(null); } ';
				$count4++;
			}else if($j == $str6){
				$str18 .= '';
			}else{
				$str18 .= 'for(var i = 0; i < numberOfPolys'.$count4.'; i++) { doc['.$count4.'].gpolygons[i].setMap(null); } ';
				$count4++;
			}
		}
	}
	
	//echo $str18;
	
/*************************************************************************************************************/

	$pattern20 = '/for\([a-z A-Z 0-9 \= \; \< \+ \) \} \{ \[ \] \. \(\s]*\}/';
	$update19 = preg_match_all($pattern20, $swap4, $result19);
	//echo $swap4;
	
	$swap6 = preg_replace($pattern20, $str18, $swap4);
	
	//echo $swap6; 
	
	$pattern21 = '/\$\(\"\#[\. a-z A-Z 0-9 \s \" \) \[ \] \( \{ \= \; \< \+ \}]*/';
	$update21 = preg_match_all($pattern21, $swap6, $result21);
	
	$arrayLength8 = count($result21[0]);
	//print_r($result21);
	
	$str23 = '';
	$count5 = 0;
	$count6 = 0;
	
	//echo $arrayLength;
	for($i = 0; $i < 1; $i++){
		for($j = 0; $j < $arrayLength; $j++){
			$k = $j;
			$count6 = $count5;
			if($j == 0){
				$str23 .= 'for(var i = 0; i < numberOfPolys; i++) { doc[0].gpolygons[i].setMap(map); } ';
				
				while($k <= ($arrayLength-1)){
					$k++;
					$count6++;
					$str23 .= 'for(var i = 0; i < numberOfPolys'.$count6.'; i++) { doc['.$count6.'].gpolygons[i].setMap(null); } ';
					$k++;
				}
				$count5++;
			}else{
				$k = $j;
				$count6 = $count5;
				
				while($k > 0){
					$k--;
					
					if($k == 0){
						$str23 .= 'for(var i = 0; i < numberOfPolys; i++) { doc[0].gpolygons[i].setMap(null); } ';	
					}else{
						$count6--;
						$str23 .= 'for(var i = 0; i < numberOfPolys'.$count6.'; i++) { doc['.$count6.'].gpolygons[i].setMap(null); } ';
					}
				}
				
				$k = $j;
				$count6 = $count5;
				
				$str23 .= 'for(var i = 0; i < numberOfPolys'.$count5.'; i++) { doc['.$count5.'].gpolygons[i].setMap(map); } ';				
				 
				 while($k < ($arrayLength-1)){
					$k++;
					$count6++;
					if($count6 == $arrayLength-1){
						$str23 .= '';
					}else{
						$str23 .= 'for(var i = 0; i < numberOfPolys'.$count6.'; i++) { doc['.$count6.'].gpolygons[i].setMap(null); } ';
					}
					
					$k++;
				}
				 
				$count5++;
			}
			$str23 .= ' }); ';
		}
	}
	
	//echo $str23;
	//echo $swap4;
	$str24 = explode("});", $str23);
	$str26 = explode("});", $swap4);
	
	//print_r($str24);
	//print_r($str26);
	$arrayLength19 = count($str24);
	
	//echo $arrayLength19;
	$str25 = '';
	
	for($i = 0; $i < $arrayLength-1; $i++){
		$str25 .= preg_replace($pattern20, $str24[$i], $str26[$i]);
		$str25 .= ' }); ';
	}
	//echo $str25;
	
	$update20 = preg_match_all($pattern5, $swap6, $result20);
	
	//echo $swap6;
	//$pattern21 = '/\$\(\"\#[\. a-z A-Z 0-9 \s \" \) \[ \] \( \{ \= \; \< \+ \}]*/';
	/*$update21 = preg_match_all($pattern21, $swap6, $result21);
	*/
	
	$pattern14 = '/[\/\/ a-z A-z \. \, \s]*function displayKml\(doc\){/';
	$update14 = preg_match_all($pattern14, $data2, $result14);
	
	//echo $result14[0][0];
		
	$newFile = $str3[0] . $str27 . $result14[0][0] . ' ' . $str14 . $str18 . $str25 . ' }';
	//echo $str25;
	//echo $newFile;
	
	file_put_contents($file2, $newFile);
	
	header('Location: ../Home1.php');
?>