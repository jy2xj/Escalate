<!DOCTYPE html>
<html>
	<head>
		<title>Database Initialization Script</title>
	</head>
	<body>
		<?php
		// Initialize everything in the database that is needed

		session_start();
		session_unset(); //Unset all sessions

		//Created a new database instance and give an error if failed connection
		$db = new mysqli('localhost', 'root', '', 'phpmyadmin');
		if ($db->connect_error):
			die ("Could not connect to db: " . $db->connect_error);
		endif;

		$db->query("drop table Users, Students, Quizzes"); //Drop the previously created tables

		//Create the tables with the correct fields
		$result = $db->query("create table Users (user_id varchar(30) primary key not null, password varchar(255), first_name char(40) not null, last_name char(40), auth char(40))") or die ("Invalid: " . $db->error);
		$result = $db->query("create table Students (user_id varchar(30) primary key not null, tutor tinyint)") or die ("Invalid: " . $db->error);
		$result = $db->query("create table Quizzes (user_id varchar(30) primary key not null, Quiz_1 int, Quiz_2 int, Quiz_3 int, Chapter3_Test int)") or die ("Invalid: " . $db->error);


		$fileptr = fopen("users.txt", "rw");
		if ($fileptr) {
    		while (($line = fgets($fileptr)) !== false) {
       			$pieces = explode("#", $line);
       			$student = rtrim("$pieces[4]");
        		$password = hash("sha256", "$pieces[1]");
    			$sql = $db->query("INSERT INTO Users VALUES ('$pieces[0]','$password','$pieces[2]','$pieces[3]','$student')") or die ("Invalid: " . $db->error);
    		}
    	fclose($fileptr);
		}

		$fileptr = fopen("quizzes.txt", "rw");
		if ($fileptr) {
    		while (($line = fgets($fileptr)) !== false) {
       			$pieces = explode("#", $line);
    			$sql = $db->query("INSERT INTO Quizzes VALUES ('$pieces[0]','$pieces[1]','$pieces[2]','$pieces[3]','$pieces[4]')") or die ("Invalid: " . $db->error);
    		}
    	fclose($fileptr);
		}

		$fileptr = fopen("students.txt", "rw");
		if ($fileptr) {
    		while (($line = fgets($fileptr)) !== false) {
       			$pieces = explode("#", $line);
    			$sql = $db->query("INSERT INTO Students VALUES ('$pieces[0]','$pieces[1]')") or die ("Invalid: " . $db->error);
    		}
    	fclose($fileptr);
		}

		header("Location: login.php");
		exit;
		?>
	</body>
</html>
