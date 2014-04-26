<?php
	function insert_data($usrnm, $pwd, $pwd2, $name,$roll,$age,$email,$phone,$group)
	{
		include('db.php');
		$error = '';
		$name = strtoupper($name);
		$roll = strtoupper($roll);
		$group = strtoupper($group);
		if($pwd != $pwd2){
			$error.= "The two passwords do not match.<br/>";
		}
		if($age > 120)
		{
			$error.= "Please enter a valid age.<br/>";
		}
		if(strlen($phone) != 10)
		{
			$error.="Please enter a valid 10 digit mobile number.<br/>";
		}
		if(preg_match('/^([A-Za-z]{1,2})[+-]$/', $group, $matches) == false)
		{
			$error.="Enter blood group properly.";
		}
		if($error)
		{
			return $error;
		}
		$q = "INSERT INTO records(username, user_hash, password, name, roll, age, email, phone, blood_group) VALUES('$usrnm',SHA('$usrnm'),SHA('$pwd'),'$name', '$roll', $age, '$email', $phone, '$group')";
		$res=mysqli_query($dbc, $q)or die('Error querying with the database.');
		if($res)
		{
			//Code here
			get_data();
			return 1;
		}
		mysqli_close($dbc);
	}
	function edit_data($name,$roll,$age,$email,$phone,$group)
	{
		include('db.php');
		$error = '';
		$name = strtoupper($name);
		$roll = strtoupper($roll);
		$group = strtoupper($group);
		if($pwd != $pwd2){
			$error.= "The two passwords do not match.<br/>";
		}
		if($age > 120)
		{
			$error.= "Please enter a valid age.<br/>";
		}
		if(strlen($phone) != 10)
		{
			$error.="Please enter a valid 10 digit mobile number.<br/>";
		}
		if(preg_match('/^([A-Za-z]{1,2})[+-]$/', $group, $matches) == false)
		{
			$error.="Enter blood group properly.";
		}
		if($error)
		{
			return $error;
		}
		$usr = getUsrByHash($_COOKIE['blood']);
		$id = $usr['id'];
		$q = "UPDATE records SET `name`='$name', `roll`='$roll', `age`=$age, `email`='$email', `blood_group`='$group', `phone`='$phone' WHERE `id`=$id ";
		$res=mysqli_query($dbc, $q)or die('Error querying with the database.');
		if($res)
		{
			//Code here
			get_data();
			return 1;
		}
		mysqli_close($dbc);
	}
	function login($usr, $pwd)
	{
		include('db.php');
		$q = "SELECT * FROM records WHERE `username` = '$usr' AND `password` = SHA('$pwd')";
		$res = mysqli_query($dbc, $q);
		mysqli_close($dbc);
		if($res)
		{
			$row = mysqli_fetch_array($res);
			return $row;
		}
		else
		{
			return 0;
		}
	}
	function get_data()
	{
		include('db.php');
		$q = "SELECT * FROM records WHERE 1";
		$res=mysqli_query($dbc, $q)or die('Error querying with the database.');
		$num = mysqli_num_rows($res);
		$file = fopen("data.json","w");
		fwrite($file,"{\n");
		fwrite($file,'"vals": [');
		fwrite($file, "\n");
		if($res)
		{
			while($row=mysqli_fetch_array($res))
			{
				//$json[]=$row;
				//fwrite($file, $row);
				fwrite($file,"{\n");
				$str = '"id": ';
				$str = $str.'"'.$row['id'].'"'.",\n";
				$str1 = '"name": ';
				$str1 = $str1.'"'.$row['name'].'"'.",\n";
				$str2 = '"roll": ';
				$str2 = $str2.'"'.$row['roll'].'"'.",\n";
				$str3 = '"email": ';
				$str3 = $str3.'"'.$row['email'].'"'.",\n";
				$str4 = '"phone": ';
				$str4 = $str4.'"'.$row['phone'].'"'.",\n";
				$str5 = '"blood_group": ';
				$str5 = $str5.'"'.$row['blood_group'].'"'.",\n";
				$str6 = '"age": ';
				$str6 = $str6.'"'.$row['age'].'"'."\n";
				fwrite($file, $str);
				fwrite($file, $str1);
				fwrite($file, $str2);
				fwrite($file, $str3);
				fwrite($file, $str4);
				fwrite($file, $str5);
				fwrite($file, $str6);
				$num = $num-1;
				//fwrite($file,"},\n");
				if ($num != 0)
				{
					fwrite($file, "},\n");
				}
				else
				{
					fwrite($file, "}\n");
				}
			}
		}
		fwrite($file,"]\n");
		fwrite($file, "}\n");
		mysqli_close($dbc);
		//$val = '{"data": '.json_encode($json).'}';
		fclose($file);
	}
	//$res = insert_data('vaibhav.cs12','vaibhav','vaibhav','1201cs36', 20, 'vaibhav.cs12@iitp.ac.in',8123456789,'ab+');
	//echo $res;
	function getUsr($id){
		include('db.php');
		$q = "SELECT * FROM records WHERE id=$id";
		$res = mysqli_query($dbc,$q) or die('Error querying with the database.');
		$data = mysqli_fetch_array($res);
		mysqli_close($dbc);
		return $data;
	}
	function getUsrByName($nm){
		include('db.php');
		$q = "SELECT * FROM records WHERE name=$nm";
		$res = mysqli_query($dbc,$q) or die('Error querying with the database.');
		$data = mysqli_fetch_array($res);
		mysqli_close($dbc);
		return $data;
	}
	function getUsrByHash($id){
		include('db.php');
		$q = "SELECT * FROM records WHERE user_hash='$id'";
		$res = mysqli_query($dbc,$q) or die('Error querying with the database.');
		$data = mysqli_fetch_array($res);
		mysqli_close($dbc);
		return $data;
	}
	function updateLog($id, $rec_nm, $val){
		include('db.php');
		$str='';
		$str2='';
		if($val == 1){
			$str = 'Request for blood donation sent to '.$rec_nm;
			$str2 = 'Request for blood donation received from '.$id;
		}
		if($val == 2){
			$str = 'Details Updated!!';
		}
		if($val == 0){
			$str = 'Request for blood donation to '.$rec_nm.' failed.';
		}
		if($val == 3){
			$str = 'Suggestion sent!!';
		}
		if($val == 4){
			$str = 'Blood Donation confirmation received from '.$rec_nm;
		}
		if($val == 5){
			$str = 'Blood Donation confirmation sent to '.$rec_nm;
		}
		$timestamp = date("Y-m-d H:i:s");
		$q = "INSERT INTO activity_log(user_id, activity, timelog) VALUES('$id', '$str', '$timestamp')";
		$res = mysqli_query($dbc,$q) or die('Error querying with the database.');
		if($val == 1){
			$id = getUsrByName($rec_nm);
			$id = $id['id'];
			$q2 = "INSERT INTO activity_log(user_id, activity, timelog) VALUES('$id', '$str2', '$timestamp')";
			$res2 = mysqli_query($dbc,$q) or die('Error querying with the database.');
		}
		mysqli_close($dbc);
	}
	function getLog(){
		include('db.php');
		$id = getUsrByHash($_COOKIE['blood']);
		$id = $id['id'];
		$q = "SELECT * FROM `activity_log` WHERE `user_id`=$id ORDER BY `id` DESC";
		$res = mysqli_query($dbc,$q) or die('Error querying with the database.');
		mysqli_close($dbc);
		return $res;
	}
	function clear(){
		include('db.php');
		$id = getUsrByHash($_COOKIE['blood']);
		$id = $id['id'];
		$q = "DELETE FROM activity_log WHERE `user_id`=$id";
		$res = mysqli_query($dbc,$q) or die('Error querying with the database.');
		mysqli_close($dbc);
	}
	function updateRequest($s, $r){
		include('db.php');
		$q = "INSERT INTO requests(sender, receipient) VALUES($s, $r)";
		$res = mysqli_query($dbc,$q) or die('Error querying with the database.');
		mysqli_close($dbc);
	}
	function getRequests($r){
		include('db.php');
		$id = getUsrByHash($r);
		$id = $id['id'];
		$q = "SELECT * FROM requests WHERE `receipient` = $id AND `response`=0";
		$res = mysqli_query($dbc, $q)or die('Error querying with the database');
		mysqli_close($dbc);
		return $res;
	}
	function confirmRequests($id){
		include('db.php');
		$usr = getUsrByHash($_COOKIE['blood']);
		$q = "SELECT * FROM requests WHERE id=$id";
		$res = mysqli_query($dbc, $q)or die('Error querying with the database');
		$db_usr = mysqli_fetch_array($res);
		if($db_usr['receipient'] == $usr['id']){
			$q = "UPDATE requests SET `response`=1 WHERE id=$id";
			$res = mysqli_query($dbc, $q)or die('Error querying with the database');
			if($res){
				updateLog($db_usr['sender'], $usr['name'], 4);
				$sender = getUsr($db_usr['sender']);
				updateLog($db_usr['receipient'], $sender['name'], 5);
			}
		}
		mysqli_close($dbc);
	}
	function addSuggestion($s, $b){
		include('db.php');
		$id = getUsrByHash($_COOKIE['blood']);
		$id = $id['id'];
		$q = "INSERT INTO suggestion(user_id, subject, suggestion) VALUES($id, '$s', '$b')";
		$res = mysqli_query($dbc, $q) or die('Error querying with the database.');
		if($res){
			updateLog($id, '', 3);
		}
		mysqli_close($dbc);
	}
?>