<?php
	include('functions.php');
	if(isset($_POST['register']))
	{
		$usrnm = $_POST['username'];
		$pwd = $_POST['pwd'];
		$pwd2 = $_POST['pwd2'];
		$name = $_POST['name'];
		$sex = $_POST['sex'];
		$age = $_POST['age'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$group = $_POST['group'];
		$last = $_POST['last'];
		if(empty($last)){
			$last = 'Never donated';
		}

		echo $_FILES["uploads"]['name'];

		if(empty($_FILES["uploads"]['name'])){
			$res = insert_data($usrnm, $pwd, $pwd2, $name,$sex,$age,$email,$phone,$group,'', $last);
			if($res == 1){
					$msg = 'Registered Successfully!!';
					header('Location: ../index.php?msg='.$msg);
			}
			else{
				echo $res;
			}
		}
		else{
			$target_dir = "../uploads/";
			$target_file = $target_dir . basename($_FILES["uploads"]["name"]);

			$uploadOk = 1;
			if ($_FILES["uploads"]["size"] > 500000) {
			    echo "Sorry, your file is too large.";
			    $uploadOk = 0;
			}

			$uploaded = 1;
			if($uploadOk == 1){
				if (move_uploaded_file($_FILES["uploads"]["tmp_name"], $target_file)) {
				    $uploaded = 1;
				} else {
				    $uploaded = 0;
				}

				if($uploaded == 1)
				{
					$res = insert_data($usrnm, $pwd, $pwd2, $name,$sex,$age,$email,$phone,$group, $_FILES['uploads']['name'], $last);
					if($res == 1){
							$msg = 'Registered Successfully!!';
							header('Location: ../index.php?msg='.$msg);
					}
					else{
						echo $res;
					}
				}
				else{
					echo "Error in uploading the file";
				}
			}
			else{
				echo 'File is too large.';
			}
		}

		
	}
	if(isset($_POST['edit']))
	{
		$name = $_POST['name'];
		$sex = $_POST['sex'];
		$age = $_POST['age'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$group = $_POST['group'];
		$last = $_POST['last'];
		if(empty($last)){
			$last = 'Never donated';
		}

		echo $_FILES["uploads"]['name'];

		if(empty($_FILES["uploads"]['name'])){
			$res = edit_data($name,$sex,$age,$email,$phone,$group,'', $last);
			if($res == 1){
					$user = getUsrByHash($_COOKIE['blood']);
					updateLog($user['id'], '', 2);
					header('Location: ../welcome.php');
			}
			else{
				echo $res;
			}
		}
		else{
			$target_dir = "../uploads/";
			$target_file = $target_dir . basename($_FILES["uploads"]["name"]);

			$uploadOk = 1;
			if ($_FILES["uploads"]["size"] > 500000) {
			    echo "Sorry, your file is too large.";
			    $uploadOk = 0;
			}

			$uploaded = 1;
			if($uploadOk == 1){
				if (move_uploaded_file($_FILES["uploads"]["tmp_name"], $target_file)) {
				    $uploaded = 1;
				} else {
				    $uploaded = 0;
				}

				if($uploaded == 1)
				{
					$res = edit_data($name,$sex,$age,$email,$phone,$group, $_FILES['uploads']['name'], $last);
					if($res == 1){
							$user = getUsrByHash($_COOKIE['blood']);
							updateLog($user['id'], '', 2);
							header('Location: ../welcome.php');
					}
					else{
						echo $res;
					}
				}
				else{
					echo "Error in uploading the file";
				}
			}
			else{
				echo 'File is too large.';
			}
		}
	}
?>