<!DOCTYPE html>
<?php
	if(!isset($_COOKIE['blood']))
	{
		header('Location: index.php');
	}
	include('static/functions.php');
	$usr = getUsrByHash($_COOKIE['blood']);
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
			    	{{v.phone}}<br/>
			    	{{v.email|lowercase}}
			    	<a href="static/mail.php?id={{v.id}}">Mail</a><br/>
			    </li>
			  </ul>
			</div>
			<div class="main">
				<p style="text-align:center">
					Personal Details
				</p>
				<p>
					<form action="static/register.php" method="post">
					Name:<br/>
					<input type="text" class="inp" name="name" required="required" value="<?php echo $usr['name']; ?>" /><br/>
					Roll Number:<br/>
					<input type="text" class="inp" name="roll" required="required" value="<?php echo $usr['roll']; ?>" /><br/>
					Age:<br/>
					<input type="text" class="inp" name="age" required="required" value="<?php echo $usr['age']; ?>" /><br/>
					Phone:<br/>
					<input type="text" class="inp" name="phone" required="required" value="<?php echo $usr['phone']; ?>" /><br/>
					Blood Group:<br/>
					<input type="text" class="inp" name="group" required="required" value="<?php echo $usr['blood_group']; ?>" /><br/>
					Email:<br/>
					<input type="email" class="inp" name="email" required="required" value="<?php echo $usr['email']; ?>" /><br/><br/>
					<input type="submit" class="btn" value=" Save " name="edit" /><br/>
					</form>
				</p>
			</div>
			<div class="options">
				<ul>
					<li><a href="welcome.php">HOME</a></li>
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