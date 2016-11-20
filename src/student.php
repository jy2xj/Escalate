<?php
  session_start();
  if (isset($_SESSION["student"])) {
    header("Location: student.php");
    exit;
  }
  $studentID = $_SESSION["student"];
 ?>

<html>
<head>
  <title>Student</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href = "student.css">
</head>
<body>
<?php
    echo <h1> $studentID </h1>;
?>
<div id="progress" class="container" margin-left="30px">
  <h2>Course Progress</h2>
  <div class="progress">
    <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%">
      70%
    </div>
  </div>
</div>
<?php
//Created a new database instance and give an error if failed connection
$db = new mysqli('localhost', 'root', '', 'phpmyadmin');
if ($db->connect_error):
  die ("Could not connect to db: " . $db->connect_error);
endif;

$sql = "SELECT id as Quiz_1 Quiz_2 Quiz_3
          FROM quizzes
          WHERE user_id = $studentID"
$result = mysqli_query($sql);

if(!$result) {
  echo "Could not run Query from Database" . mysql_error();
  exit;
}

while($row = mysqli_fetch_assoc($result)) {
  echo $row["Quiz_1"];
  echo $row["Quiz_2"];
  echo $row["Quiz_3"];
}

mysql_free_result($result);
?>

</body>
</html>
