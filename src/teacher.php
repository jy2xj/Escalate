<?php
	session_start();

	if (!isset($_SESSION["teacher"])) {
		header("Location: login.php");
		exit;
	}
	$teacherID = $_SESSION["teacher"];
?>

<html>
<head>
  <title>Student</title>
  <!-- Plotly.js -->
  <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
  <link rel="stylesheet" href = "./student.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>
<div id='students_info'>
<?php
    $conn = new mysqli('localhost', 'root', '', 'phpmyadmin');
    if ($conn->connect_error):
      die ("Could not connect to db: " . $conn->connect_error);
    endif;
    $name = "SELECT first_name, last_name
              FROM users
              WHERE user_id = '$teacherID' ";
    $names = $conn->query($name);
    while($param= mysqli_fetch_assoc($names)) {
      $firstName = $param["first_name"];
      $lastName = $param["last_name"];
      echo "<p id = 'test'>";
      echo  "Teacher: $teacherID - $firstName $lastName</p>";
    }

    /*$sql = "SELECT Quiz_1, Quiz_2, Quiz_3
          FROM quizzes
          WHERE user_id = '$studentID' ";
	//$sql = "SELECT * FROM quizzes";
	$result = $db->query($sql);

	if(!$result) {
	  echo "Could not run Query from Database" . mysql_error();
	  exit;
	}*/
    ?>
    <div id="myDiv" style="width: 480px; height: 400px;"><!-- Plotly chart will be drawn inside this DIV --></div>
     <script type="text/javascript" language="javascript">
  	function getData() {
  		var data = [{
		  type: 'bar',
		  x: [20, 14, 23],
		  y: ['giraffes', 'orangutans', 'monkeys'],
		  orientation: 'h'
		}];

		Plotly.newPlot('myDiv', data);
  	}
  	getData();
  </script>
</div>

</body>
</html>