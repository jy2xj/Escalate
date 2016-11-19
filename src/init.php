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

		$db->query("drop table Users"); //Drop the previously created tables
		
		//Create the tables with the correct fields
		$result = $db->query("create table Users (user_id varchar(30) primary key not null, password varchar(255), first_name char(40) not null, last_name char(40))") or die ("Invalid: " . $db->error);
		?>
		Hello World!
	</body>
</html>