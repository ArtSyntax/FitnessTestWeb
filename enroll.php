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
		print_r("Test ID --> ".$current_test_id);
		
		if ($current_test_id != null)
		{
			// count old user
			mysql_query("SET NAMES UTF8");
			$sql_count_old_user = 
					mysql_query("SELECT COUNT( * ) AS OLD FROM USER") or die(mysql_error()); 
			$rows = array();
			while($r = mysql_fetch_assoc($sql_count_old_user)) {
				$rows[] = $r;
			}
			$jsonTable = json_encode($rows);
			$json_output = json_decode($jsonTable); 
			$count_old = 0;
			foreach ($json_output as $key)  
			{	
				$count_old = intval($key->OLD);
			} 
			print_r("<br> count old --> ".$count_old);
			
			// add user from csv to database
			$path = "/tmp/" . $_FILES["fileCSV"]["name"];
			move_uploaded_file($_FILES["fileCSV"]["tmp_name"],$path); // Copy/Upload CSV
			$objConnect = mysql_connect($servername, $username, $password) or die("Error Connect to Database"); 
			$objDB = mysql_select_db("healthTest");
			$objCSV = fopen($path, "r");
			$firstline = true;
			while (($objArr = fgetcsv($objCSV, ",")) !== FALSE) {
				if($firstline) 
				{
					$firstline=false;
					continue;
				}	
				mysql_query("SET NAMES UTF8");
				$strSQL = "INSERT INTO USER (id, firstname, lastname, gender, birthyear) 
							SELECT '".$objArr[0]."','".$objArr[1]."','".$objArr[2].
							"','".$objArr[3]."','".$objArr[4]."' 
							FROM USER INNER JOIN TEST_ENROLLMENT 
							ON TEST_ENROLLMENT.user_id = USER.user_id
							WHERE USER.id = '".$objArr[0]."' 
							AND TEST_ENROLLMENT.test_id = '".$current_test_id."' HAVING COUNT(*) = 0";
				print $strSQL."<br>";
				$objQuery = mysql_query($strSQL);
			}
			fclose($objCSV);
			echo "<br> Upload & Import Done.";
			
			// count new user
			mysql_query("SET NAMES UTF8");
			$sql_count_new_user = 
					mysql_query("SELECT COUNT( * ) AS NEWU FROM USER") or die(mysql_error()); 
			$rows = array();
			while($r = mysql_fetch_assoc($sql_count_new_user)) {
				$rows[] = $r;
			}
			$jsonTable = json_encode($rows);
			$json_output = json_decode($jsonTable); 
			$count_new = 0;
			foreach ($json_output as $key)  
			{	
				$count_new = intval($key->NEWU);
			} 
			print_r("<br> count new --> ".$count_new);
			$count = $count_new - $count_old;
						
			// get new first user ID
			mysql_query("SET NAMES UTF8");
			$sql_get_user_id = 
					mysql_query("SELECT MAX(user_id) AS MAXID FROM USER") or die(mysql_error()); 
			$rows = array();
			while($r = mysql_fetch_assoc($sql_get_user_id)) {
				$rows[] = $r;
			}
			
			$jsonTable = json_encode($rows);
			$json_output = json_decode($jsonTable); 
			$first_user_id = NULL;
			foreach ($json_output as $key)  
			{	
				$first_user_id = intval($key->MAXID)-$count+1;
			} 
			print_r("<br> new first user id --> ".$first_user_id);
			
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
			for($i=0;$i<$count;$i++)
			{
				$add_user="INSERT INTO TEST_ENROLLMENT(user_tag, user_id, test_id) 
						VALUES (".($old_user_tag+1+$i).",".($first_user_id+$i).",".$current_test_id.");";			
				mysql_query("SET NAMES UTF8");
				$sql_enroll = mysql_query($add_user) or die(mysql_error()); 
			}
			
			print "<br><br> success";
			header("location:complete.php");
		}
		else // not found test code
		{
			header("location:fail.php");
		}
		
		$conn->close();
	}
	mysql_close();
?>
