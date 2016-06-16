<?php

/*read cfg file*/
$myfile = fopen("/home/protected/db_login.cfg","r") or die("Unable to open file");
while(!feof($myfile)) {
$pwd = fgets($myfile);
}


/*Connect to mySQL*/ 
$con = mysql_connect("mikesdb.db","mjarrett",$pwd); 
if (!$con) { die('Could not connect: ' . mysql_error()); }

//Find weights DB
$db_found = mysql_select_db("weights");
if (! $db_found) { die('Database *weights* NOT found: ' . mysql_error()); }  

?>
