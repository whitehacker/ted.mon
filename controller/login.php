<?php
	//Start session
	session_start();
	
	//Include database connection details
	require_once('inc/config.inc');
	
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	$errflag = false;
	
	//Connect to mysql server
	$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if(!$link) {
		die('Failed to connect to server: ' . mysql_error());
	}
	
	//Select database
	$db = mysql_select_db(DB_DATABASE);
	if(!$db) {
		die("Unable to select database");
	}
	
	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}
	
	//Sanitize the POST values
	$login = clean($_POST['secname']);
	$password = clean($_POST['secpass']);
	
	//Input Validations
	if($login == '') {
		$errmsg_arr[] = 'Login ID missing';
		$errflag = true;
	}
	if($password == '') {
		$errmsg_arr[] = 'Password missing';
		$errflag = true;
	}
	
	//If there are input validations, redirect back to the login form
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location: ../login.php");
		exit();
	}
	
	//Create query
	$qry="SELECT * FROM perm_members WHERE username='$login' AND password='".md5($_POST['secpass'])."'";
	$result=mysql_query($qry);
	
	//Check whether the query was successful or not
	if($result) {
		if(mysql_num_rows($result) == 1) {
			//Login Successful
			session_regenerate_id();
			$member = mysql_fetch_assoc($result);
			$_SESSION['SESS_USER_ID'] = $member['id'];
			$_SESSION['SESS_MEMBER_NAME'] = $member['username'];
			//$_SESSION['SESS_MEMBER_LAST'] = $member['lastname'];
			session_write_close();
			header("location: ../members/");
			exit();
		}else {
			//Login failed
			header("location: ../login.php");
			exit();
		}
	}else {
		die("Query failed");
	}
?>