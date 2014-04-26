<?php
	if(isset($_COOKIE['blood'])){
		include('functions.php');
		$id = $_GET['id'];
		$receipient = getUsr($id);
		$sender = getUsrByHash($_COOKIE['blood']);
		//echo $sender['name'].'-->'.$receipient['name'];
		$subject = "Need Blood: ".$sender['blood_group'];
		$message = "NJATH is now online. You can play the game here: \n"
		        . "http://anwesha.info/njath";
		$headers = 'From: ' . $sender['name'] . "\n" .'Reply-To: ' . $sender['name'];
		if(mail($receipient['email'], $subject, $message, $headers)){
			updateRequest($sender['id'], $receipient['id']);
			updateLog($sender['id'], $receipient['name'], 1);
		}
		else{
			updateLog($sender['id'], $receipient['name'], 0);
		}
		header('Location: ../welcome.php');
	}
?>