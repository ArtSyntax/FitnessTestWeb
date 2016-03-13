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
				<li><a href="preregis.php">Pre-regis</a></li>
				<li><a href="result.php">Result</a></li>
			</ul>

			<ul id="nav-mobile" class="side-nav">
				<li><a href="index.html#home">Home</a></li>
				<li><a href="index.html#about">About</a></li>
				<li><a href="#contact">Contact</a></li>
				<li><a href="preregis.php">Pre-regis</a></li>
				<li><a href="result.php">Result</a></li>
			</ul>
			<a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
		</div>
	</nav>
	
	<div class="container" id="input">
		<div class="section">
			<div class="row">
				<div class="col s12 center">
				<h2 class="header center teal-text text-lighten-2">Test code</h2>
					<div class="row">
						<form class="col s12 m6 offset-m3" method="post" action="">
							<div class="row">
								<div class="input-field col s12">	
									<input id="id" name="id" type="text" class="validate">
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
	</div>	
	
	<div class="container" id="person_result">
		<div class="section">
			<div class="row">
				<div class="col s12 center">
					<h3><i class="medium material-icons brown-text">equalizer</i></h3>
					<h4>Personal result</h4>
					
				</div>
			</div>
		</div>
	</div>
	
	<div class="container" id="overall_result">
		<div class="section">
			<div class="row">
				<div class="col s12 center">
					<h3><i class="medium material-icons brown-text">trending_up</i></h3>
					<h4>Overall result</h4>
					
				</div>
			</div>
		</div>
	</div>	
	
	<div class="container" id="execution">
		<div class="section">
			<div class="row">
				<div class="col s12 center">
					<h3><i class="medium material-icons brown-text">loop</i></h3>
					<h4>Execution</h4>
					
				</div>
			</div>
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
