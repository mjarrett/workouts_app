<?php require 'check_user_cookie.php'; ?>

<?php

//IF user has chosen to delete an exercise, do this part:

print_r($_GET);
echo $_GET[remove][0][date];



require 'connect_weights_db.php'; // Connect to project DB

//$result = mysql_query("DELETE FROM workouts WHERE date=

?>


<HTML>
<title>
Edit Your Exercises
</title>

<body>

 <?php require 'header.php';  /*Display header*/ ?>

<?php


 

   
   require 'connect_weights_db.php'; // Connect to project DB

   $result = mysql_query("SELECT exercises.exercise, sets, reps, weight, date
			  FROM workouts,exercises
			  WHERE workouts.id = exercises.id
                          AND user_id = (SELECT user_id FROM users WHERE username='$currentUser')
			  ORDER BY date DESC");
  

  

   echo "<form action=\"delete.php\" method=\"get\">";  //This form is for checkboxes for more detailed view
   echo "<table border=1>";
   echo "<tr> <th>Exercise</th> <th>weight</th>  <th>date</th> <th><input type='submit' value='Delete'></th></tr>";

   //Initialize exercise array
   $exArray = array();


   while($row = mysql_fetch_array($result))
   {

   $exercise = $row['exercise'];
   $weight = $row['weight'];
   

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
<td>  $weight </td> 
<td>  $interval  days ago</td> 
<td><input type='checkbox'  name='remove[]' value='$remove' /> </td>
</tr>";
   }
   
  
   else{
     
     echo "
<tr> 
<td> $exercise </td> 
<td>  $weight </td> 
<td>  $interval  days ago</td> 
<td><input type='checkbox'  name='remove[]' value='array(exercise=>$exercise, date=>$olddate)' /></td>
</tr>";
   }

   array_push($exArray, $exercise);
   /////////////////////////////////////////////
   }
   
//echo "<tr><td></td><td></td><td></td><td><input type='submit' name = 'submit' value='HIT ME'></td></tr>";
   echo "</table>";
   echo "</form>";
?>


<br><br><?php require 'bottom_menu.php'; ?>
</body>
</HTML>
