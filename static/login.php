<?php
	include('functions.php');
	if(isset($_POST['login']))
	{
		$usr = $_POST['name'];
		$pwd = $_POST['pwd'];
		$res = login($usr, $pwd);
		if($res){
			$cookie = $res['user_hash'];
			//echo $cookie;
			setcookie('blood',$cookie,time()+60*24*60*60, '/');
			header('Location: ../welcome.php');
		}
		else{
			$msg = 'Wrong Username or Password';
			header('Location: ../index.php?msg='.$msg);
		}
	}
?>