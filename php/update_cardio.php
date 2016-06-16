<?php

//INITIALIZE VARIABLES FROM FORM
$exercise = $_POST["cardio"];
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



//SET DEFAULTS
//if($time == ''){$time = 'NULL';};
//if($distance == ''){$distance = 'NULL';};
//if($effort == ''){$effort = 'NULL';};


require 'connect_weights_db.php'; // Connect to project DB



//SET TODAY'S DATE
//$today_date = date("Y-m-d");

//Insert new workout into DB
mysql_query("INSERT INTO workouts (id,date,time,distance,effort,user_id,sets,reps,weight,difficulty)  VALUES((SELECT id FROM exercises WHERE exercise='$exercise'),'$date','$time','$distance','$effort',(SELECT user_id FROM users WHERE username='$currentUser'),'$sets','$reps','$weight','$difficulty')");


mysql_close($con);

//echo "Added workout: $exercise";
//echo "<span class=\"updateText\">Added Cardio: $exercise </span>";
$_SESSION['updateText'] = "Added Cardio: $exercise";
?>