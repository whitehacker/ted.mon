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
	$full_name = clean($_POST['full_name']);
	$aca_grade = clean($_POST['ac_degree']);
	$phone = clean($_POST['phone']);
	$email = clean($_POST['email']);
	$pass = clean($_POST['pass']);
	
	
	//Input Validations
	if($full_name == '') {
		$errmsg_arr[] = 'اسم مکمل خویش را بنویسید!';
		$errflag = true;
	}
	if($aca_grade == '') {
		$errmsg_arr[] = 'ربته علمی خویش را بنویسید!';
		$errflag = true;
	}
	if($phone == '') {
		$errmsg_arr[] = 'نمبر تلیفون را بنویسید!';
		$errflag = true;
	}

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
	
	
	if($full_name !='' && $pass !=''){
	if( strcmp($pass, $username) == 0 ) {
		$errmsg_arr[] = 'شفر شما دارایا کلمات اسم شما میباشد شفر دیگری داخل نمایید!';
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
	mysql_query("SET names utf8");
	mysql_query("SET char-set utf8");
	$qry = "INSERT INTO perm_members(full_name, aca_degree, phone, email, pass) VALUES('$full_name', '$aca_grade', '$phone', '$email',md5('$pass'))";
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