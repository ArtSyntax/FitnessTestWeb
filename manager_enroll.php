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
				<li><a href="manager.html">Home</a></li>
				<li><a href="manager_tests.php">Tests</a></li>
				<li><a href="manager_stations.php">Stations</a></li>
				<li><a href="manager_enroll.php">Enrollment</a></li>
				<li><a href="#contact">Contact</a></li>
			</ul>

			<ul id="nav-mobile" class="side-nav">
				<li><a href="manager.html">Home</a></li>
				<li><a href="manager_tests.php">Tests</a></li>
				<li><a href="manager_stations.php">Stations</a></li>
				<li><a href="manager_enroll.php">Enrollment</a></li>
				<li><a href="#contact">Contact</a></li>
			</ul>
			<a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
		</div>
	</nav>



	<div class="container">
		<div class="row">
			<div class="col s12 m6 offset-m3">
				<h2 class="header center teal-text text-lighten-2">Enrollment</h2>
				<div class="row">
					<form class="col s12" method="post" action="enroll.php" enctype="multipart/form-data">
						<div class="row">
							<div class="input-field col s12">
								<input id="testcode" name="testcode" type="text" class="validate" required>
								<label for="testcode">Test Code</label>
							</div>
							<div class="input-field col s12">	
								<input id="password" name="password" type="password" class="validate" required>
								<label for="password">Admin password</label>
							</div>
							
							<div class="col s12 file-field input-field">
								<div class="btn">
									<span>File</span>
									<input type="file" name="fileCSV" id="fileCSV">
								</div>
								<div class="file-path-wrapper">
									<input class="file-path validate" type="text"  placeholder="เลือกไฟล์ .csv" required>
								</div>
							</div>
							
							<div class="input-field col s12 center">	
								<button class="btn btn-large waves-effect waves-light" type="submit" name="action" value="submit" id="btnSubmit">Submit</button>
							</div>
							<br><br>
						</div>
					</form>
				</div>
			</div>
			
			
			<div class="col s12">
				<br><br>
				<div class="divider"></div>
				<br>
			</div>
			
		</div>
	</div>


	<div class="container">
		<div class="row" style="margin-top: 10%">
			<div class="col s12">
				<h4 class="header teal-text text-lighten-2">การอัพโหลดไฟล์สำหรับลงทะเบียนผู้เข้าทดสอบล่วงหน้า<br><br></h4>
				<h5>
					ไฟล์ที่สามารถอัพโหลดได้ต้องมีนามสกุลไฟล์เป็น .csv และ encode ด้วย UTF-8 เท่านั้น เพื่อให้รองรับข้อมูลชื่อและนามสกุลที่เป็นภาษาไทย โดยข้อมูลในไฟล์มีองค์ประกอบดังนี้ id, firstname, lastname, gender, birthyear
				</h5>
			</div>
			<div class="col s12" style="margin-top: 20%">
				<h3 class="header teal-text text-lighten-2 center">ขั้นตอนการสร้างไฟล์เพื่ออัพโหลด</h3>
			</div>
		</div>
  
		<div class="row" style="margin-top: 10%">			
			<div class="col s12 m6">
				<img class="materialboxed" width="100%" src="img/csv_excel.png">
			</div>
			
			<div class="col s12 m6">
				<h4 class="header teal-text text-lighten-2"><i>1. สร้างไฟล์ด้วย Spreadsheet<br><br></i></h4>
				<h5>
					เช่น โปรแกรม Microsoft Excel โดยข้อมูลประกอบไปด้วยคอลัมน์ดังต่อไปนี้
					id, firstname, lastname, gender, birthyear<br>
					*ห้ามบันทึกไฟล์เป็นนามสกุล .xls หรือ .xlsx เลือกเป็น .csv เท่านั้น
				</h5>
			</div>
		</div>
		
		<div class="row"  style="margin-top: 20%">	
			<div class="col s12 m6">
				<img class="materialboxed" width="100%" src="img/csv_notepad.png">
			</div>
			
			<div class="col s12 m6">
				<h4 class="header teal-text text-lighten-2"><i><br><br>2. เปิดไฟล์ด้วย Notepad<br><br></i></h4>
				<h5>
					จะประกอบไปข้อมูลในลักษณะเดียวกัน
					แต่ข้อมูลจะถูกแบ่งกันด้วยเครื่องหมาย ,
				</h5>
			</div>
		</div>
		
		<div class="row"  style="margin-top: 20%">	
			<div class="col s12 m6">
				<img class="materialboxed" width="100%" src="img/csv_encode.png">
			</div>
			
			<div class="col s12 m6">
				<h4 class="header teal-text text-lighten-2"><i><br>3. การ encode UTF-8<br><br></i></h4>
				<h5>
					หลังจากเปิดไฟล์ด้วยโปรแกรม Notepad ให้ทำการกดบันทึกไฟล์และเลือกแถบ encodeing ด้านล่างเป็น UTF-8
				</h5>
			</div>
		</div>
		<h1><br></h1>
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
