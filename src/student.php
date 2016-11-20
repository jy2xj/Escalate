<?php
  session_start();
  //check student session
  if (!isset($_SESSION["student"])) {
    header("Location: login.php");
    exit;
  }
  $studentID = $_SESSION["student"];

  function checkScore($score) {
    if ($score >= 80) {
      echo '<td align="center"><div style="width:100px;height:30px;border:1px solid #000; background-color:#00FF00">Passing</div></td>';
    } else if ($score > 70) {
      echo '<td align="center"><div style="width:100px;height:30px;border:1px solid #000; background-color:#FFFF00">Warning</div></td>';
    } else {
      echo '<td align="center"><div style="width:100px;height:30px;border:1px solid #000; background-color:#FF0000">Warning</div></td>';
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

<?php
$page_to_load = 'cont_student.php';
include('controller/controller.php');
?>  