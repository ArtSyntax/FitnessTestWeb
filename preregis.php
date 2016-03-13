<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title>Health Test</title>
  <link href="img/icon.png" rel="shortcut icon" type="image/x-icon">

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  
</head>

<body>
	<nav class="white" role="navigation" id="home">
		<div class="nav-wrapper container">
			<a id="logo-container" href="index.html" class="brand-logo"> <img src="img/logo.png" alt="HealthTest" height="60" width="60"> </a>
			<ul class="right hide-on-med-and-down">
				<li><a href="index.html#home">Home</a></li>
				<li><a href="index.html#about">About</a></li>
				<li><a href="#contact">Contact</a></li>
				<li><a href="#">Pre-regis</a></li>
				<li><a href="result.php">Result</a></li>				
			</ul>

			<ul id="nav-mobile" class="side-nav">
				<li><a href="index.html#home">Home</a></li>
				<li><a href="index.html#about">About</a></li>
				<li><a href="#contact">Contact</a></li>
				<li><a href="#">Pre-regis</a></li>
				<li><a href="result.php">Result</a></li>				
			</ul>
			<a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
		</div>
	</nav>
  
  
	<div class="container">
		<div class="row">
			<div class="col s12 m6 offset-m3">
				<h2 class="header center teal-text text-lighten-2">Pre-regis</h2>
				<div class="row">
					<form class="col s12" method="post" action="check_preregis.php">
						<div class="row">
							<div class="input-field col s12">
								<input id="testcode" name="testcode" type="text" class="validate" required>
								<label for="testcode">Test code</label>
							</div>
							<div class="input-field col s12">	
								<input id="id" name="id" type="text" class="validate" required>
								<label for="id">ID</label>
							</div>
							<div class="input-field col s12">	
								<button class="btn btn-large waves-effect waves-light" type="submit" name="action">Submit</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	
	<div class="container">
		<div class="section">
			<div class="row">
				<div class="col s12 m10 offset-m1 left">
					<ul class="collection with-header">
						<li class="collection-header center teal lighten-2 white-text text-lighten-2">
							<h3>รายชื่อผู้เข้าทดสอบ </h3>
						</li>
					
						<table class="highlight">
							<thead>
								<tr>
									<th data-field="id">รหัส</th>
									<th data-field="firstname">ชื่อ</th>
									<th data-field="lastname">สกุล</th>
									<th data-field="tag_id">หมายเลขทดสอบ</th>
								</tr>
							</thead>
						
							<tbody>
								<?php	
									$host = "localhost";
									$user = "art";
									$pass = "art12345678";
									$dbname="healthTest"; 
									$conn=mysql_connect($host,$user,$pass) or die("Can't connect");
									mysql_select_db($dbname) or die(mysql_error()); 
									
									mysql_query("SET NAMES UTF8");
									$user_enroll = mysql_query("SELECT USER.id, USER.firstname, USER.lastname, 
											TEST_ENROLLMENT.user_tag FROM USER 
											INNER JOIN TEST_ENROLLMENT 
											ON USER.user_id = TEST_ENROLLMENT.user_id 
											INNER JOIN TEST 
											ON TEST.test_id = TEST_ENROLLMENT.test_id			
											WHERE TEST.test_code = '".$_GET["testcode"]."'
											AND USER.id = '".$_GET["id"]."'
											ORDER BY USER.id ASC, USER.firstname ASC")
											or die(mysql_error()); 
											
									$rows = array();
									while($r = mysql_fetch_assoc($user_enroll)) {
										$rows[] = $r;
									}
									$jsonTable = json_encode($rows);		
									$json_output = json_decode($jsonTable); 
									foreach ($json_output as $key)  
									{	
										print "<tr>";
										print"<td>{$key->id}</td>";
										print"<td>{$key->firstname}</td>";
										print"<td>{$key->lastname}</td>";
										print"<td>{$key->user_tag}</td>";
										print "</tr>";
									} 	
								?>
								
							</tbody>
						</table>
					
					</ul>
				</div>
			</div>
			<h1><br><br></h1>
		</div>
	</div>
  
	<footer class="page-footer teal" id="contact">
		<div class="container">
			<div class="row">
				<div class="col l8 s12">
					<h5 class="white-text">Company Bio</h5>
					<p class="grey-text text-lighten-4">โครงงานบูรณาการร่วมระหว่างวิศวกรรมคอมพิวเตอร์และศึกษาศาสตร์ มหาวิทยาลัยเกษตรศาสตร์วิทยาเขตบางเขน เพื่อพัฒนาระบบการทดสอบสมรรถภาพทางกายให้สะดวกยิ่งขึ้น และสามารถประเมินผลได้อย่างถูกต้อง แม่นยำ และรวดเร็ว</p>
				</div>

				<div class="col l4 s12">
					<h5 class="white-text">Contact</h5>
					<ul>
						<li><a class="white-text" href="http://iwing.cpe.ku.ac.th">http://iwing.cpe.ku.ac.th</a></li>
						<li><a class="white-text" href="http://edu.ku.ac.th">http://edu.ku.ac.th</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="footer-copyright">
			<div class="container">
				<div class="row">
					<div class="col l8 s12">
						All rights reserved. 2016
					</div>
					<div class="col l4 s12">
						Made by <a class="brown-text text-lighten-3" href="http://iwing.cpe.ku.ac.th">IWING</a>
					</div>
				</div>
			</div>
		</div>
	</footer>

	<!--  Scripts-->
	<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script src="js/materialize.js"></script>
	<script src="js/init.js"></script>

</body>
</html>
