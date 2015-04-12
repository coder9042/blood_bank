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
				item.className=(item.className=='list')?'list2':'list';
			}
			function change(str){
				var item = document.getElementById('searchbox');
				item.className = "hide";
				var item2 = document.getElementById('searchbox_name');
				item2.className = "hide";
				var item3 = document.getElementById('searchbox_age');
				item3.className = "hide";
				var item4 = document.getElementById('searchbox_blood_group');
				item4.className = "hide";



				var view_item = document.getElementById(str);
				view_item.className = "unhide";
			}
		</script>
	</head>
	<body>
		<div id="header">
			<img src="images/logo.jpg" width="45" height="100" />
			IITP Blood Bank
			<img src="images/logo.jpg" width="45" height="100" />
		</div>
		<div id="container">
			<div class="search" ng-controller="dataController">
				<p>
					Search
					<input id="searchbox" class="unhide" type="text" ng-model="searchText" placeholder="Search By Name, Age or Blood group" >
					<input id="searchbox_name" class="hide" type="text" ng-model="searchText.name" placeholder="Search By Name" >
					<input id="searchbox_blood_group" class="hide" type="text" ng-model="searchText.blood_group" placeholder="Search By Blood group" >
					<input id="searchbox_age" class="hide" type="text" ng-model="searchText.age" placeholder="Search By Age" >
					<br/>
					Any<input type="radio" name="type" value="Name" onclick="change('searchbox')"/>
					Name<input type="radio" name="type" value="Name" onclick="change('searchbox_name')"/>
					Age<input type="radio" name="type" value="Age" onclick="change('searchbox_age')"/>
					Blood Group<input type="radio" name="type" value="blood" onclick="change('searchbox_blood_group')"/><br/>
				</p>
			  <ul>
			    <li class="list" ng-repeat="v in vals | filter:searchText:strict" ng-show="searchText" id="{{v.name}}" onclick="expand(this);">
			    	{{v.name}} | {{v.sex}} | {{v.age}} | {{v.blood_group}}<br/>
			    	{{v.phone}} | {{v.email|lowercase}}<br/>
			    	Last Donated: {{v.last_donated}}
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
			Designed By: Anubhav Joshi | Ankita Paliwal
		</div>
	</body>
</html>