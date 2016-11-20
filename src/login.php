<?php
  session_start();
  if (isset($_SESSION["invalid"])) {
    echo '<script language="javascript">';
    echo "alert('There is an invalid User ID or Password');";
    echo "</script>";
    unset($_SESSION['invalid']);
  }
  if (isset($_SESSION["student"])) {
    header("Location: student.php");
    exit;
  }
  else if (isset($_SESSION["teacher"])) {
    header("Location: teacher.php");
    exit;
  }


?>
<!DOCTYPE html>
<html>
<style>
form {
    border: 3px solid #f1f1f1;
}

input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

.cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
}

.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
}

img.avatar {
    width: 20%;
    border-radius: 50%;
}

.container {
    padding: 16px;
}

span.psw {
    float: right;
    padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
    span.psw {
       display: block;
       float: none;
    }
    .cancelbtn {
       width: 100%;
    }
}
</style>
<body>

<h2 style = "font-family: verdana; color:#555555;"> Escalate Login</h2>

<form action="redirect.php"
  method = "POST">
  <div class="imgcontainer">
    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/ba/Circle-icons-lightbulb.svg/768px-Circle-icons-lightbulb.svg.png" alt="Avatar" class="avatar">
  </div>

  <div class="container">
    <label><b style="font-family:calibri">User ID</b></label>
    <input type="text" placeholder="Enter User ID" name="uname" required >

    <label><b style="font-family:calibri">Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw"  required >
           <input type="checkbox" name="teacher" checked="checked"> I am a teacher
    <button type="submit" style= "background-color: #555555;">Login</button>

  </div>

  </div>
</form>

</body>
</html>
