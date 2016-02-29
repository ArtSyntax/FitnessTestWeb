<?php
	$servername = "localhost";
	$username = "art";
	$password = "art12345678";

	session_start();
	mysql_connect($servername, $username, $password);
	mysql_select_db("healthTest");
	$strSQL = "SELECT * FROM USER WHERE email = '".mysql_real_escape_string($_POST['email'])."' 
	and password = '".mysql_real_escape_string(md5($_POST['pass']))."'";
	$objQuery = mysql_query($strSQL);
	$objResult = mysql_fetch_array($objQuery);
		
	if(!$objResult)
	{
		echo "Username or Password Incorrect!";
		header("location:fail.php");
	}
	else
	{
		$_SESSION["UserID"] = $objResult["UserID"];
		$_SESSION["Status"] = $objResult["Status"];
		
		session_write_close();
		
		if($objResult["Status"] == "ADMIN")
		{
			header("location:admin.html");
		}
		else
		{
			$data = mysql_query($strSQL);
			$rows  = array();
			$temp_1 = array();
			$temp_2 = array();
			while($r = mysql_fetch_assoc($data)) {
				$temp_1 = (string)$r['email'];
				$temp_2 = (int)$r['id'];
				$rows[] = array($temp_1,$temp_2);
			}
			$jsonTable = json_encode($rows);
			//print $jsonTable;
			
			header("location:profile.php?user=".$jsonTable);
		}
	}
	mysql_close();
?>
