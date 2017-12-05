<?php
session_start();

?>
<html>
 <head>
  <title>Apply a new Internship</title>
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

    if( 3>mysql_num_rows(mysql_query(
      "SELECT * FROM apply WHERE sid = '$sid';")))
    {
      if(isset($_GET['cid']))
      {
        $application = false;
        
        
          $cid = $_GET['cid'];
          if( 1!=mysql_num_rows(mysql_query(
            "SELECT * FROM apply WHERE sid = '$sid' AND cid = '$cid' ;")))
          {
            
            if (1==mysql_num_rows(mysql_query(
            "SELECT * FROM company 
            WHERE cid = '$cid' AND quota > 
            (SELECT COUNT(*) c FROM apply WHERE apply.cid = '$cid');"))) 
            {
              if(mysql_query("INSERT INTO apply(sid,cid) VALUES ('$sid','$cid')"))
                $application = true;
              else{echo "Failed to insert <br /><br />";}
            }
            else{echo "This company's quota is full or it does not exist <br /><br />";}
          }
          else{echo "You already applied to this company<br /><br />";}
        
        
        if($application)
        echo "Successfully Applied<br /><br />";
        else echo "Unable to Apply<br /><br />";
      }
    
    

      $q = mysql_query("SELECT C.cid, C.cname, C.quota
              FROM company C
              WHERE C.quota > 
            (SELECT COUNT(*) FROM apply WHERE apply.cid = C.cid)
            AND NOT EXISTS 
            (SELECT * FROM apply 
              WHERE C.cid = apply.cid AND apply.sid = '$sid');") 
      or die("Unable to fetch");
      
      if( 3>mysql_num_rows(mysql_query(
      "SELECT * FROM apply WHERE sid = '$sid';"))){
        while($row = mysql_fetch_assoc($q)){
          foreach($row as $cname => $cvalue){
            echo ("$cname: $cvalue\t");
          }
          echo "<br />";
        }
    
    ?>

    <form action="apply.php" method="get">
    <p>Company ID: <input type="text" name="cid" required/></p>
    <p><input type="submit" /></p>
     
    <?php }
  }
    else
    {
      echo "You can't apply to more than 3 companies<br /><br />";
    }
    ?>
    <a href='studentWelcome.php'>Return to previous page</a><br />
    <a href='index.php'>Log out</a><br />
 </body>
</html>