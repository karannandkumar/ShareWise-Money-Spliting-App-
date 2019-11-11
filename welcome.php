<link rel="stylesheet" href="css/menu.css" type="text/css">
<link rel="stylesheet" href="css/form1.css" type="text/css">
<meta name="viewport" content="width = device-width, initial-scale = 1">
<ul>
  
  <li><a href="JOIN.php">Join Group</a></li>
  <li><a href="CreateWG.php">CreateGroup</a></li>

    <li><a href="index.php">Logout</a></li>
</ul>
<?php session_start(); ?>
<div class="body content">
  
     
<link href="//db.onlinewebfonts.com/c/a4e256ed67403c6ad5d43937ed48a77b?family=Core+Sans+N+W01+35+Light" rel="stylesheet" type="text/css"/>


<div class="body-content">
  <div class="module">
    <?php

$_SESSION['message'] = '';
$mysqli = mysqli_connect("localhost", "root", "qwerty", "blaa");

if(isset($_POST['register'])){

$username=$_SESSION['username'];

 $wgname = $mysqli->real_escape_string($_POST['wgname']);    




    $sql= mysqli_query($mysqli,"SELECT wgname from wg where wgname ='$wgname' ");
    $row = mysqli_fetch_row($sql);
  
     
  if ($wgname == $row['0']){
  
$sql = "SELECT name  from $wgname where name = '$username' ";

$result1 = $mysqli->query($sql);

if ($result1->num_rows > 0) {
   $_SESSION['message'] = " Welcome to $wgname ";
                   $_SESSION['wgname']=$wgname;

                    header("location: money.php");
         } 
             else{  
                       echo '<span style="color:#FF0000;"> ';
                       echo "Login failed. You have to join this Group";
                       echo '</span>';
                      }


}
 else {
                         echo '<span style="color:#FF0000;"> ';
                       echo "Login failed. This group does not exist";
                       echo '</span>';
                      }
 }
        
         if(isset($_POST['del'])){
    $wgname= $_SESSION['wgname'];
 $username=$_SESSION['username'];
 $table="table";
 $wgtable=$wgname.$table;
    $sql  = "DELETE FROM users where  username like '$username'";
    if ($mysqli->query($sql) === true){
                            $_SESSION['message'] = "done";
                            header("location: form.php");
                                      
              }
             else{
                    echo "ERROR: Could not clear1 " ;
                   
                      }
            
          }
?>
  <br> </br>
        <h1>Welcome <span class="user"><?= $_SESSION['username'] ?></span> <br> </h1><h1></h1>
      <!-- <img src="<?= $_SESSION['avatar'] ?>"><br /> -->
    
  <h1>Go to your Group</h1>
    <form class="form" action="welcome.php" method="post" enctype="multipart/form-data" autocomplete="off">
     
      <input type="text" placeholder="Write Group name you want to go to here " name="wgname" required />

      <input type="submit" value="GO" name="register" class="btn btn-block btn-primary" />
       
    </form>
         <div id='registered'>
      <span style="color:#C1F9AF;"> 
        <span>List of Groups:</span>
      </span>
        <?php
       $wgname=$_SESSION['wgname'];
         $username=$_SESSION['username'];

   // $sql = "SELECT name FROM $wgname as o inner join information_schema.columns as i ";
        $sql = "SELECT wgname FROM  wg    ";
       
        $result = $mysqli->query($sql); //$result = mysqli_result object
        //var_dump($result);
       
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo " " . $row["wgname"] ."<br>";
      
}


}
else {
    echo "Invite people to your Group";
}
        
       
        ?> 

        <?php
     $mysqli = mysqli_connect("localhost", "root", "qwerty", "blaa");

        //Select queries return a resultset
      //  $usersa = User::all()->except(Auth::id());
        $cn = $_SESSION['username'];
     
             $sql = "SELECT username, avatar FROM users ";
        $result = $mysqli->query($sql); //$result = mysqli_result object
        //var_dump($result);
        ?>
        <div id='registered'>
        <span>All registered users:</span>
        <?php
        while($row = $result->fetch_assoc()){ //returns associative array of fetched row
            //echo '<pre>';
            //print_r($row);
            //echo '</pre>';

            echo "<div class='userlist'><span>$row[username]</span><br />";
            echo "<img src='$row[avatar]'></div>";

          
        } 
         
        ?>
        <div id='registered'>

        <form class="form" action="welcome.php" method="post" enctype="multipart/form-data" autocomplete="off">
     
      <input type="submit" value="Delete Your Account" name= "del" class="btn btn-block btn-primary" /> </form>
      
  </div>
</div>

        
        </div>
    </div>
</div>