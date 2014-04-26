<?php
	if(!isset($_COOKIE['blood']))
	{
		header('Location: index.php');
	}
?>
<html lang="en" ng-app="dataApp">
	<head>
		<title>IITP Blood Bank</title>
		<link rel="stylesheet" href="static/welcome.css" type="text/css" />
		<script src="static/angular.js"></script>
		<script src="static/app.js"></script>
		<script type="text/javascript">
			function expand(item){
				item.className='list2';
			}
		</script>
	</head>
	<body>
		<div id="header">
			<img src="images/logo.jpg" width="120" height="175" />
			IITP Blood Bank
			<img src="images/logo.jpg" width="120" height="175" />
		</div>
		<div id="container">
			<div class="search" ng-controller="dataController">
				<p>
					Search
					<input type="text" ng-model="searchText" placeholder="Search By Name, Roll No. or Blood group" ><br/>
				</p>
			  <ul>
			    <li class="list" ng-repeat="v in vals | filter:searchText" ng-show="searchText" id="{{v.name}}" onclick="expand(this);">
			    	{{v.name}} | {{v.roll}} | {{v.blood_group}}<br/>
			    	{{v.phone}}| {{v.email}}<br/>
			    	<a href="static/mail.php?id={{v.id}}">Mail</a><br/>
			    </li>
			  </ul>
			</div>
			<div class="main">
				<p style="text-align:center">
					Activity Log
				</p>
				<p>
					<ol>
						<?php
							include('static/functions.php');
							$res = getLog();
							while($log=mysqli_fetch_array($res)){
								echo '<li>'.$log['activity'].'<br/>('.$log['timelog'].')</li>';
							}
						?>
					</ol>
				</p>
			</div>
			<div class="options">
				<ul>
					<li><a href="#">HOME</a></li>
					<li><a href="static/clear.php">CLEAR ACTIVITY</a></li>
					<li><a href="requests.php">REQUESTS</a></li>
					<li><a href="edit.php">EDIT DETAILS</a></li>
					<li><a href="suggestions.php">SUGGESTIONS</a></li>
					<li><a href="static/logout.php">LOGOUT</a></li>
				</ul>
			</div>
		</div>
		<div id="footer">
			Copyright &copy IIT Patna<br/>
			Designed By: Anubhav Joshi | Ankita Paliwal | Manvee | Rishita K
		</div>
	</body>
</html>