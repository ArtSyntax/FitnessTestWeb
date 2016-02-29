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
		} 
		else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		$conn->close();
			
		header("location:manager_stations.php");
	}
	mysql_close();
?>
