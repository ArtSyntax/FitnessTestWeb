<?php
	if($_GET){
		$host = "localhost";
		$user = "art";
		$pass = "art12345678";
		$dbname="healthTest"; 
		
		$conn=mysql_connect($host,$user,$pass) or die("Can't connect");
		mysql_select_db($dbname) or die(mysql_error()); 
		mysql_query("SET NAMES UTF8");
		$data = mysql_query("SELECT USER.firstname, USER.lastname, TEST.test_name, STATION.station_name, 		
						RESULT.score, STATION.station_unit, RESULT.date
						FROM RESULT
						INNER JOIN USER ON RESULT.user_id = USER.user_id
						INNER JOIN TEST_STATION ON RESULT.test_station_id = TEST_STATION.test_station_id
						INNER JOIN TEST ON TEST.test_id = TEST_STATION.test_id
						INNER JOIN STATION ON STATION.station_id = TEST_STATION.station_id
						WHERE USER.id = ".$_GET['id']."
						GROUP BY STATION.station_name")
				or die(mysql_error()); 
				
		$rows = array();
		while($r = mysql_fetch_assoc($data)) {
			$rows[] = $r;
		}
		$jsonTable = json_encode($rows);
		print ($jsonTable);
	}
?>
