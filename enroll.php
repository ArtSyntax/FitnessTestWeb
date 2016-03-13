<?php

	$servername = "localhost";
	$username = "art";
	$password = "art12345678";

	$path = "/tmp/" . $_FILES["fileCSV"]["name"];
	move_uploaded_file($_FILES["fileCSV"]["tmp_name"],$path); // Copy/Upload CSV

	$objConnect = mysql_connect($servername, $username, $password) or die("Error Connect to Database"); 
	$objDB = mysql_select_db("healthTest");

	$objCSV = fopen($path, "r");

	while (($objArr = fgetcsv($objCSV, ",")) !== FALSE) {
		if($objArr[0] == "id") 
			continue;
		$strSQL = "INSERT INTO USER ";
		$strSQL .="(id, firstname, lastname, gender, birthyear) ";
		$strSQL .="VALUES ";
		$strSQL .="('".$objArr[0]."','".$objArr[1]."','".$objArr[2]."','".$objArr[3]."','".$objArr[4]."')";
		$objQuery = mysql_query($strSQL);
	}
	fclose($objCSV);

	echo "Upload & Import Done.";
?>


