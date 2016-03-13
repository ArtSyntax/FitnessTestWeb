<?php
	$servername = "localhost";
	$username = "art";
	$password = "art12345678";

	session_start();
	mysql_connect($servername, $username, $password);
	mysql_select_db("healthTest");
	$strSQL = "SELECT * FROM TEST WHERE test_code = '".mysql_real_escape_string($_POST['testcode'])."'";
	$objQuery = mysql_query($strSQL);
	$objResult = mysql_fetch_array($objQuery);
		
	if(!$objResult)
	{
		echo "Not found Test Code!";
		header("location:fail.php");
	}
	else
	{
		$_SESSION["test_code"] = $objResult["test_code"];
		session_write_close();
		print found;
		if ($_POST['id'] == NULL)
			$_POST['id']='*';
		header("location:preregis.php?testcode=".$_POST['testcode']."&id=".$_POST['id']);
	}
	mysql_close();
?>
