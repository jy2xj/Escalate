
<?php
	session_start();

	if (!isset($_SESSION["teacher"])) {
		header("Location: login.php");
		exit;
	}
	$teacherID = $_SESSION["teacher"];
?>
<?php
$page_to_load = 'cont_teacher.php';
include('controller/controller.php');
?>	