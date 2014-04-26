<?php
	include('functions.php');
	if(isset($_POST['register']))
	{
		$usrnm = $_POST['username'];
		$pwd = $_POST['pwd'];
		$pwd2 = $_POST['pwd2'];
		$name = $_POST['name'];
		$roll = $_POST['roll'];
		$age = $_POST['age'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$group = $_POST['group'];
		$res = insert_data($usrnm, $pwd, $pwd2, $name,$roll,$age,$email,$phone,$group);
		if($res == 1){
				$msg = 'Registered Successfully!!';
				header('Location: ../index.php?msg='.$msg);
		}
		else{
			echo $res;
		}
	}
	if(isset($_POST['edit']))
	{
		$name = $_POST['name'];
		$roll = $_POST['roll'];
		$age = $_POST['age'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$group = $_POST['group'];
		$res = edit_data($name,$roll,$age,$email,$phone,$group);
		if($res == 1){
			$user = getUsrByHash($_COOKIE['blood']);
			updateLog($user['id'], '', 2);
			header('Location: ../welcome.php');
		}
		else{
			echo $res;
		}
	}
?>