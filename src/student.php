<?php
  session_start();
  if (!isset($_SESSION["student"])) {
    header("Location: login.php");
    exit;
  }
  $studentID = $_SESSION["student"];

  function checkScore($score) {
    if ($score > 80) {
      echo '<td align="center"><div style="width:100px;height:30px;border:1px solid #000; background-color:#00FF00">Passing</div></td>';
    } else if ($score >70) {
      echo '<td align="center><div style="width:100px;height:30px;border:1px solid #000;background-color:#FFFF00';
    } else {
      echo '<td align="center><div style="width:100px;height:30px;border:1px solid #000;background-color:#FF0000';
    }
  }
  function calculateAverage($arr) {
    $sum = 0;
    $count = sizeof($arr);
    foreach($arr as $value) {
      $sum += $value;
    }
    return $sum/$count;
  }
 ?>

<html>
<head>
  <title>Student</title>
  <link rel="stylesheet" href = "./student.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>
<?php
    $conn = new mysqli('localhost', 'root', '', 'phpmyadmin');
    if ($conn->connect_error):
      die ("Could not connect to db: " . $conn->connect_error);
    endif;
    $name = "SELECT first_name, last_name
              FROM users
              WHERE user_id = '$studentID' ";
    $names = $conn->query($name);
    while($param= mysqli_fetch_assoc($names)) {
      $firstName = $param["first_name"];
      $lastName = $param["last_name"];
      echo "<p id = 'test'>";
      echo  "$studentID - $firstName $lastName</p>";
    }
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

$sqlAvg = "SELECT *
                FROM quizzes";
$resultAvg = $db->query($sqlAvg);

if (!$resultAvg) {
  echo "Could not run query for Average from Database" .mysql_error();
  exit;
}
$counter = 0;
$stack = array();
$stack1 = array();
$stack2 = array();
$test = array();
while($num = mysqli_fetch_assoc($resultAvg)) {
    array_push($stack, $num["Quiz_1"]);
    array_push($stack1, $num["Quiz_2"]);
    array_push($stack2, $num["Quiz_3"]);
    array_push($test, $num["Chapter3_Test"]);
}
$avg = calculateAverage($stack);
$avg1 = calculateAverage($stack1);
$avg2 = calculateAverage($stack2);
$avgTest = calculateAverage($test);

$sql = "SELECT Quiz_1, Quiz_2, Quiz_3
          FROM quizzes
          WHERE user_id = '$studentID' ";
$result = $db->query($sql);

if(!$result) {
  echo "Could not run Query from Database" . mysql_error();
  exit;
}

while($row = mysqli_fetch_assoc($result)) {
  $score1 = $row["Quiz_1"];
  $score2 = $row["Quiz_2"];
  $score3 = $row["Quiz_3"];

  echo '<div class="container">';
  echo '<table id="group" width="80%">';
  echo    "<tr>";
  echo         '<td>Quiz 1</td>';
  echo         '<td>';
  echo                    $score1;
  echo         "</td>";
  checkScore($score1);
  echo        '<td><button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo1"> Show Details </button></td>';
  echo     "</tr>";
  echo      '<tr><td id="space" colspan="4" padding="10px"><div id="demo1" class = "collapse">';
  echo '<table id=barGraph><tr><td id="space" colspan="4"><div class="progress-bar progress-bar-success" ';
  echo 'role="progressbar" aria-valuenow=$score aria-valuemin="0" aria-valuemax="100" style="width: '. $score1.'% ">';
  echo  "Your Score: $score1%";
  echo ' </div></td></tr>
  <tr><td></td></tr>
    <tr><td id="space" colspan="4"><div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: '. $avg.'% ">';
  echo    "Average: $avg%";
  echo  '</div></td></tr></table>
</div></td></tr>';

  echo    "<tr>";
  echo         '<td>Quiz 2</td>';
  echo         '<td>';
  echo                    $score2;
  echo         "</td>";
  checkScore($score2);
  echo        '<td><button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo2"> Show Details </button></td>';
  echo     "</tr>";
  echo "<br>";
  echo      '<tr><td id="space" colspan="4"><div id="demo2" class = "collapse">';
  echo '<table id=barGraph><tr><td colspan="4"><div class="progress-bar progress-bar-success" ';
  echo 'role="progressbar" aria-valuenow=$score aria-valuemin="0" aria-valuemax="100" style="width: '. $score2.'% ">';
  echo  "Your Score: $score2%";
  echo ' </div></td></tr>
    <tr><td></td></tr>
    <tr><td id="space" colspan="4"><div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:'. $avg1.'% ">';
  echo    "Average: $avg1%";
  echo  '</div></td></tr></table>
</div></td></tr>';

  echo         '<td>Quiz 3</td>';
  echo         '<td>';
  echo                    $score3;
  echo         "</td>";
  checkScore($score3);
  echo        '<td><button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo3"> Show Details </button></td>';
  echo     "</tr>";
  echo      '<tr><td id="space" colspan="4"><div id="demo3" class = "collapse">';
  echo '<table id=barGraph><tr><td colspan="4"><div class="progress-bar progress-bar-success" ';
  echo 'role="progressbar" aria-valuenow=$score aria-valuemin="0" aria-valuemax="100" style="width: '. $score3.'% ">';
  echo  "Your Score: $score3%";
  echo ' </div></td></tr>
    <tr><td></td></tr>
    <tr><td id="space" colspan="4"><div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:'. $avg2.'% ">';
  echo    "Average: $avg2%";
  echo  '</div></td></tr></table>
</div></td></tr>';
  echo "</table>";
  echo "<br>";
}
?>
<div id =TutorBtn>
  <button type="button" class="btn btn-info"> Apply to be Tutor </button>
  <br/><br/>
  <form action="logout.php"
  method = "POST">
  <input type="submit" style="color:blue;width:100;height:49;font-size:20px;" value="Logout"style= "background-color: #ff5151;"></input>
  </form>
</div>
</body>
</html>
