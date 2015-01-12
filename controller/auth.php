<?php
	//Start session
	session_start();
	
	//Check whether the session variable SESS_MEMBER_ID is present or not
	if(!isset($_SESSION['SESS_USER_ID']) || (trim($_SESSION['SESS_USER_ID']) == '')) {
		header("location:../login.php");
		$_SESSION['user_login_need']='In Order to access this Page you have to Login first!';
		exit();
	}
?>