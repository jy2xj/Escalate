<?php
	//Logs the student/teacher out if they press the logout button
	session_start(); //start the session

	session_unset();
	header("Location: login.php");
	exit;
?>