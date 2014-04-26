<!DOCTYPE html>
<?php
	if(isset($_COOKIE['blood']))
	{
		header('Location: welcome.php');
	}
?>
<html>
	<head>
		<title>IITP Blood Bank</title>
		<link rel="stylesheet" href="static/index.css" type="text/css" />
	</head>
	<body>
		<div id="header">
			<img src="images/logo.jpg" width="120" height="175" />
			IITP Blood Bank
			<img src="images/logo.jpg" width="120" height="175" />
		</div>
		<div id="container">
			<div class="login">
				<br/>
				<form action="static/login.php" method="post">
					Username:<br/>
					<input type="text" class="inp" name="name" required="required" /><br/>
					Password:<br/>
					<input type="password" class="inp" name="pwd" required="required" /><br/><br/>
					<?php
						if(isset($_GET['msg'])){
							echo $_GET['msg'];
						}
					?>
					<br/>
					<input type="submit" class="btn" name="login" value="Login">
				</form>
			</div>
			<div class="options">
				<ul>
					<li>
						<?php
						if(isset($_GET['msg'])){
							echo '<a href="index.php">HOME</a>';
						}
						else{
							echo '<a href="#">HOME</a>';
						}

						?>
					</li>
					<li><a href="register.html">REGISTER</a></li>
					<li><a href="eligibility.html">ELIGIBILTY</a></li>
					<li><a href="related.html">RELATED</a></li>
				</ul>
				<br/><br/>
				<p>
					Five minutes of your time + 350 ml. of your blood ==> One life saved.
				</p>
				<p>
					To the young and healthy it's no loss.<br/>
					To sick it's hope of life.<br/>
					Donate Blood to give back life.
				</p>
				<p>
					The finest gesture one can make is to save life by donating Blood.
				</p>
			</div>
		</div>
		<div id="footer">
			Copyright &copy IIT Patna<br/>
			Designed By: Anubhav Joshi | Ankita Paliwal | Manvee | Rishita K
		</div>
	</body>
</html>