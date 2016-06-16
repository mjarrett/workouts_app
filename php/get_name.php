<?php
   
// GET USERNAME FROM COOKIE
$username = $_COOKIE['username'];

require 'connect_weights_db.php'; // Connect to project DB

   //SQL Query
   $result = mysql_query("SELECT firstname
                          FROM users
                          WHERE users.username='$username';
                          ");
  

   while($row = mysql_fetch_array($result))
   {
   $displayname = $row['firstname'];
  
   }


?>  
