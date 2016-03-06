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
		$sql_create_test = 
				"INSERT INTO TEST(test_id, test_name, test_code)
				SELECT null,'"
				.(string)$_POST['testname'] ."', UPPER(LEFT(UUID(), 6)) AS TCODE
				FROM TEST 
				WHERE test_name = '"
				.(string)$_POST['testname'] ."' HAVING COUNT(*) = 0";
		
		if ($conn->query($sql_create_test) === TRUE) {
			echo "New record created successfully";
			
			// get test id
			mysql_query("SET NAMES UTF8");
			$sql_get_test_id = 
					mysql_query("SELECT test_id FROM TEST WHERE test_name = '".(string)$_POST['testname']."'")
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
			print_r($current_test_id);
			
			// count station in test
			mysql_query("SET NAMES UTF8");
			$sql_count_station = 
					mysql_query("SELECT COUNT(*) AS NUM FROM TEST_STATION WHERE test_id =".$current_test_id)
					or die(mysql_error()); 
			$rows = array();
			while($r = mysql_fetch_assoc($sql_count_station)) {
				$rows[] = $r;
			}
			
			$jsonTable = json_encode($rows);
			$json_output = json_decode($jsonTable); 
			$count_station = NULL;
			foreach ($json_output as $key)  
			{	
				$count_station = $key->NUM;
			} 
			print_r($count_station);
			
			// add station to test
			if(!empty($_POST['station']) and $count_station==0) {
				foreach($_POST['station'] as $check) {
					$add_station="INSERT INTO TEST_STATION(test_station_id, test_id, station_id)
							VALUES (null,".$current_test_id.",".$check.");";
										
					mysql_query("SET NAMES UTF8");
					$sql_test_station = mysql_query($add_station) or die(mysql_error()); 
				}
			}
		} 
		else {
			echo "Error: " . $sql_create_test . "<br>" . $conn->error;
		}
		$conn->close();
			
		header("location:manager_tests.php");
	}
	mysql_close();
?>
