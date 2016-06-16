<?php

$bodyWeight = $_POST["bodyWeight"];

     
  
/*SET DEFAULTS*/
if($bodyWeight == "") {echo "Error: no weight given. Try again";}
else{
  require 'connect_weights_db.php'; // Connect to project DB
     

  
  
  //Set date
  $today_date = date("Y-m-d");

  
  //Insert new workout into DB
  mysql_query("INSERT INTO weight (user_id,weight,date) VALUES((SELECT user_id FROM users WHERE username='$currentUser'),'$bodyWeight','$today_date')");
  

//  echo "<span class=\"updateText\">Added body weight: $bodyWeight</span>";
$_SESSION['updateText'] = "Added body weight: $bodyWeight";
}

  
mysql_close($con);



?>