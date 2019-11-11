<?php
session_start();
$_SESSION['message'] = '';
$mysqli = mysqli_connect("localhost", "root", "qwerty", "blaa");


//the form has been submitted with post
if ($_SERVER["REQUEST_METHOD"] == "POST") {

 if ($_POST['wgpassword'] == $_POST['confirmpassword']) {

 $wgname = $mysqli->real_escape_string($_POST['wgname']);
$wgpassword = $mysqli->real_escape_string($_POST['wgpassword']);

$username=$_SESSION['username'];
    
   $_SESSION['wgname'] = $wgname;
   $table="table";
    $wgtable=$wgname.$table;
    $sql = "SELECT wgname  from wg where wgname = '$wgname' ";
        $result1 = $mysqli->query($sql);

         if ($result1->num_rows == 0) {
   $sql = "INSERT INTO wg (wgname, wgpassword) "

                        . "VALUES ('$wgname', '$wgpassword')";

                    if ($mysqli->query($sql) === true){

$_SESSION['message'] = "1Registration succesful! Added $wgname to your WG!";
                        echo "Table created successfully.";

                      $sql1 = "CREATE TABLE $wgname (
                         id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
                         pos float SIGNED ,
                         neg float SIGNED,
                         admin int SIGNED,


                          name VARCHAR(30) NOT NULL
                            )";}
                               
                            if ($mysqli->query($sql1) === true){
                            $_SESSION['message'] = "2Registration succesful! Added $wgname to your WG!";
                        echo "Table created successfully.";

                      $sql2 = "INSERT INTO $wgname (pos,neg,name,admin) "

                        . "VALUES (0.0,0.0,'$username',1)";}
                           
                          if ($mysqli->query($sql2) === true){
                            $_SESSION['message'] = "3Registration succesful! Added $username to your $wgname!";
                        echo "Table created successfully.";
                        
                              $sql3 = "CREATE TABLE $wgtable (
                         id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                         name VARCHAR(30) ,
                         item VARCHAR(30),
                         price float UNSIGNED )";
                         if ($mysqli->query($sql3) === true){
                            $_SESSION['message'] = "2Registration succesful! Added $wgname to your WG!";

                           header("location: welcome.php");}
                           else {
                            $_SESSION['message'] = "second table dint add";
                           }
                    } else{
                    echo "3ERROR: Could not able to execute $sql " ;
                      }


                //if the query is successsful, redirect to welcome.php page, done!

                    
          
}

else{
 $_SESSION['message'] = 'This Group already exist Please create another name';
}
}
else{
 $_SESSION['message'] = 'Two passwords do not match!';
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
  <li><a class="active" href="#">CreateGroup</a></li>
    <li ><a href="index.php">Logout</a></li>
</ul>

<div class="main">
<div class="body-content">
  <div class="module">
  <h1>Create Your Group</h1>
    <form class="form" action="CreateWG.php" method="post" enctype="multipart/form-data" autocomplete="off">
      <div class="alert alert-error"><?= $_SESSION['message'] ?></div>
      <input type="text" placeholder="Group Name" name="wgname" required />
     
      <input type="password" placeholder="Group Password" name="wgpassword" autocomplete="new-password" required />
      <input type="password" placeholder="Confirm Password" name="confirmpassword" autocomplete="new-password" required />

      <input type="submit" value="Register" name="register" class="btn btn-block btn-primary" />
        <button type = "button"><a href = "JOIN.php">Already have a Group</button>
    </form>
  </div>
</div>
</div>