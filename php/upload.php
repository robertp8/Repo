<?php
session_start();
include('dbConnect.php');

// Example of accessing data for a newly uploaded file
$fileName = $_FILES["uploadfile"]["name"]; 
$fileTmpLoc = $_FILES["uploadfile"]["tmp_name"];
$uploadOk = 1;
// Path and file name
$pathAndName = "C:/wamp/www/Malama/datafiles/".$fileName;

if (file_exists($pathAndName)) {
    echo "Sorry, file already exists.";
	echo "\nClick here to go back: <a href=\"../Home1.php\"> Home page </a>";
    $uploadOk = 0;
}else{
	
	// Run the move_uploaded_file() function here
	$moveResult = move_uploaded_file($fileTmpLoc, $pathAndName);

	// Evaluate the value returned from the function if needed
	if ($moveResult == true) {
		echo "Congratulations, you have uploaded a file to: " . $pathAndName;
		echo "<br/>";
		echo "Click here to go back: <a href=\"../Home1.php\"> Home page </a>";
		
		$sql = mysqli_query($conn, "SELECT * FROM admin WHERE Uname ='" . $_SESSION['username'] . "'");

		while($row = mysqli_fetch_array($sql)){
			$id = $row['idAdmin'];
		}

		$sql2 = mysqli_query($conn, "Insert into `files`(`fileName`, `Admin_idAdmin`) Values('$fileName', '$id')");

		header('Location: ../Home1.php');
	
	} else {
		echo "ERROR: File not moved correctly";
	}
}

mysqli_close($conn);
?>