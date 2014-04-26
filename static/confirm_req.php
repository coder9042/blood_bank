<?php
	if(!isset($_COOKIE['blood']))
	{
		header('Location: ../index.php');
	}
	else{
		include 'functions.php';
		confirmRequests($_GET['id']);
		header('Location: ../welcome.php');
	}
?>