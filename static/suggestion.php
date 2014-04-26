<?php
	if(isset($_COOKIE['blood'])){
		if(isset($_POST['suggest'])){
			include('functions.php');
			$sub = $_POST['subject'];
			$body = $_POST['body'];
			addSuggestion($sub, $body);
			header('Location: ../welcome.php');
		}
	}
?>