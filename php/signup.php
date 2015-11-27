<?php
	session_start();
	require_once 'connection.php';
	
	// Prevent SQL Injection.
	function clean($str) 
    {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) 
        {
			$str = stripslashes($str);
        }
		return mysql_real_escape_string($str);
	}

		$usn = clean($_POST['usn']);
		$name = clean($_POST['name']);
		$sem = clean($_POST['sem']);
		$email = clean($_POST['email']);
		$password = clean($_POST['password']);
		$telephone = clean($_POST['telephone']);
		$gender = clean($_POST['gender']);
		$address = clean($_POST['address']);
		$own = clean($_POST['own']);
		$pick = clean($_POST['pick']);
		$prefer = clean($_POST['prefer']);

		// Encryption
		$pass = sha1($password);
		$query = "INSERT INTO register(USN, NAME, SEM, PASSWORD , PHONE , ADDRESS, OWNCAR,PICKUP,PREFERENCE,GENDER,EMAIL) VALUES ('$usn','$name','$sem','$pass','$telephone','$address','$own','$pick','$prefer','$gender','$email')";
		$state = mysql_query($query);

		if($state)
		{
			
			$sql = "SELECT UID FROM register WHERE usn='$usn' limit 1";
			$result = mysql_query($sql);
			$value = mysql_fetch_object($result);
			$_SESSION['uid'] = $value->UID;
			// Setting up a session variable.
			//$_SESSION['uid'] = $username;
			$response = 'no_error';
		}
		else
		{
			$response = 'error';
		}
		echo $response;
?>