<?php
session_start();
$_SESSION['message'] = '';
$mysqli = mysqli_connect("localhost", "root", "qwerty", "blaa");

//the form has been submitted with post
if ($_SERVER["REQUEST_METHOD"] == "POST") {



 $username = $mysqli->real_escape_string($_POST['username']);
$password = $mysqli->real_escape_string($_POST['password']);

    
   $_SESSION['username'] = $username;

    $sql= mysqli_query($mysqli,"SELECT username,password from users where username ='$username' and password='$password' ");
    $row = mysqli_fetch_row($sql);


     if ($username = $row['0'] &&  $password = $row['1']){
   $_SESSION['message'] = "Login succesful! Added $username to the database!";
                    header("location: welcome.php");
         } else {
    $_SESSION['message'] ="Login failed Enter Correct Password";
  // echo $row[0];
    //echo $row[1];
 // echo $username;
 // echo "username";


         }
}

?>


<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
</head>

<link href="//db.onlinewebfonts.com/c/a4e256ed67403c6ad5d43937ed48a77b?family=Core+Sans+N+W01+35+Light" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="css/form1.css" type="text/css">
<body>


<meta name="viewport" content="width = device-width, initial-scale = 1">




<div class="body-content">
  <div class="module">
  <h2>Welcome to ShareWise</h2>
    
    <form class="form" action="index.php" method="post" enctype="multipart/form-data" autocomplete="off">
      <div class="alert alert-error"><?= $_SESSION['message'] ?></div> 
      <input type="text" id="username" placeholder="Enter your ShareWise User Name" name="username" required />

      <input type="password" id="password" placeholder="Password" name="password" autocomplete="new-password" required />

 
      <input type="submit" value="Enter" name="register" class="btn btn-block btn-primary" />
      <br></br>
    
        
    </form>
  </div>
   
   </form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>