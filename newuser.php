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
		// add new user
		$newuser = "INSERT INTO USER (id, firstname, lastname, gender, birthyear)
				SELECT '".(string)$_POST['id'] ."', '"
				.(string)$_POST['firstname'] ."', '"
				.(string)$_POST['lastname'] ."', '"
				.(string)$_POST['gender'] ."', '"
				.(string)(date("Y")-$_POST['year']+1+543) ."'
				FROM USER 
				INNER JOIN TEST_ENROLLMENT ON TEST_ENROLLMENT.user_id = USER.user_id
				INNER JOIN TEST ON TEST_ENROLLMENT.test_id = TEST.test_id
				WHERE USER.id = '".(string)$_POST['id']."' 
				AND TEST.test_code = '".(string)$_POST['testcode']."'
				HAVING COUNT(*) = 0";
		mysql_query("SET NAMES UTF8");
		$sql_newuser = mysql_query($newuser) or die(mysql_error()); 
		
		// get user ID
		mysql_query("SET NAMES UTF8");
		$sql_get_user_id = 
				mysql_query("SELECT MAX(user_id) AS MAXID FROM USER") or die(mysql_error()); 
		$rows = array();
		while($r = mysql_fetch_assoc($sql_get_user_id)) {
			$rows[] = $r;
		}
		
		$jsonTable = json_encode($rows);
		$json_output = json_decode($jsonTable); 
		$current_user_id = NULL;
		foreach ($json_output as $key)  
		{	
			$current_user_id = intval($key->MAXID);
		} 
		print_r("<br> user id --> ".$current_user_id);
		
		// get test ID
		mysql_query("SET NAMES UTF8");
		$sql_get_test_id = 
				mysql_query("SELECT test_id FROM TEST WHERE test_code = '".(string)$_POST['testcode']."'")
				or die(mysql_error()); 
		$rows = array();
		while($r = mysql_fetch_assoc($sql_get_test_id)) {
			$rows[] = $r;
		}
		
		$jsonTable = json_encode($rows);
		$json_output = json_decode($jsonTable); 
		$current_test_id = NULL;
		foreach ($json_output as $key)  
		{	
			$current_test_id = $key->test_id;
		} 
		print_r("<br> Test ID --> ".$current_test_id);
		
		// get new last user TAG
		mysql_query("SET NAMES UTF8");
		$sql_get_user_tag = 
				mysql_query("SELECT MAX(user_TAG) AS MAXTAG FROM TEST_ENROLLMENT 
				WHERE test_id = '".$current_test_id."'") or die(mysql_error()); 
		$rows = array();
		while($r = mysql_fetch_assoc($sql_get_user_tag)) {
			$rows[] = $r;
		}
		
		$jsonTable = json_encode($rows);
		$json_output = json_decode($jsonTable); 
		$old_user_tag = 1;
		foreach ($json_output as $key)  
		{	
			$old_user_tag = intval($key->MAXTAG);
		} 
		print_r("<br> last old tag id --> ".$old_user_tag);
		
		// enroll user to test
		$user="INSERT INTO TEST_ENROLLMENT(user_tag, user_id, test_id) 
				SELECT ".($old_user_tag+1).",".($current_user_id).",".$current_test_id."
				FROM TEST_ENROLLMENT
				WHERE user_id = '".($current_user_id)."' AND test_id = '".$current_test_id."'
				HAVING COUNT(*) = 0;";			
		mysql_query("SET NAMES UTF8");
		$sql_enroll = mysql_query($user) or die(mysql_error()); 
		
		header("location:user.php?test_code=".(string)$_POST['testcode']."&tmp=".$current_user_id);		
	}
	mysql_close();
?>
