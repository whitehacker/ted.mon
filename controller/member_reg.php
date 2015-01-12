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
	if($username == '') {
		$errmsg_arr[] = 'Login name missing';
		$errflag = true;
	}
	if($email == '') {
		$errmsg_arr[] = 'Email Address missing';
		$errflag = true;
	}
	if($pass !=''){
	if(strlen($pass)<6) {
		$errmsg_arr[] = 'Password is too short, Minimium 6 characters';
		$errflag = true;
	}
	}
	if($pass == '') {
		$errmsg_arr[] = 'Password missing';
		$errflag = true;
	}
	if($confPass == '') {
		$errmsg_arr[] = 'Confirm password missing';
		$errflag = true;
	}
	if( strcmp($pass, $confPass) != 0 ) {
		$errmsg_arr[] = 'Passwords do not match';
		$errflag = true;
	}
	if($username !='' && $pass !=''){
	if( strcmp($pass, $username) == 0 ) {
		$errmsg_arr[] = 'Your Username and Passwords are the same, please enter another password, which does not match with your Username or Email';
		$errflag = true;
	}	
	}
	
		//Check for duplicate login ID
	if($username != '') {
		$qry = "SELECT * FROM perm_members WHERE username='$username'";
		$result = mysql_query($qry);
		if($result) {
			if(mysql_num_rows($result) > 0) {
				$errmsg_arr[] = 'The Username is already in use, please use another one.';
				$errflag = true;
			}
			//will free all memory associated with the result identifier result. 
		}
		else {
			die("Query failed");
		}
	}
	
	if($username != '') {
		$qry = "SELECT * FROM perm_members WHERE email='$email'";
		$result = mysql_query($qry);
		if($result) {
			if(mysql_num_rows($result) > 0) {
				$errmsg_arr[] = 'The Email is already in the system | You are using someone else Email Address, Please Enter Your Valid Email.';
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
		header("location: ../post_reg.php");
		exit();
	}

	
	//Create INSERT query
	$qry = "INSERT INTO temp_members(username, email, password,confirm_code) VALUES('$username','$email','$pass','$confirm_code')";
	$result = @mysql_query($qry);
	

// if suceesfully inserted data into database, send confirmation link to email 
if($result) {
			// send e-mail to ...
		$to=$email;
		
		// Your subject
		$subject="TECHWORKS - Your confirmation link here";
		
		// From
		$header="from: info@technation.af";
		
		// Your message
		$message="Your Comfirmation link \r\n";
		$message.="Click on this link to activate your account \r\n";
		$message.="http://works.technation.af/confirmation.php?passkey=$confirm_code";
		
		// send email
		$sentmail = mail($to,$subject,$message,$header);
		$_SESSION['SIGNUP_SUCCESS']='Thank you for submiting your information. We have sent you a confirmation Email that can be found on your Inbox or Spam folder. Check your Inbox';
		unset($_SESSION['SESS_USER_PIN']);
		header("location: ../index.php");
		exit();
	}else {
		die("Not found your email in our database" . mysql_error());
	}

	// if your email succesfully sent
	if($sentmail){
	echo "Your Confirmation link Has Been Sent To Your Email Address.";
	}
	else {
	echo "Cannot send Confirmation link to your e-mail address";
	}
?>