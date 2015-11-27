<?php
	//Start session
	session_start();
 
	//Include database connection details
	require_once('connection.php');
	
 
	//Validation error flag
 
	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) 
        {
		$str = @trim ($str);
		if(get_magic_quotes_gpc ()) 
                {
			$str = stripslashes ($str);
                }
		return mysql_real_escape_string ($str);
	}
 
	//Sanitize the POST values
	extract($_GET);
	$pass = sha1($password);
	
	$check = mysql_query("SELECT * FROM register WHERE EMAIL = '$email' AND PASSWORD = '$pass'");
	$num = mysql_num_rows($check);
	// Error in either username or password
	if($num === 0)
	{
		$response = 'error';
	}
	else
	{
		// Setting up a session variable.
		$sql = "SELECT UID FROM register WHERE email='$email' limit 1";
		$result = mysql_query($sql);
		$value = mysql_fetch_object($result);
		$_SESSION['uid'] = $value->UID;
		$response = 'no_error';
	}
	echo $response;
?>