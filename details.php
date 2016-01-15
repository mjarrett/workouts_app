<?php require 'check_user_cookie.php';  //This checks that a user is logged in 
      require 'connect_weights_db.php'; // Connect to project DB


//////////////
//IF delete button is pressed

if ( $_GET['delete']) {

  foreach($_GET['workouts'] as &$workout) {
 
     $results = mysql_query("DELETE FROM `workouts` WHERE workout_id = $workout");
    
     }

   header('Location: review.php');
}
////////////////////
///////////////////
?>



<!DOCTYPE html>


    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Exercise Details</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->


        <link rel="stylesheet" href="css/workouts.css">
        <script src="../myjs/workouts.js"></script>
    </head>




<html>
<body>

<?php require 'menu.php'; //Put Menu up top




echo "<br />";

//initialize points array which is passed to make_plot.php
$points = array();
$date = array();
$exercises_array = array();

///////////////////////////
// Convert workout_id into exercise name, pass to next step
///////////////////////////
$workouts_array = $_GET['workouts'];
foreach($workouts_array as &$workout) {

$result = mysql_query("SELECT exercises.exercise 
	   	        FROM workouts,exercises
			WHERE workouts.id = exercises.id
			AND workout_id = '$workout'");



while($row = mysql_fetch_array($result)) {
	   
	   array_push($exercises_array,$row['exercise']);
    }
}
/////////////////////////////////////
/////////////////////////////////////

//Clear duplicates 
$exercises_array = array_unique($exercises_array);

//Check which exercises got checkmarks
foreach($exercises_array as &$exercise) {



  echo "<h2>" . $exercise . "</h2>";

  echo "<div class='container'>"; //container div for each exercise			 

  
echo "<span id='$exercise.Text' onclick=\"showEl('$exercise')\" onmouseover=\"highlight('$exercise.Text')\" onmouseout=\"unhighlight('$exercise.Text')\">(Show raw data)</span>";

  //Make a div to hold the table
  echo "<div id='$exercise' class='weightTable' style='display: none' onclick=\"showEl('$exercise')\">";

  //Start a table
  
  echo  "<table border='1'>";
  echo "<tr><th>Date</th><th>Sets</th><th>Reps</th><th>Weight</th>";

   //SQL Query to fill rows of table
   $result = mysql_query("SELECT exercises.exercise as exercise, sets, reps, weight, date, difficulty
			  FROM workouts,exercises
			  WHERE workouts.id = exercises.id 
                          AND exercises.exercise = '$exercise'
			  AND workouts.user_id = (SELECT user_id FROM users WHERE username='$currentUser')
                          ORDER BY date DESC");
  
   
   while($row = mysql_fetch_array($result))
   {

     //Make and fill table row
     echo "<tr>";
     echo "<td> " . $row['date'] . "</td><td>" . $row['sets'] . "</td><td>" . $row['reps'] . "</td><td>" . $row['weight'] . "</td>";
     echo "</td>";


     //Only add data to points array if you didn't fail
     if ($row['difficuly'] != '0') {

          //Add weight variable to "points" array that will be passed to plot funtion 
     	  //(unshift adds to beginning of array)

          array_unshift($points,$row['weight']);
          array_unshift($date,strtotime($row['date']));     
	  }  
    }



   
   echo "</table>"; //Close table
   echo "</div>"; //Close weighTable div
   echo "<br>";



   //Make plot, unless there's no weight attached to exercise
//   if(isset($points[0])){

     
     //require('make_plot2.php');

     


     //This step turns $points array into a single string,
     //then encodes it as a url to pass to the jpgraphs
     //php script. It is uncoded/unserialized there
     
     $points_serialized = urlencode(serialize($points));
     $date_serialized = urlencode(serialize($date));


     //Make a div to hold the graph
     echo "<div class='weightPlot'>";

     //Call the jpgraphs php script as an image source

     echo "<img border=\"0\" src=\"make_plot.php?points=" . $points_serialized . "&date=" . $date_serialized . "\">";    

     echo "</div>"; //close weightPlot div
//     }
   //Clear points array for next iteration
   $points = array();
   $date = array();

   echo "</div>";  //close exercise container div
}

?>  




</body>
</html>
