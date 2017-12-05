<?php
session_start();
   
   if (!isset($_SESSION['sid'])) {
      $_SESSION['sid'] = $_POST['pass'];
   }
?>
<html>
 <head>
  <title>Login Failed</title>
 </head>
 <body>
 	<?php 
  $GLOBALS['username'] = "onur.kulak";
  $GLOBALS['password'] = "onurcs353";
  $GLOBALS['hostname'] = "localhost"; 
  $GLOBALS['tablename'] = "onur_kulak"; 

 	$dbhandle = mysql_connect($GLOBALS['hostname'], $GLOBALS['username'], $GLOBALS['password'])
  	or die("Unable to connect to MySQL");

  	$table = mysql_select_db($GLOBALS['tablename'],$dbhandle)
  	or die("Could not select examples");
    
    $password = $_POST['pass'];
    $username = $_POST['name'];

  	if( 1==mysql_num_rows(mysql_query(
      "SELECT * FROM student WHERE sid = '$password' AND sname= '$username';")))
  	{
        $_SESSION['sid'] = $_POST['pass'];
        header('Location: studentWelcome.php');
        exit();
    }
    else if( 1==mysql_num_rows(mysql_query(
      "SELECT * FROM student WHERE sname= '$username';")))
    {
        echo ("Wrong password");  
    }
    else{
      echo ("User does not exist"); 
    }
    echo "<br /><a href='index.php'>Return</a><br />";
    ?>
 </body>
</html>