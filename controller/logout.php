<?php
	//Start session
	session_start();
	
	//Unset the variables stored in session
	unset($_SESSION['SESS_USER_ID']);
	unset($_SESSION['SESS_MEMBER_NAME']);
	$_SESSION['logout']='You have Successfuly Loged Out!';
	header("location: ../login.php");
?>

