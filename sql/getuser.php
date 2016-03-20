<?php
	if($_GET){
		$host = "localhost";
		$user = "art";
		$pass = "art12345678";
		$dbname="healthTest"; 
		
		$conn=mysql_connect($host,$user,$pass) or die("Can't connect");
		mysql_select_db($dbname) or die(mysql_error()); 
		mysql_query("SET NAMES UTF8");
		$data = mysql_query("SELECT USER.id, USER.firstname, USER.lastname, TEST_ENROLLMENT.user_tag 
					FROM USER 
					INNER JOIN TEST_ENROLLMENT ON USER.user_id = TEST_ENROLLMENT.user_id 
					INNER JOIN TEST ON TEST.test_id = TEST_ENROLLMENT.test_id			
					WHERE TEST.test_code = \"".$_GET['testcode']."\"
					ORDER BY USER.id ASC, USER.firstname ASC")
				or die(mysql_error()); 
				
		$rows = array();
		while($r = mysql_fetch_assoc($data)) {
			$rows[] = $r;
		}
		$jsonTable = json_encode($rows);
		print "{\"testee\":";
		print ($jsonTable);
		print "}";
	}
?>