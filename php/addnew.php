<?php

$exercise = $_POST["newExercise"];
$sets = $_POST["sets"];
$reps = $_POST["reps"];
$weight = $_POST["weight"];
$difficulty = $_POST["difficulty"];
$time = $_POST["time"];
$distance = $_POST["distance"];
$effort = $_POST["effort"];
$type = 0; //This is the type of exercise (lift=0, cardio=1)
$year = $_POST["year"];
$month = $_POST["month"];
$day = $_POST["day"];
$date = $year . "-" . $month . "-" . $day;

//Set date	  
//$today_date = date("Y-m-d");
  
/*SET DEFAULTS*/
if($weight == "") {$weight = "NULL";}
if($sets == "") {$sets = "NULL";}
if($reps == "") {$reps = "NULL";}

require 'connect_weights_db.php'; // Connect to project DB
     


//Verify that new exercise input is really new
$results = mysql_query("SELECT exercise FROM exercises WHERE exercise='$exercise' AND type='$type'");

$doInsert = 1; //This variable is turned off iff new exercise is a double
while($row = mysql_fetch_array($results))
  {
    //echo $row['exercise'];
    if($row['exercise'] == $exercise)
      {
	$doInsert = 0;
      }
  }

if($doInsert <> 1)
  { $_SESSION['updateText'] = "This exercise is already in the database. Try again."; }
else
  {
    
    //Insert new exercise into DB
    mysql_query("INSERT INTO exercises VALUES((SELECT max+1 AS new_id FROM (SELECT MAX(id) AS max FROM `exercises`)t),'$exercise','$type')");
    
    

    
    //Insert new workout into DB
    mysql_query("INSERT INTO workouts (id,date,sets,reps,weight,user_id,difficulty,time,distance,effort)  VALUES((SELECT id FROM exercises WHERE exercise='$exercise'),'$date',$sets,$reps,$weight,(SELECT user_id FROM users WHERE username='$currentUser'),$difficulty,'$time','$distance','$effort')");
    

$_SESSION['updateText'] = "Added workout: $exercise";    
  } //Closes if statement above

//echo "<span class=\"updateText\">Added workout: $exercise</span>";


mysql_close($con);



?>