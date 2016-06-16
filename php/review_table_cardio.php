
 
<?php
   
   require 'connect_weights_db.php'; // Connect to project DB

   $result = mysql_query("SELECT exercises.exercise, time, distance, effort, date, workout_id
			  FROM workouts,exercises
			  WHERE workouts.id = exercises.id
			  AND type = '1'
                          AND user_id = (SELECT user_id FROM users WHERE username='$currentUser')
			  ORDER BY date DESC");
  

  

   echo "<form action=\"details.php\" method=\"get\">";  //This form is for checkboxes for more detailed view
   echo "<table border=1 class=reviewTable>";
   echo "<tr> <th>Exercise</th> <th>Time</th> <th>Distance</th> <th>Date</th> <th><input type='submit' value='See More'></th></tr>";

   //Initialize exercise array
   $exArray = array();


   while($row = mysql_fetch_array($result))
   {

   $exercise = $row['exercise'];
   $time = $row['time'];
   $distance = $row['distance'];
   $workout_id = $row['workout_id'];

   $olddate = $row['date'];
   $todaydate = date("Y-m-d");


   ///////////////////////////////////////////
   /*Epoch time method: works better on server*/
   $date1 = strtotime("$olddate");
   $date2 = strtotime("$todaydate");   
   $interval = $date2 - $date1;
   $interval = $interval / 86400;
   //////////////////////////////////////////


   
   ////////////////////////////////////////////////////////////////
   //Fill $exArray with each exercise. Check array in each iteration to see
   //If exercise has been shown already. If not, use bold style on first instance
   
   if(! in_array($exercise, $exArray)) {
     echo "
<tr> 
<td><b>  $exercise </b></td> 
<td>  $time </td>
<td> $distance </td> 
<td>  $interval  days ago</td> 
<td><input type='checkbox'  name='workouts[]' value='$workout_id' /></td>
</tr>";
   }
   
      
   else{
     
     echo "
<tr> 
<td> $exercise </td> 
<td>  $time </td>
<td> $distance </td> 
<td>  $interval  days ago</td> 
<td><input type='checkbox'  name='workouts[]' value='$workout_id'></td>
</tr>";
   }

   array_push($exArray, $exercise);
   /////////////////////////////////////////////

   }
   
//echo "<tr><td></td><td></td><td></td><td><input type='submit' name = 'submit' value='HIT ME'></td></tr>";
   echo "</table>";
   echo "</form>";
?>


