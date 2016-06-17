<?php

   require 'connect_weights_db.php'; // Connect to project DB


   $points = array(); //Initialize points array to fill with weights
   $dates = array();

   $result = mysql_query("SELECT weight, date
			  FROM weight
			  WHERE user_id = (SELECT user_id FROM users WHERE username='$currentUser')
			  ORDER BY date DESC");
  

  
   
   echo "<table border=1>";
   echo "<tr> <th>weight</th>  <th>date</th> </tr>";



   while($row = mysql_fetch_array($result))
   {

   $weight = $row['weight'];
   

   $date = $row['date'];
   //$todaydate = date("Y-m-d");

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

     
echo "
<tr> 

<td>  $weight </td> 
<td>  $date</td> 

</tr>";
   	

array_push($points, $weight);
array_push($dates, strtotime($date));
   /////////////////////////////////////////////

}


   echo "</table>";

?>


