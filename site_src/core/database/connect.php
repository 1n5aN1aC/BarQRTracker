<?php

$dbhost = 'oniddb.cws.oregonstate.edu';
$dbname = 'rindalp-db';
$dbuser = 'rindalp-db';
$dbpass = 'JQ5oHzbkwybe06qx';

$mysql_handle = mysql_connect($dbhost, $dbuser, $dbpass)
    or die("Error connecting to database server");
	//

mysql_select_db($dbname, $mysql_handle)
    or die("Error selecting database: $dbname");
	//
	
?>