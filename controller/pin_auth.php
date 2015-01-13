<?php
	//Start session
	session_start();
	
	//Check whether the session variable SESS_MEMBER_ID is present or not
	if(!isset($_SESSION['SESS_USER_PIN']) || (trim($_SESSION['SESS_USER_PIN']) == '')) {
		header("location:../pre_register.php");
		$_SESSION['user_pin_need']='برای ثبت نام شما باید اول کود ثبت را داخل نمایید و بعدا به این صفحه مراجعه نمایید!';
		exit();
	}
?>