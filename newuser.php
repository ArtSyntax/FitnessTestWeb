<?php
	$servername = "localhost";
	$username = "art";
	$password = "art12345678";

	session_start();
	mysql_connect($servername, $username, $password);
	mysql_select_db("healthTest");
	$strSQL = "SELECT * FROM TEST WHERE test_code = '".(string)$_POST['testcode']."'";
	$objQuery = mysql_query($strSQL);
	$objResult = mysql_fetch_array($objQuery);
		
	if(!$objResult)
	{
		echo "Test code Incorrect!";
		header("location:fail.php");
	}
	else
	{
		session_write_close();
		$newuser = "INSERT INTO USER (id, firstname, lastname, gender, birthyear)
				VALUES ('".(string)$_POST['id'] ."', '"
				.(string)$_POST['firstname'] ."', '"
				.(string)$_POST['lastname'] ."', '"
				.(string)$_POST['gender'] ."', '"
				.(string)(date("Y")-$_POST['year']+1+543) ."')";
		mysql_query("SET NAMES UTF8");
		$sql_newuser = mysql_query($newuser) or die(mysql_error()); 
		header("location:user.php?test_code=".(string)$_POST['testcode']);		
	}
	mysql_close();
?>
