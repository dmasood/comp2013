<html>
    <head>
        <title>Search Registration</title>
    </head>

    <body>
    <form name="search" method="get" action="search.php">
 Search: <input type="text" name="search" /> 
 <input type="submit" name="submit" value="submit"/>

    </form>

    </body>
</html>

<?php  // Get the search variable from URL
if(!isset($_GET['search']))
die(“Not found”);$var = $_GET['search'];
$trimmed = trim($var); //trim whitespace from the stored variable
// rows to return
$limit=10;

// check for an empty string and display a message.
if ($trimmed == “”){
echo “<p>No search term entered</p>”;
exit;
}

// check for a search parameter
if (!isset($var)){
echo “<p>We dont seem to have a search parameter!</p>”;
exit;
}

//connect to your database ** EDIT REQUIRED HERE **
mysql_connect(“eu-cdbr-azure-west-b.cloudapp.net”,”b3a6e6cf186fd1”,”2e13d16d”);

//specify database ** EDIT REQUIRED HERE **
mysql_select_db(“danyaalAOKafhgnx”) or die(“Unable to select database”);
// Build SQL Query
$query = “select * from registration_tbl where company like \”%$trimmed%\” or name like \”%$trimmed%\” or email like \”%$trimmed%\” or date like \”%$trimmed%\” order by name DESC”;

// EDIT the above SQL query and specify your table and field names

$numresults=mysql_query($query);
$numrows=mysql_num_rows($numresults);

// If we have no results, offer a google search as an alternative — this is optional

// next determine if s has been passed to script, if not use ZERO (0) to Limit the output
if (empty($s)) {
$s=0;
}

// get results
$query .= ” limit $s,$limit”;
$result = mysql_query($query) or die(“Couldn’t execute query”);

// display what the person searched for
echo “<p>You searched for: $var </p>”;

// begin to show results set
echo “Results: <br/>”;
$count = 1 + $s ;

// now you can display the results returned
while ($row= mysql_fetch_array($result)) {
$name = $row["name"];
$email = $row["email"];
$company = $row["company"];
$date = $row["date"];

echo “$count.> $name $email $company $date<br/>” ;
$count++ ;
}

?>
