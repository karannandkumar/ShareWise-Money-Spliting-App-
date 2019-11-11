<?php
session_start();
$_SESSION['message'] = '';
$mysqli = mysqli_connect("localhost", "root", "qwerty", "blaa");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

$username=$_SESSION['username'];

 $wgname = $mysqli->real_escape_string($_POST['wgname']);
$wgpassword = $mysqli->real_escape_string($_POST['wgpassword']);

    
  echo "$wgname";

    $sql= mysqli_query($mysqli,"SELECT wgname,wgpassword from wg where wgname ='$wgname' and wgpassword='$wgpassword' ");
    $row = mysqli_fetch_row($sql);
  echo "$wgname";

     
  if ($wgname == $row['0'] &&  $wgpassword == $row['1']){
  echo "$wgname";
   $_SESSION['message'] = "Login succesful! Added $wgname to the database!";
   $sql2 = "INSERT INTO $wgname (pos,neg,name,admin) "

                        . "VALUES (0,0,'$username',0)";
                           
                          if ($mysqli->query($sql2) === true){
                            $_SESSION['message'] = "Registration succesful! Added $username to your $wgname!";
                        echo "Table created successfully.";
                         $sql1  = "UPDATE $wgname SET pos = 0,neg = 0";
                            if ($mysqli->query($sql1) === true)
                            {
                            $_SESSION['message'] = "done";
                            }
                           else{  
                       echo '<span style="color:#FF0000;"> ';
                       echo "Joining Grouo failed Enter Valid Group";
                       echo '</span>';
                      }
                    header("location: money.php");
         } 
             else{  
                       echo '<span style="color:#FF0000;"> ';
                       echo "Joining group failed Enter Valid Group";
                       echo '</span>';
                      }


}
         else {
  $_SESSION['message'] ="Joining group failed Enter Valid Group";
  // echo $row[0];
    //echo $row[1];
 // echo $username;
 // echo "username";


         }
}

?>
<meta name="viewport" content="width = device-width, initial-scale = 1">
<link href="//db.onlinewebfonts.com/c/a4e256ed67403c6ad5d43937ed48a77b?family=Core+Sans+N+W01+35+Light" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="css/menu.css" type="text/css">
<link rel="stylesheet" href="css/form1.css" type="text/css">
<ul>
  <li><a href="welcome.php">< Back </a></li>
  <li><a href="welcome.php">Home</a></li>
  <li><a class="active" href="#">Join Group</a></li>
    <li ><a href="index.php">Logout</a></li>
</ul>
<div class="body-content">
  <div class="module">
  <h1>JOIN Your Group</h1>
    <form class="form" action="JOIN.php" method="post" enctype="multipart/form-data" autocomplete="off">
      <div class="alert alert-error"><?= $_SESSION['message'] ?></div>
      <input type="text" placeholder="Group Name" name="wgname" required />
     
      <input type="password" placeholder="Group Password" name="wgpassword" autocomplete="new-password" required />
     

      <input type="submit" value="Join" name="register" class="btn btn-block btn-primary" />
        <button type = "button"><a href = "CreateWG.php">Create a Wg</button>
    </form>
  </div>
</div>