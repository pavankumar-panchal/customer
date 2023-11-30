<?php
if(file_exists("../include/dbconfig.php"))
	include_once('../include/dbconfig.php');
elseif(file_exists("../../include/dbconfig.php"))
	include_once('../../include/dbconfig.php');
else
	include_once('./include/dbconfig.php');

//Connect to host
$newconnection2 = mysqli_connect($pm_dbhost, $pm_dbuser, $pm_dbpwd) or die("Cannot connect to Mysql server host".$pm_dbhost);

function fetchhb($query)
{
	global $newconnection2;
	global $pm_dbname;
	
	//Connect to Database
	mysqli_select_db($pm_dbname,$newconnection2) or die("Cannot connect to database");
	set_time_limit(3600);
	
	//Run the query
	$result = mysqli_query($query,$newconnection2) or die(" run Query Failed in Runquery function1.".$query); //;
	
	//Fetch the Query to an array
	#$fetchresult = mysqli_fetch_array($result) or die("Cannot fetch the query result.".$query);
	
	//Return the result
	return $result;
}

?>
