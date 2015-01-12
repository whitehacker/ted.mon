<?php
session_start();
include('inc/config.inc');
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
		//Gets the current configuration setting of magic_quotes_gpc
		//Sets the magic_quotes state for GPC (Get/Post/Cookie) operations. When magic_quotes are on, all ' (single-quote), " (double quote), \ (backslash) and NUL's are escaped with a backslash automatically. 
			$str = stripslashes($str);
			
			//Un-quotes a quoted string
		}
		return mysql_real_escape_string($str);
		
		//Escapes special characters in a string for use in an SQL statement
	}
	
	// Random confirmation code 
	$confirm_code=md5(uniqid(rand())); 
	
	//Sanitize the POST values
	$username = clean($_POST['uname']);
	$email = clean($_POST['email']);
	$pass = clean($_POST['pass']);
	$confPass=clean($_POST['repass']);
	
	//Input Validations
	
	if($email == '') {
		$errmsg_arr[] = 'ایمیل آدرس خویش را بنویسید!';
		$errflag = true;
	}
	if($pass !=''){
	if(strlen($pass)<6) {
		$errmsg_arr[] = 'شفر باید حد اقل شش حرف و عدد باشد!';
		$errflag = true;
	}
	}
	if($pass == '') {
		$errmsg_arr[] = 'شفر را بنویسید!';
		$errflag = true;
	}
	
	
	if($username !='' && $pass !=''){
	if( strcmp($pass, $username) == 0 ) {
		$errmsg_arr[] = 'کلمات ایمیل و شفر شما یکسان بوده باید شفر متفاوت را داخل نمایید!';
		$errflag = true;
	}	
	}
	
		//Check for duplicate login ID
	if($username != '') {
		$qry = "SELECT * FROM perm_members WHERE username='$username'";
		$result = mysql_query($qry);
		if($result) {
			if(mysql_num_rows($result) > 0) {
				$errmsg_arr[] = 'این ایمیل آدرس از قبل موجود میباشد!';
				$errflag = true;
			}
			//will free all memory associated with the result identifier result. 
		}
		else {
			die("Query failed");
		}
	}
	
		//If there are input validations, redirect back to the registration form
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		//Write session data and end session
		header("location: ../register.php");
		exit();
	}

	
	//Create INSERT query
	$qry = "INSERT INTO temp_members(username, email, password,confirm_code) VALUES('$username','$email','$pass','$confirm_code')";
	$result = @mysql_query($qry);
	

// if suceesfully inserted data into database, send confirmation link to email 
if($result) {
		unset($_SESSION['SESS_USER_PIN']);
		header("location: ../dashboard.php");
		exit();
	}else {
		die("Error Occured!" . mysql_error());
	}
?>