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
			<div class="col s12 m6  offset-m3">
				<br><br><br><br><br><br>
				<h2 class="header center red-text text-lighten-2 red-text">{ Fail request }</h2>
				<br><br>
				<div class="row">
					<div class="input-field col s12 center">	
						<button class="btn btn-large waves-effect waves-light" onclick="goBack()"><i class="material-icons left">fast_rewind</i>Go Back</button>
					</div>
				</div>
				<br><br>
				<div class="divider"></div>
			</div>
		</div>
	</div>
	
  

	

	<!--  Scripts-->
	<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script src="js/materialize.js"></script>
	<script src="js/init.js"></script>
	<script src="js/goback.js"></script>

</body>
</html>
