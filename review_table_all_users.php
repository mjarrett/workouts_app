<?php
   require 'check_super_cookie.php';
   
   require 'connect_weights_db.php'; // Connect to project DB

   $result = mysql_query("SELECT exercises.exercise, date, users.firstname
			  FROM workouts,exercises,users
			  WHERE workouts.id = exercises.id
			  AND workouts.user_id = users.user_id
			  ORDER BY date DESC");
  

  

   echo "<form action=\"details.php\" method=\"get\">";  //This form is for checkboxes for more detailed view
   echo "<table border=1>";
   echo "<tr> <th>Exercise</th> <th>user</th>  <th>date</th> <th><input type='submit' value='See More'></th></tr>";

   //Initialize exercise array
   $exArray = array();


   while($row = mysql_fetch_array($result))
   {

   $exercise = $row['exercise'];
   $user = $row['firstname'];
   

   $olddate = $row['date'];
   $todaydate = date("Y-m-d");


   ///////////////////////////////////////////
   /*Epoch time method: works better on server*/
   $date1 = strtotime("$olddate");
   $date2 = strtotime("$todaydate");   
   $interval = $date2 - $date1;
   $interval = $interval / 86400;
   //////////////////////////////////////////

   //make an array that holds the exercise and date in case the user wants to delete
   $remove = array(exercise=>$exercise, date=>$olddate);
   
   ////////////////////////////////////////////////////////////////
   //Fill $exArray with each exercise. Check array in each iteration to see
   //If exercise has been shown already. If not, use bold style on first instance
   
   if(! in_array($exercise, $exArray)) {
     echo "
<tr> 
<td><b>  $exercise </b></td> 
<td>  $user </td> 
<td>  $interval  days ago</td> 
<td><input type='checkbox'  name='exercises[]' value='$exercise' /></td>
</tr>";
   }
   
      
   else{
     
     echo "
<tr> 
<td> $exercise </td> 
<td>  $user </td> 
<td>  $interval  days ago</td> 
<td><input type='checkbox'  name='exercises[]' value='$exercise'></td>
</tr>";
   }

   array_push($exArray, $exercise);
   /////////////////////////////////////////////

   }
   
//echo "<tr><td></td><td></td><td></td><td><input type='submit' name = 'submit' value='HIT ME'></td></tr>";
   echo "</table>";
   echo "</form>";
?>


