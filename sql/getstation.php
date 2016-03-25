<?php
	if($_GET){
		$host = "localhost";
		$user = "art";
		$pass = "art12345678";
		$dbname="healthTest"; 
		
		$conn=mysql_connect($host,$user,$pass) or die("Can't connect");
		mysql_select_db($dbname) or die(mysql_error()); 
		mysql_query("SET NAMES UTF8");
		$data = mysql_query("SELECT TEST_STATION.test_station_id, STATION.station_name, STATION.station_unit, 
						IFNULL(MIN( STANDARD.bad_low ) ,-200) AS low_score_bound, 
						IFNULL(MAX( STANDARD.good_high ),200) AS high_score_bound
						FROM TEST
						INNER JOIN TEST_STATION ON TEST.test_id = TEST_STATION.test_id
						INNER JOIN STATION ON TEST_STATION.station_id = STATION.station_id
						LEFT JOIN STATION_STANDARD ON STATION_STANDARD.station_id = STATION.station_id
						LEFT JOIN STANDARD ON STATION_STANDARD.standard_id = STANDARD.standard_id
						WHERE TEST.test_code = '".$_GET['testcode']."'
						GROUP BY TEST_STATION.test_station_id")
				or die(mysql_error()); 
				
		$rows = array();
		while($r = mysql_fetch_assoc($data)) {
			$rows[] = $r;
		}
		$jsonTable = json_encode($rows);
		print "{\"stations\":";
		print ($jsonTable);
		print "}";
	}
?>
