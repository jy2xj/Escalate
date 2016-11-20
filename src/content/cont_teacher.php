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
    echo '<div id="students_info">';
    ?>
    <div id="myDiv" style="width: 480px; height: 400px;"><!-- Plotly chart will be drawn inside this DIV --></div>
     <script type="text/javascript" language="javascript">
     	var info_array;
	  	function getData(info) {
	  		var arrayLength = info.length+1;
	  		var student_names = [];
	  		var quizzes_taken = [];
	  		var quizzes_needed = [];
	  		var total = 0;
	  		var difference;
			for (var i = 0; i < arrayLength-1; i++) {
	    		//alert(info[i]['current_prog']);
	    		var name_full = info[i]['first_name'] + " " + info[i]['last_name'];
	    		student_names[i] = name_full;
	    		quizzes_taken[i] = info[i]['current_prog'];
	    		total += parseInt(quizzes_taken[i], 10);
	    		difference = info[i]['total_prog'] - info[i]['current_prog'];
	    		quizzes_needed[i] = difference;
	    	}
	    	student_names[arrayLength-1] = "Class Average";
    		quizzes_taken[arrayLength-1] = String(total/(arrayLength-1));
    		difference = info[0]['total_prog'] - quizzes_taken[arrayLength-1];
    		quizzes_needed[arrayLength-1] = difference;
	  		var trace1 = {
			  x: quizzes_taken,
			  y: student_names,
			  name: 'Quizzes Taken',
			  orientation: 'h',
			  marker: {
			    color: 'rgba(55,128,191,0.6)',
			    width: 1
			  },
			  type: 'bar'
			};

			var trace2 = {
			  x: quizzes_needed,
			  y: student_names,
			  name: 'Quizzes Left',
			  orientation: 'h',
			  type: 'bar',
			  marker: {
			    color: 'rgba(255,153,51,0.6)',
			    width: 1
			  }
			};

			var data = [trace1, trace2];

			var layout = {
			  title: 'Results for Your Class',
			  barmode: 'stack'
			};

			Plotly.newPlot('myDiv', data, layout);
	  	}
  </script>
   </div>
  <?php

  $sql = "SELECT *
          FROM Quizzes, Students, Users
          WHERE Students.teacher_id = '$teacherID' AND Quizzes.user_id=Students.user_id AND Students.user_id=Users.user_id";
	//$sql = "SELECT * FROM quizzes";
	$result = $conn->query($sql);
	if(!$result) {
	  echo "Could not run Query from Database" . mysql_error();
	  exit;
	}
	while($row = $result->fetch_assoc()){
		$data[] = $row;
	}

	if (isset($data)) {
		$info_array = json_encode($data);
	}
  echo '<script type="text/javascript">',
     "getData($info_array);",
     '</script>';
    ?>