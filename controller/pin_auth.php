<?php
	//Start session
	session_start();
	
	//Check whether the session variable SESS_MEMBER_ID is present or not
	if(!isset($_SESSION['SESS_USER_PIN']) || (trim($_SESSION['SESS_USER_PIN']) == '')) {
		header("location:../register.php");
		$_SESSION['user_pin_need']='In Order to access this Registration Page, You have to Enter a Valid Registration Code and then Proceed!';
		exit();
	}
?>