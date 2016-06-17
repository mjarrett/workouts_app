<?php

$exercise = $_POST["newCardio"];
$time = $_POST["time"];
$distance = $_POST["distance"];
$effort = $_POST["effort"];
$sets = $_POST["sets"];
$reps = $_POST["reps"];
$weight = $_POST["weight"];
$difficulty = $_POST["difficulty"];
$type = 1; //This is the type of exercise (lift=0, cardio=1)
$year = $_POST["year"];
$month = $_POST["month"];
$day = $_POST["day"];
$date = $year . "-" . $month . "-" . $day;
  
/*SET DEFAULTS*/
if($time == "") {$time = "NULL";}
if($distance == "") {$distance = "NULL";}
if($effort == "") {$effort = "NULL";}

require 'connect_weights_db.php'; // Connect to project DB
     


//Verify that new exercise input is really new
$results = mysql_query("SELECT exercise FROM exercises WHERE exercise='$exercise' AND type='$type'");

$doInsert = 1; //This variable is turned off iff new exercise is a double
while($row = mysql_fetch_array($results))
  {

    if($row['exercise'] == $exercise)
      {
	$doInsert = 0;
      }
  }

if($doInsert <> 1)
  { $_SESSION['updateText'] = "This exercise already exists. Please try again"; }
else
  {
    
    //Insert new exercise into DB
    mysql_query("INSERT INTO exercises VALUES((SELECT max+1 AS new_id FROM (SELECT MAX(id) AS max FROM `exercises`)t),'$exercise','$type')");
    
    
    //Set date
    //$today_date = date("Y-m-d");
    
    //Insert new cardio into DB
    mysql_query("INSERT INTO workouts (id,date,time,distance,effort,user_id,sets,reps,weight,difficulty)  VALUES((SELECT id FROM exercises WHERE exercise='$exercise'),'$date','$time','$distance','$effort',(SELECT user_id FROM users WHERE username='$currentUser'),'$sets','$reps','$weight','$difficulty')");
    

$_SESSION['updateText'] = "Added Cardio: $exercise";    
  } //Closes if statement above




mysql_close($con);



?>