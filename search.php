<?php
$db_hostname = 'eu-cdbr-azure-west-b.cloudapp.net';
$db_username = 'b3a6e6cf186fd1';
$db_password = '2e13d16d';
$db_database = 'danyaalAOKafhgnx';

// Database Connection String
$con = mysql_connect($db_hostname,$db_username,$db_password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($db_database, $con);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Search Registration</title>
    </head>
    <body>
<form action="" method="post">  
Search: <input type="text" name="term" /><br />  
<input type="submit" value="Submit" />  
</form>  
<?php
if (!empty($_REQUEST['term'])) {

$term = mysql_real_escape_string($_REQUEST['term']);     

$sql = "SELECT * FROM registration_tbl WHERE name LIKE '%".$term."%'"; 
$r_query = mysql_query($sql); 

while ($row = mysql_fetch_array($r_query)){    
echo '<br /> Name: ' .$row['name'];  
echo '<br /> Email: '.$row['email'];  
echo '<br /> Company Name: '.$row['company'];  
echo '<br /> Date: '.$row['date'];   
}  

}
?>
    </body>
</html>