 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
 <?php
	$servername = "localhost";
	$username = "art";
	$password = "art12345678";
	$dbname = "healthTest";

	session_start();
	mysql_connect($servername, $username, $password);
	mysql_select_db("healthTest");
	mysql_query("SET NAMES UTF8");
	$strSQL = "SELECT * FROM USER WHERE email = 'admin' 
	and password = '".mysql_real_escape_string(md5($_POST['password']))."'";
	$objQuery = mysql_query($strSQL);
	$objResult = mysql_fetch_array($objQuery);
		
	if(!$objResult)
	{
		echo "Error! Don't have permission.";
		header("location:fail.php");
	}
	else
	{
		session_write_close();

		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 

		mysqli_query( $conn, 'SET NAMES "utf8" COLLATE "utf8_general_ci"' );
		$sql = 
		"INSERT INTO STATION(station_id, station_name, station_unit)
		SELECT null,'"
		.(string)$_POST['stationname'] ."', '"
		.(string)$_POST['stationunit'] ."'
		FROM STATION WHERE station_name = '"
		.(string)$_POST['stationname'] ."' HAVING COUNT(*) = 0";
		
		if ($conn->query($sql) === TRUE) {
			echo "New record created successfully";
			
			$standard_count = 0;
			$add_standard="INSERT INTO STANDARD (standard_id, gender, age_low, age_high, bad_low, 
					bad_high, mid_low, mid_high, good_low, good_high) 
					VALUES (NULL, 'M'," 
					.(string)$_POST['m1_age_low'].","
					.(string)$_POST['m1_age_high'].","
					.(string)$_POST['m1_bad_low']."," 
					.(string)$_POST['m1_bad_high'].","
					.(string)$_POST['m1_mid_low'].","
					.(string)$_POST['m1_mid_high'].","
					.(string)$_POST['m1_good_low'].","
					.(string)$_POST['m1_good_high'].");";	
			mysql_query("SET NAMES UTF8");
			$sql_new_standard_m1 = mysql_query($add_standard) or die(mysql_error()); 
			$standard_count++;
			
			if ($_POST['m2_age_low'] != null)
			{
				$add_standard="INSERT INTO STANDARD (standard_id, gender, age_low, age_high, bad_low, 
						bad_high, mid_low, mid_high, good_low, good_high) 
						VALUES (NULL, 'M',"
						.(string)$_POST['m2_age_low'].","
						.(string)$_POST['m2_age_high'].","
						.(string)$_POST['m2_bad_low']."," 
						.(string)$_POST['m2_bad_high'].","
						.(string)$_POST['m2_mid_low'].","
						.(string)$_POST['m2_mid_high'].","
						.(string)$_POST['m2_good_low'].","
						.(string)$_POST['m2_good_high'].");";	
				mysql_query("SET NAMES UTF8");
				$sql_new_standard_m2 = mysql_query($add_standard) or die(mysql_error()); 
				$standard_count++;
			}
					
			if ($_POST['m3_age_low'] != null)
			{
				$add_standard="INSERT INTO STANDARD (standard_id, gender, age_low, age_high, bad_low, 
						bad_high, mid_low, mid_high, good_low, good_high) 
						VALUES (NULL, 'M',"
						.(string)$_POST['m3_age_low'].","
						.(string)$_POST['m3_age_high'].","
						.(string)$_POST['m3_bad_low']."," 
						.(string)$_POST['m3_bad_high'].","
						.(string)$_POST['m3_mid_low'].","
						.(string)$_POST['m3_mid_high'].","
						.(string)$_POST['m3_good_low'].","
						.(string)$_POST['m3_good_high'].");";	
				mysql_query("SET NAMES UTF8");
				$sql_new_standard_m3 = mysql_query($add_standard) or die(mysql_error()); 
				$standard_count++;
			}
			
			$add_standard="INSERT INTO STANDARD (standard_id, gender, age_low, age_high, bad_low, 
					bad_high, mid_low, mid_high, good_low, good_high) 
					VALUES (NULL, 'F'," 
					.(string)$_POST['f1_age_low'].","
					.(string)$_POST['f1_age_high'].","
					.(string)$_POST['f1_bad_low']."," 
					.(string)$_POST['f1_bad_high'].","
					.(string)$_POST['f1_mid_low'].","
					.(string)$_POST['f1_mid_high'].","
					.(string)$_POST['f1_good_low'].","
					.(string)$_POST['f1_good_high'].");";	
			mysql_query("SET NAMES UTF8");
			$sql_new_standard_f1 = mysql_query($add_standard) or die(mysql_error()); 
			$standard_count++;
			
			if ($_POST['f2_age_low'] != null)
			{
				$add_standard="INSERT INTO STANDARD (standard_id, gender, age_low, age_high, bad_low, 
						bad_high, mid_low, mid_high, good_low, good_high) 
						VALUES (NULL, 'F',"
						.(string)$_POST['f2_age_low'].","
						.(string)$_POST['f2_age_high'].","
						.(string)$_POST['f2_bad_low']."," 
						.(string)$_POST['f2_bad_high'].","
						.(string)$_POST['f2_mid_low'].","
						.(string)$_POST['f2_mid_high'].","
						.(string)$_POST['f2_good_low'].","
						.(string)$_POST['f2_good_high'].");";	
				mysql_query("SET NAMES UTF8");
				$sql_new_standard_f2 = mysql_query($add_standard) or die(mysql_error()); 
				$standard_count++;
			}
					
			if ($_POST['f3_age_low'] != null)
			{
				$add_standard="INSERT INTO STANDARD (standard_id, gender, age_low, age_high, bad_low, 
						bad_high, mid_low, mid_high, good_low, good_high) 
						VALUES (NULL, 'F',"
						.(string)$_POST['f3_age_low'].","
						.(string)$_POST['f3_age_high'].","
						.(string)$_POST['f3_bad_low']."," 
						.(string)$_POST['f3_bad_high'].","
						.(string)$_POST['f3_mid_low'].","
						.(string)$_POST['f3_mid_high'].","
						.(string)$_POST['f3_good_low'].","
						.(string)$_POST['f3_good_high'].");";	
				mysql_query("SET NAMES UTF8");
				$sql_new_standard_f3 = mysql_query($add_standard) or die(mysql_error()); 
				$standard_count++;
			}

			// get station id
			mysql_query("SET NAMES UTF8");
			$sql_get_station_id = 
					mysql_query("SELECT station_id FROM STATION WHERE station_name = '".(string)$_POST['stationname']."'")
					or die(mysql_error()); 
			$rows = array();
			while($r = mysql_fetch_assoc($sql_get_station_id)) {
				$rows[] = $r;
			}
			
			$jsonTable = json_encode($rows);
			$json_output = json_decode($jsonTable); 
			$current_station_id = NULL;
			foreach ($json_output as $key)  
			{	
				$current_station_id = $key->station_id;
			} 
			print_r("<br> current station id --> ".$current_station_id);
			print_r("<br> i --> ".$standard_count);
			
			// get standard id
			mysql_query("SET NAMES UTF8");
			$sql_get_station_id = 
					mysql_query("SELECT MAX(standard_id) AS MAXID FROM STANDARD")
					or die(mysql_error()); 
			$rows = array();
			while($r = mysql_fetch_assoc($sql_get_station_id)) {
				$rows[] = $r;
			}
			
			$jsonTable = json_encode($rows);
			$json_output = json_decode($jsonTable); 
			$current_standard_id = NULL;
			foreach ($json_output as $key)  
			{	
				$current_standard_id = intval($key->MAXID)-$standard_count+1;
			} 
			print_r("<br> current standard id --> ".$current_standard_id);
			
			// add station standard
			
			for ($i = 0; $i<$standard_count;$i++ )
			{
				$add_station_standard=
						"INSERT INTO STATION_STANDARD(station_standard_id, station_id, standard_id) 
						VALUES(NULL,".(string)$current_station_id.",".(string)($current_standard_id+$i).")";
				mysql_query("SET NAMES UTF8");
				$sql_set_station_standard2 = mysql_query($add_station_standard) or die(mysql_error());
			}
			
		} 
		else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		$conn->close();
			
		header("location:manager_stations.php");
	}
	mysql_close();
?>
