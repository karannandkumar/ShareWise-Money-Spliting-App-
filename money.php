<?php session_start(); 
?>
<ul>
  <li><a href="welcome.php">< Back </a></li>
  <li><a href="welcome.php">Home</a></li>
  <li><a class="active" href="#"><span class="user"><?= $_SESSION['wgname'] ?></span></a></li>
    <li "><a href="index.php">Logout</a></li>
</ul>
<link href="//db.onlinewebfonts.com/c/a4e256ed67403c6ad5d43937ed48a77b?family=Core+Sans+N+W01+35+Light" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="css/menu.css" type="text/css">
<link rel="stylesheet" href="css/form1.css" type="text/css">
<meta name="viewport" content="width = device-width, initial-scale = 1">


<div class="body-content">
  <div class="module">
  <?php 
 $wgname= $_SESSION['wgname'];
 $username=$_SESSION['username'];
 $table="table";
 $wgtable=$wgname.$table;
$mysqli = mysqli_connect("localhost", "root", "qwerty", "blaa");
 if(isset($_POST['register'])){
$username=$_SESSION['username'];

 $Item = $mysqli->real_escape_string($_POST['Item']);
$Price = $mysqli->real_escape_string($_POST['Price']);
$sql2 = "INSERT INTO $wgtable (name,item,price) "

                        . "VALUES ('$username','$Item','$Price')";
                           
                          if ($mysqli->query($sql2) === true){
                            $_SESSION['message'] = "Succesful! Added items to table!";
                        
                   
         } 
             else{
                    echo "ERROR: Could not ADD " ;
                      }


    
$result = "SELECT name FROM $wgname";
if ($stmt = $mysqli->prepare($result)) {
$stmt->execute();
$stmt->store_result();
$numrows = $stmt->num_rows;
// processing of the returned data goes hee - using $stmt->fetch() to retrieve each row
$stmt->free_result();
$stmt->close();
}


$int=(int)$numrows;

$x=$Price/$int;
$y=$Price - $x;

$sql= mysqli_query($mysqli,"UPDATE $wgname set pos = pos + $y , neg = neg -$y  where name like '$username'"   );
$sql= mysqli_query($mysqli,"UPDATE $wgname set pos = pos - $x , neg = neg +$x  where name <> '$username'"   );


}
elseif(isset($_POST['ClearHistory'])){
  $wgname= $_SESSION['wgname'];
 $username=$_SESSION['username'];
 $table="table";
 $wgtable=$wgname.$table;
  $sql  = "DELETE FROM $wgtable";
  if ($mysqli->query($sql) === true){
                            $_SESSION['message'] = "done";
                            $sql1  = "UPDATE $wgname SET pos = 0,neg = 0";
                            if ($mysqli->query($sql1) === true)
                            {
                            $_SESSION['message'] = "done";
                            }
                            else {
                              echo "ERROR: Could not clear2 " ;
                            }
                                      
              }
             else{
                    echo "ERROR: Could not clear1 " ;
                      }
            
          }
  # code...


 elseif(isset($_POST['Deletegroup'])){
  $wgname= $_SESSION['wgname'];
 $username=$_SESSION['username'];
 $table="table";
 $wgtable=$wgname.$table;
  $sql  = "DROP table $wgname";
  if ($mysqli->query($sql) === true){
                            $_SESSION['message'] = "done";
                             $sql1  = "DROP table $wgtable";
                            if ($mysqli->query($sql1) === true)
                            {
                            $_SESSION['message'] = "Deleted";
                                 $sql1 = "DELETE from wg where wgname like '$wgname' ";
                                       if ($mysqli->query($sql1) === true){
                            $_SESSION['message'] = "done";
                          header("location: welcome.php");
                                      }
                                      else {
                                        echo "Could not delete in table wg " ;
                                      }
                            }
                            else {
                              echo "ERROR: Could not clear2 " ;
                            }
                                      
              }
             else{
                    echo "ERROR: Could not clear1 " ;
                      }
            
          }
           elseif(isset($_POST['Leavegroup'])){
  $wgname= $_SESSION['wgname'];
 $username=$_SESSION['username'];
 $table="table";
 $wgtable=$wgname.$table;
$sql = "DELETE from $wgname where name like '$username' ";
  if ($mysqli->query($sql) === true){
                            $_SESSION['message'] = "done";
                          header("location: welcome.php");
                                      
              }
             else{
                    echo "ERROR: Could not clear1 " ;
                      }
            
          }
  # code...


?>
        <h1>Welcome <span class="user"><?= $username ?></span> to <span class="user"><?= $wgname ?> <span class="user"<?//= $num_rows ?> </span></h1>

      <!-- <img src="<?= $_SESSION['avatar'] ?>"><br /> -->
        <div>
        <link href="//db.onlinewebfonts.com/c/a4e256ed67403c6ad5d43937ed48a77b?family=Core+Sans+N+W01+35+Light" rel="stylesheet" type="text/css"/>
       
           <?php
           $wgname= $_SESSION['wgname'];
    $mysqli = mysqli_connect("localhost", "root", "qwerty", "blaa");
 $sql = "SELECT name ,pos, neg from $wgname where name like '$username' ";

$result1 = $mysqli->query($sql);

if ($result1->num_rows > 0) {
    // output data of each row
    while($row = $result1->fetch_assoc()) {
        if($row["neg"]>$row["pos"]){
        echo '<span style="color:#FF0000;"> ';
            echo   "You ". " need to pay " . $row["neg"]. " Euro " ."<br>";
            echo '</span>';
        }
        else if($row["neg"]<$row["pos"]){
        echo '<span style="color:#00FF00;"> ';
            echo   "You"." have to get ". $row["pos"]. " Euro " ."<br>";
            echo '</span>';
        }
 else {
           echo '<span style="color:#1E9CD0;"> ';
          echo " Enter Item and Price"."<br>";
           echo '</span>';
        }

    }
} else {
    echo "  ";
}



             $sql = "SELECT name ,pos, neg from $wgname where name <> '$username' ";

$result1 = $mysqli->query($sql);

if ($result1->num_rows > 0) {
    // output data of each row
    while($row = $result1->fetch_assoc()) {
        if($row["neg"]>$row["pos"]){
        echo '<span style="color:#FF0000;"> ';
            echo   $row["name"]. " needs to pay " . $row["neg"]. " Euro " ."<br>";
            echo '</span>';
        }
        else if($row["neg"]<$row["pos"]){
        echo '<span style="color:#00FF00;"> ';
            echo   $row["name"] ." has to get ". $row["pos"]. " Euro " ."<br>";
            echo '</span>';
        }
           else {
            echo '<span style="color:#1E9CD0;"> ';
          
           echo '</span>';

        }

    }
} else {
    echo "You are the only one in $wgname ";
}


 ?>

  <h1>Enter Item Amount</h1>
    <form class="form" action="money.php" method="post" enctype="multipart/form-data" autocomplete="off">
     
      <input type="text" placeholder="Item" name="Item" required />
      <input type ="number" placeholder="Price" name="Price" required/>

      <input type="submit" value="Enter" name="register" class="btn btn-block btn-primary" />
<br></br>
       <button type = "button"><a href = "money.php">Refresh Page</button>
    </form>


        <?php
         $wgname= $_SESSION['wgname'];
     $mysqli = mysqli_connect("localhost", "root", "qwerty", "blaa");
        //Select queries return a resultset
      //  $usersa = User::all()->except(Auth::id());




             $sql = "SELECT username, avatar FROM $wgname left join users on users.username= $wgname.name ";
        $result = $mysqli->query($sql); //$result = mysqli_result object
        //var_dump($result);
        ?>
       
        <div id='registered'>
        <span style="color:#C1F9AF;"> 
        <span>All registered users in <?= $_SESSION['wgname'] ?></span> </span>
        <?php
        while($row = $result->fetch_assoc()){ //returns associative array of fetched row
            //echo '<pre>';
            //print_r($row);
            //echo '</pre>';

            echo "<div class='userlist'><span>$row[username]</span><br />";
            echo "<img src='$row[avatar]'></div>";

          
        } 
        ?>
</div>

</div>


</div>
</span>
</span>


</h1>
</div>

</div>

  

</div>
</div>
<br>
<div class="body-content">
  <div class="module">
<?php
$mysqli = mysqli_connect("localhost", "root", "qwerty", "blaa");
$sql = "SELECT name, item, price FROM $wgtable";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
     echo '<span style="color:#C1F9AF;"> ';
    echo "<br>"."<br>"."<br>"."<br>"."<br>"."<br>"."<br>"."<br>"."<br>"."<br>"."<br>"."History"."<br>"."<br>";
    echo '</span>';
    while($row = $result->fetch_assoc()) {
   echo '<span style="color:#FFFFFF;"> ';
        echo $row["name"]. " brought " . $row["item"]. " for ".$row["price"]. " Euro ". "<br>";
        echo '</span>';
    }
} else {
    echo "0 results";
}
$mysqli->close();
?>
    <form class="form" action="money.php" method="post" enctype="multipart/form-data" autocomplete="off">
     
      <input type="submit" value="Clear History" name="ClearHistory" class="btn btn-block btn-primary" /> </form>
 <?php 
     $wgname= $_SESSION['wgname'];
   $mysqli = mysqli_connect("localhost", "root", "qwerty", "blaa");
 $sql = "SELECT name from $wgname where name like '$username' and admin = '1' ";

$result1 = $mysqli->query($sql);

if ($result1->num_rows > 0) {
    // output data of each row
    while($row = $result1->fetch_assoc()) {
  echo '<span style="color:#FFFFFF;"> ';
        echo  " You are the Admin of this group " . "<br>";
        echo '</span>';
    }
   echo("
    <form class=\"form\" action=\"money.php\" method=\"post\" enctype=\"multipart/form-data\" autocomplete=\"off\">
     
      <input type=\"submit\" value=\"Delete group\" name=\"Deletegroup\" class=\"btn btn-block btn-primary\" /> </form>");
}
else {
echo("
    <form class=\"form\" action=\"money.php\" method=\"post\" enctype=\"multipart/form-data\" autocomplete=\"off\">
     
      <input type=\"submit\" value=\"Leave group\" name=\"Leavegroup\" class=\"btn btn-block btn-primary\" /> </form>");
}
?>
</div>
</div>