<?php
	session_start();
	if (isset($_POST["uname"]) && isset($_POST["psw"])) {
		$user = rtrim($_POST["uname"]);
		$pass = rtrim($_POST["psw"]);
		$db = new mysqli('localhost', 'root', '', 'phpmyadmin');
		if ($db->connect_error):
			die ("Could not connect to db: " . $db->connect_error);
		endif;
		$password = hash("sha256", $pass);
		if (isset($_POST["teacher"])) {
			$sql = $db->query("SELECT * FROM Users WHERE user_id='$user' AND password='$password' AND auth='teacher'");
			if ($sql->num_rows > 0) {
	    		// output data of each row
	    		while($row = $sql->fetch_assoc()) {
        			$_SESSION["teacher"] = $row["user_id"];
        			header("Location: teacher.php");
        			exit;
	    		}
	    	}
			else {
				header("Location: login.php");
				exit;
			}
		}
		else {
			echo "$user";
			echo "$password";
			$sql = $db->query("SELECT * FROM Users WHERE user_id='$user' AND password='$password' AND auth='student'");
			if ($sql->num_rows > 0) {
	    		// output data of each row
	    		while($row = $sql->fetch_assoc()) {
        			$_SESSION["student"] = $row["user_id"];
						header("Location: student.php");
        			exit;
	    		}
	    	}
			else {
				header("Location: login.php");
				exit;
			}
		}
	}
?>
