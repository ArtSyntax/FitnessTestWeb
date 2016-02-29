<?php
	$servername = "localhost";
	$username = "art";
	$password = "art12345678";
	$dbname = "healthTest";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

	$sql = 
	"INSERT INTO USER (id, email, password, gender, birthyear)
	VALUES ('".(string)$_POST['id'] ."', '"
	.(string)$_POST['email'] ."', '"
	.(string)md5($_POST['pass']) ."', '"
	.(string)$_POST['gender'] ."', '"
	.(string)(date("Y")-$_POST['year']+1) ."')";
	

	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully";
	} 
	else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	$conn->close();
?>
