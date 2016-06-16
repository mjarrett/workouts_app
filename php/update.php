<?php

//INITIALIZE VARIABLES FROM FORM
$exercise = $_POST["exercise"];
$sets = $_POST["sets"];
$reps = $_POST["reps"];
$weight = $_POST["weight"];
$difficulty = $_POST["difficulty"];
$time = $_POST["time"];
$distance = $_POST["distance"];
$effort = $_POST["effort"];
$year = $_POST["year"];
$month = $_POST["month"];
$day = $_POST["day"];

$date = $year . "-" . $month . "-" . $day;

//SET TODAY'S DATE
//$today_date = date("Y-m-d");

//SET DEFAULTS
if($sets == ''){$sets = 'NULL';};
if($reps == ''){$reps = 'NULL';};
if($weight == ''){$weight = 'NULL';};


require 'connect_weights_db.php'; // Connect to project DB



//Insert new workout into DB
mysql_query("INSERT INTO workouts(id,date,sets,reps,weight,user_id,difficulty,time,distance,effort)  VALUES((SELECT id FROM exercises WHERE exercise='$exercise'),'$date',$sets,$reps,$weight,(SELECT user_id FROM users WHERE username='$currentUser'),$difficulty,'$time','$distance','$effort')");


mysql_close($con);

//echo "<span class=\"updateText\">Added workout: $exercise</span>";

//$_SESSION['updateText'] = "Added workout: $exercise $time"  //This is the text that will be passed back to main page for display 

echo $exercise;

?>