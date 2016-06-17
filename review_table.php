<?php


   
   require 'connect_weights_db.php'; // Connect to project DB

   $result = mysql_query("SELECT exercises.exercise, sets, reps, weight, date, difficulty, workout_id
			  FROM workouts,exercises
			  WHERE workouts.id = exercises.id
                          AND user_id = (SELECT user_id FROM users WHERE username='$currentUser')
			  AND type = '0'
			  ORDER BY date DESC");
  

  

   echo "<form action=\"details.php\" method=\"get\">";  //This form is for checkboxes for more detailed view
   echo "<table class=reviewTable border=1>";
   echo "<tr> <th>Exercise</th> <th>Weight</th><th>Sets</th><th>Reps</th>  <th>Date</th> <th><input type='submit' value='See More'></th></tr>";

   //Initialize exercise array
   $exArray = array();


   while($row = mysql_fetch_array($result))
   {

   $exercise = $row['exercise'];
   $weight = $row['weight'];
   $sets = $row['sets'];
   $reps = $row['reps'];
   $difficulty = $row['difficulty'];   
   $workout_id = $row['workout_id'];

   $olddate = $row['date'];
   $todaydate = date("Y-m-d");


   // Round off trailing zeros or superfluous decimals from weight
   //$weight = preg_replace('~0*$~', '', $weight);
   //$weight = preg_replace('~\.\z~', '', $weight);


   ///////////////////////////////////////////
   /*Epoch time method: works better on server*/
   $date1 = strtotime("$olddate");
   $date2 = strtotime("$todaydate");   
   $interval = $date2 - $date1;
   $interval = round($interval / 86400);
   //////////////////////////////////////////

   //make an array that holds the exercise and date in case the user wants to delete
   //$remove = array(exercise=>$exercise, date=>$olddate);
   
   ////////////////////////////////////////////////////////////////
   //Fill $exArray with each exercise. Check array in each iteration to see
   //If exercise has been shown already. If not, use bold style on first instance
   
   if(! in_array($exercise, $exArray)) {
     

     //If difficulty = 0, print in red
     if($difficulty == "0") { echo "<tr><td><span class='recent'>  $exercise</span></td> <td><span title='Failed! Deload and try again' class='fail'>$weight</span> </td> <td>$sets</td><td>$reps</td> <td>  $interval  days ago</td> <td><input type='checkbox'  name='workouts[]' value='$workout_id' /></td></tr>"; }

     //If difficulty = 2, print in green
     elseif($difficulty == "2") { echo "<tr><td><span class='recent'>  $exercise </span></td> <td><span title='Easy! Add a bit more weight next time' class='easy'>  $weight </span></td><td>$sets</td><td>$reps</td> <td>  $interval  days ago</td> <td><input type='checkbox'  name='workouts[]' value='$workout_id' /></td></tr>";}
     
     //Otherwise, no extra style
     else { echo "<tr><td><span class='recent'><strong>  $exercise </strong></span></td> <td><span class='success'>  $weight </span> </td><td>$sets</td><td>$reps</td> <td>  $interval  days ago</td> <td><input type='checkbox'  name='workouts[]' value='$workout_id' /></td></tr>"; }



}
    
////////////////////////////
// For now, try just showing recent exercises
////////////////////////////   

   
   else{
     
     //If difficulty = 0, print in red
     if($difficulty == "0") { echo "<tr><td><span>  $exercise</span></td> <td><span title='Failed! Deload and try again' class='fail'>$weight</span> </td><td>$sets</td><td>$reps</td> <td>  $interval  days ago</td> <td><input type='checkbox'  name='workouts[]' value='$workout_id' /></td></tr>"; }

     //IF difficulty = 2, print in green
     elseif($difficulty == "2") { echo "<tr><td><span>  $exercise </span></td> <td><span title='Easy! Add a bit moreweight next time' class='easy'>  $weight </span></td><td>$sets</td><td>$reps</td> <td>  $interval  days ago</td> <td><input type='checkbox'  name='workouts[]' value='$workout_id' /></td></tr>";}


     else {echo "<tr> <td> $exercise </td> <td>  $weight </td> <td>$sets</td><td>$reps</td><td>  $interval  days ago</td> <td><input type='checkbox'  name='workouts[]' value='$workout_id'></td> </tr>"; }
     }




   array_push($exArray, $exercise);
   /////////////////////////////////////////////

   }
   
//echo "<tr><td></td><td></td><td></td><td><input type='submit' name = 'submit' value='HIT ME'></td></tr>";
   echo "</table>";
   echo "</form>";
?>


