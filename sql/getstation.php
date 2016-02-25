<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<?php
	if($_GET){
		$host = "localhost";
		$user = "art";
		$pass = "art12345678";
		$dbname="healthTest"; 
		
		$conn=mysql_connect($host,$user,$pass) or die("Can't connect");
		mysql_select_db($dbname) or die(mysql_error()); 
		mysql_query("SET NAMES UTF8");
		$data = mysql_query("SELECT TEST.test_code, STATION.station_name
				FROM  `TEST` 
				INNER JOIN  `TEST_STATION` 
				ON TEST.test_id = TEST_STATION.test_id
				INNER JOIN STATION ON TEST_STATION.station_id = STATION.station_id
				WHERE TEST.test_code = \"".$_GET['testcode']."\"")
				or die(mysql_error()); 
				
		$rows = array();
		while($r = mysql_fetch_assoc($data)) {
			$rows[] = $r;
		}
		$jsonTable = json_encode($rows);
		print ($jsonTable);
	}
?>
