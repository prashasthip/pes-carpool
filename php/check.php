<?php
session_start();
require_once 'connection2.php';
	extract($_GET);
	
	$qry = "SELECT * FROM student WHERE USN='$usn' AND EMAILID='$email'";
	$status = mysql_query($qry);
	//echo $status;
	//echo mysql_error();
	$row = mysql_fetch_array($status);
	$num = mysql_num_rows($status);
	// Username available
	if($num === 0)
	{
		$response = 'invalid';
	}
	else
	{
		$response = 'valid'; 
	}
	echo $response;
?>