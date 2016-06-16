<?php

require 'get_name.php';


echo "<nav>";

echo "<a class='topnav' href=\"./\">Home</a> | <a class= 'topnav' href=\"review.php\">Review Workouts</a> |"; 
if($super == 1) { echo " <a class='topnav' href=\"admin.php\">Admin</a> |"; }
echo " <a class='topnav' href=\"logout.php\">Logout ($displayname)</a>";

echo "<br />";
echo "</nav>";

?>
