<?php require 'check_user_cookie.php'; ?>


<!DOCTYPE html>


    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Review Your Exercises</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->


        <link rel="stylesheet" href="css/workouts.css">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="../myjs/workouts.js"></script>
    </head>




<body>
<?php require 'menu.php'; ?>

 
<?php
   
   require 'connect_weights_db.php'; // Connect to project DB

   $result = mysql_query("SELECT exercises.exercise, sets, reps, weight, difficulty, time, distance, effort, date, workout_id
			  FROM workouts,exercises
			  WHERE workouts.id = exercises.id
                          AND user_id = (SELECT user_id FROM users WHERE username='$currentUser')
			  ORDER BY date DESC");
  

  

   echo "<form action=\"details.php\" method=\"get\">";  //This form is for checkboxes for more detailed view
   echo "<input type='submit' value='Delete' name='delete'>(Delete checked exercises)";
   echo "<table class=reviewTable border=1>";
   echo "<tr> <th>Date</th><th>Exercise</th> <th>weight</th> <th>reps</th><th>sets</th><th>difficulty</th><th>time</th><th>distance</th><th>effort</th>  <th><input type='submit' value='See More'></th></tr>";

   //Initialize exercise array
   $exArray = array();


   while($row = mysql_fetch_array($result))
   {

   $exercise = $row['exercise'];
   $weight = $row['weight'];
   $reps = $row['reps'];
   $sets = $row['sets'];
   $difficulty = $row['difficulty'];
   $time = $row['time'];
   $distance = $row['distance'];
   $effort = $row['effort'];
   $date = $row['date'];
   $workout_id = $row['workout_id'];      

   $olddate = $row['date'];
   $todaydate = date("Y-m-d");

   ////////////////////////////////////////
   /*Object Oriented method: not working on server for some reason
   //$date1 = new DateTime("$olddate");
   //$date2 = new DateTime("$todaydate");
   //$interval = $date1->diff($date2);
   // note that the interval->d function needs to be fixed
   //echo "<tr> <td>" . $exercise . "</td> <td> " . $weight .  "</td> <td> " . $interval->d . " days ago</td> <td><input type=\"checkbox\"  name=\"$exercise\" value='1'></td></tr>";
   ///////////////////////////////////////*/

   ///////////////////////////////////////////
   /*Epoch time method: works better on server*/
   //$date1 = strtotime("$olddate");
   //$date2 = strtotime("$todaydate");   
   //$interval = $date2 - $date1;
   //$interval = $interval / 86400;
   //////////////////////////////////////////

   
   
   ////////////////////////////////////////////////////////////////
   //Fill $exArray with each exercise. Check array in each iteration to see
   //If exercise has been shown already. If not, use bold style on first instance
   
echo "
<tr> 
<td> $date </td>
<td> $exercise </td> 
<td> $weight </td> 
<td> $reps </td>
<td> $sets</td>
<td> $difficulty</td>
<td> $time </td>
<td> $distance</td>
<td> $effort</td>

<td><input type='checkbox'  name='workouts[]' value='$workout_id' /></td>
</tr>";
//<td><input type='checkbox'  name='exercises[]' value='$exercise' /></td>   
   
      


   array_push($exArray, $exercise);
   /////////////////////////////////////////////

   }
   

   echo "</table>";
   echo "</form>";
?>


<br><br><?php require 'menu.php'; ?>
</body>
</HTML>
