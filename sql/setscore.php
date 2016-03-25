<?php
	if($_GET){
		$host = "localhost";
		$user = "art";
		$pass = "art12345678";
		$dbname="healthTest"; 
		
		$conn=mysql_connect($host,$user,$pass) or die("Can't connect");
		mysql_select_db($dbname) or die(mysql_error()); 
		
		// get user id
		mysql_query("SET NAMES UTF8");
		$data = mysql_query("SELECT COUNT(USER.user_id) As FOUND, 
					IFNULL(USER.user_id,-99) AS user_id, 
					IFNULL(USER.firstname,-99) AS firstname,
					IFNULL(USER.lastname,-99) AS lastname
					FROM USER 
					INNER JOIN TEST_ENROLLMENT ON USER.user_id = TEST_ENROLLMENT.user_id 
					INNER JOIN TEST ON TEST.test_id = TEST_ENROLLMENT.test_id			
					WHERE TEST.test_code = \"".$_GET['testcode']."\"
					AND TEST_ENROLLMENT.user_tag = \"".$_GET['usertag']."\"")
				or die(mysql_error()); 
				
		$rows = array();
		while($r = mysql_fetch_assoc($data)) {
			$rows[] = $r;
			$jsonTable = json_encode($r);
			print ($jsonTable);
		}
		$jsonTable = json_encode($rows);
		//print ($jsonTable);
		
		$json_output = json_decode($jsonTable); 
		foreach ($json_output as $key)  
		{	
			$current_user_id = $key->user_id;
		} 
		//print_r("current user id --> ".$current_user_id);
		
		if ($current_user_id != -99){
			// add score
			mysql_query("SET NAMES UTF8");
			$sql_get_station_id = 
					mysql_query("INSERT INTO RESULT(score, user_id, test_station_id) 
							VALUES (".$_GET['score'].",".$current_user_id.",".$_GET['teststationid'].")")
					or die(mysql_error()); 
		}
			
		
		
	}
?>