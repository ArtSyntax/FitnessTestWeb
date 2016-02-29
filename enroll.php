<?php

	$servername = "localhost";
	$username = "art";
	$password = "art12345678";
		
	move_uploaded_file($_FILES["fileCSV"]["tmp_name"],$_FILES["fileCSV"]["name"]); // Copy/Upload CSV

	$objConnect = mysql_connect($servername, $username, $password) or die("Error Connect to Database"); 
	$objDB = mysql_select_db("healthTest");

	$objCSV = fopen($_FILES["fileCSV"]["name"], "r");
	while (($objArr = fgetcsv($objCSV, 1000, ",")) !== FALSE) {
		$strSQL = "INSERT INTO healthTest.USER ";
		$strSQL .="(user_id, id, email, password, gender, birthyear) ";
		$strSQL .="VALUES ";
		$strSQL .="('".$objArr[0]."','".$objArr[1]."','".$objArr[2]."' ";
		$strSQL .=",'".$objArr[3]."','".$objArr[4]."','".$objArr[5]."') ";
		$objQuery = mysql_query($strSQL);
	}
	fclose($objCSV);
	
	echo "Upload & Import Done.";
?>


