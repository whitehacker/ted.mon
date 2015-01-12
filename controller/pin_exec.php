<?php
//Start session
require_once("inc/config.inc");
session_start();

	
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
	$pin = clean($_POST['pin']);
	
	
	
	//Input Validations
	if($pin == '') {
		$errmsg_arr[] = 'شما شفر را داخل نه نموده اید!';
		$errflag = true;
	}
	
	
	
		
	//If there are input validations, redirect back to the login form
		if($pin !=''){
		$qry_val = mysql_query("SELECT * FROM pin_code WHERE code='$pin' AND status='Available'");
		if(mysql_num_rows($qry_val) != 1) {
			$errmsg_arr[] = 'این کود غلط و یا هم قبلا توسط شخص دیگری استفاده گردیده است!';
			$errflag = true;
		}else {
			$update_pin=mysql_query("UPDATE pin_code SET status='Used' WHERE code='$pin'");
			if($update_pin){
			session_regenerate_id();
			$pin_code = mysql_fetch_assoc($qry_val);
			$_SESSION['SESS_USER_PIN'] = $pin_code['code'];
			header("location: ../register.php");
			exit();
			}
		}	
		}
		if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location: ../pre_register.php");
		exit();
		}

?>