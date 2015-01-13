<?php
	//Start session
	session_start();
	
	//Check whether the session variable SESS_MEMBER_ID is present or not
	if(!isset($_SESSION['SESS_USER_ID']) || (trim($_SESSION['SESS_USER_ID']) == '')) {
		header("location:../login.php");
		$_SESSION['user_login_need']='شما اجازه ندارید تا داخل این صفحه شوید! اول باید ایمیل و شفر خویش را وارد سازید!';
		exit();
	}
?>