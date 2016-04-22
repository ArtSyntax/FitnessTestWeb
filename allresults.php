 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
 <?php
	if($_GET){
		$host = "localhost";
		$user = "art";
		$pass = "art12345678";
		$dbname="healthTest"; 
		
		$conn=mysql_connect($host,$user,$pass) or die("Can't connect");
		mysql_select_db($dbname) or die(mysql_error()); 
		
		// get all testee
		mysql_query("SET NAMES UTF8");
		$data = mysql_query("SELECT id FROM USER
				INNER JOIN TEST_ENROLLMENT ON TEST_ENROLLMENT.user_id = USER.user_id
				INNER JOIN TEST ON TEST_ENROLLMENT.test_id = TEST.test_id
				WHERE test_code='".(string)$_GET['test_code']."' ORDER BY USER.id ASC")
				or die(mysql_error()); 
				
		$rows = array();
		while($r = mysql_fetch_assoc($data)) {
			$rows[] = $r;
		}
		$jsonTable = json_encode($rows);		
		$testee = array();
		$json_output = json_decode($jsonTable); 
		foreach ($json_output as $key)  
		{	
			array_push($testee,"{$key->id}");
			//print "{$key->id} <br>";
		} 
		
		
		
		// count station in test
		mysql_query("SET NAMES UTF8");
		$sql_count_station = 
				mysql_query("SELECT STATION.station_name, STATION.station_unit 
						FROM TEST
						INNER JOIN TEST_STATION ON TEST.test_id = TEST_STATION.test_id
						INNER JOIN STATION ON TEST_STATION.station_id = STATION.station_id
						WHERE TEST.test_code = '".(string)$_GET['test_code']."'
						ORDER BY STATION.station_name ASC")
				or die(mysql_error()); 
		$rows = array();
		while($r = mysql_fetch_assoc($sql_count_station)) {
			$rows[] = $r;
		}
		
		$jsonTable = json_encode($rows);
		$json_output = json_decode($jsonTable); 
		print "id,ชื่อ,นามสกุล,เพศ,อายุ";
		$count_station = 0;
		$station = array();
		foreach ($json_output as $key)  
		{	
			print ",{$key->station_name}({$key->station_unit})";
			array_push($station,"{$key->station_name}");
			$count_station++;
		} 
		//print_r($count_station);
		
		

		
		// get all results
		if(empty($testee)){
			print "ไม่พบข้อมูลการทดสอบ";
		}
		else{			
			foreach($testee as $person) {
				$firsttime = true;
				if($firsttime){	
					mysql_query("SET NAMES UTF8");
					$sql_testee_info = 
							mysql_query("SELECT id, firstname, lastname, gender,
									(YEAR( CURDATE( ) ) - birthyear +543) AS age
									FROM USER 
									INNER JOIN TEST_ENROLLMENT ON USER.user_id = TEST_ENROLLMENT.user_id
									INNER JOIN TEST ON TEST.test_id = TEST_ENROLLMENT.test_id
									WHERE id='".(string)$person."'")
							or die(mysql_error()); 
					$rows = array();
					while($r = mysql_fetch_assoc($sql_testee_info)) {
						$rows[] = $r;
					}
					
					$jsonTable = json_encode($rows);
					$json_output = json_decode($jsonTable); 
					foreach ($json_output as $key)  
					{	
						print "<br>";
						print "{$key->id},";					
						print "{$key->firstname},";
						print "{$key->lastname},";
						print "{$key->gender},";
						print "{$key->age}";
					} 
					$firsttime = false;
				}
				
				$get_score=
						"SELECT *
						FROM
							(SELECT STATION.station_name
							FROM TEST
								INNER JOIN TEST_STATION ON TEST.test_id = TEST_STATION.test_id
								INNER JOIN STATION ON TEST_STATION.station_id = STATION.station_id
								LEFT JOIN STATION_STANDARD ON STATION_STANDARD.station_id = STATION.station_id
								LEFT JOIN STANDARD ON STATION_STANDARD.standard_id = STANDARD.standard_id
							WHERE TEST.test_code = '".(string)$_GET['test_code']."'
							GROUP BY TEST_STATION.test_station_id
							ORDER BY STATION.station_name ASC) A
						LEFT JOIN
							(SELECT  DATE_FORMAT(T.date, '%d/%m/%Y') AS test_date, T.id, T.firstname, T.lastname, T.gender,
							(YEAR( CURDATE( ) ) - birthyear +543) AS age, T.station_name, T.station_unit, score
							FROM RESULT TMP
								INNER JOIN (
								SELECT USER.id, USER.user_id, USER.firstname, USER.lastname, USER.gender, USER.birthyear, 
								STATION.station_name, STATION.station_unit, 
								MAX( RESULT.date ) AS date
								FROM RESULT
									INNER JOIN USER ON RESULT.user_id = USER.user_id
									INNER JOIN TEST_STATION ON RESULT.test_station_id = TEST_STATION.test_station_id
									INNER JOIN TEST ON TEST.test_id = TEST_STATION.test_id
									INNER JOIN STATION ON STATION.station_id = TEST_STATION.station_id
								WHERE USER.id = '".(string)$person."' 
								AND test_code='".(string)$_GET['test_code']."'
								GROUP BY RESULT.test_station_id)T
							ON T.user_id = TMP.user_id
							AND  T.firstname = firstname
							AND T.lastname = lastname
							AND T.station_name = station_name
							AND T.station_unit = station_unit
							AND T.date = TMP.date
							ORDER BY T.station_name ASC) B
						ON A.station_name = B.station_name";
									
				mysql_query("SET NAMES UTF8");
				$sql_get_score = mysql_query($get_score) or die(mysql_error()); 
				
				$rows = array();
				while($r = mysql_fetch_assoc($sql_get_score)) {
					$rows[] = $r;
				}
				$jsonTable = json_encode($rows);		
				$person_score = array();
				$json_output = json_decode($jsonTable); 
				
				$firsttime = true;
				$count=0;
				foreach ($json_output as $key)  
				{	
					
					//print "+ {$key->station_name}={$key->score} + ";
										
					if ($key->score != null){
						print ",{$key->score}";
					}
					else{
						print ",-";
					}
					$count++;
				} 
			}
		}
	}
?>
 
