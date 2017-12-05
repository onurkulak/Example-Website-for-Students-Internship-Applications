<?php
session_start();

?>
<html>
 <head>
  <title>Student Welcome</title>
 </head>
 <body>
  <?php 
  $GLOBALS['username'] = "onur.kulak";
  $GLOBALS['password'] = "onurcs353";
  $GLOBALS['hostname'] = "localhost"; 
  $GLOBALS['tablename'] = "onur_kulak"; 

  $dbhandle = mysql_connect($GLOBALS['hostname'], $GLOBALS['username'], $GLOBALS['password'])
    or die("Unable to connect to MySQL");
    
    $sid = $_SESSION['sid'];

    echo($_SESSION['sid']);
    echo("\t welcome!<br />");

    $table = mysql_select_db($GLOBALS['tablename'],$dbhandle)
    or die("Could not select examples");
    if(isset($_GET['cid']))
    {
      
      $cid = $_GET['cid'];
      if(mysql_query("DELETE
            FROM apply
            WHERE cid = '$cid' AND sid = '$sid';"))
        echo "<script type='text/javascript'>alert('Succesful Deletion!')</script>";
      else
        echo "<script type='text/javascript'>alert('Failed Miserably :(:(')</script>";
    }
    $q = mysql_query("SELECT cid, cname, quota
            FROM company NATURAL JOIN apply NATURAL JOIN student
            WHERE sid = '$sid';") or die("Unable to fetch");
    
    while($row = mysql_fetch_assoc($q)){
      foreach($row as $cname => $cvalue){
        echo ("$cname: $cvalue\t");
      }
      $cid = $row['cid'];
      echo "<a href='studentWelcome.php?cid=".$cid."'>Cancel</a><br />";
    }
    echo "<a href='apply.php'>Apply for new internship</a><br />";
    echo "<a href='index.php'>Log out</a><br />";
    ?>

  </form>


 </body>
</html>