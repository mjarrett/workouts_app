<html>
<head>
<script>
function submitXML() {

  xmlhttp=new XMLHttpRequest();

  xmlhttp.onreadystatechange=function() // This is the function that will run when we get a response from the server
  {
  	if (xmlhttp.readyState==4 && xmlhttp.status==200)
    	{
    	document.getElementById("myspan").innerHTML=xmlhttp.responseText;
    	}
  }


  // Get values from various form elements
  var exercise = document.getElementById("exercise").value;


  xmlhttp.open("POST","ajaxtest.php",true); //type of request, script to call, true=asynchronous
  xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  xmlhttp.send("fname="+exercise);

}
</script>
</head>

<body>

<span id="existsText" class="title" onclick="showEl('existsTable')">Choose an existing exercise:</span>
  <div id="existsTable">
  <form action="process_input.php" method="post">
  <table>
  <tr>
  <td> </td>
  <td><select id="exercise" name="exercise">
  <option>--exercise--</option>
<?php

   require 'connect_weights_db.php'; // Connect to project DB

   $result = mysql_query("SELECT exercise FROM `exercises` WHERE type='0' ORDER BY exercise");

   //for each row returned by sql query, add an item to drop-down menu
   while($row = mysql_fetch_array($result))
   {
   $item=$row['exercise'];
   echo "<option value=\"$item\">$item</option>";
   echo "<br />";
   }

?>
    </select>
   </td>
   </tr>

   <tr><td>Sets:</td> <td><select name="sets"><option></option> <?php for ($x=0; $x<11; $x++) { if ($x==3){echo "<option selected='selected'>$x</option>";} else{echo "<option>$x</option>";}} ?></select></td></tr>
  <tr><td>Reps:</td> <td><select name="reps"><option></option> <?php for ($x=0; $x<11; $x++) { if ($x==5){echo "<option selected='selected'>$x</option>";} else{echo "<option>$x</option>";}} ?></select></td></tr>

    <tr>
    <?php
    echo "<td>Weight</td> <td> <select name='weight'>";
    echo "<option></option>";
    for ($x=0; $x<500; $x=$x+2.5) {
        echo "<option>$x</option>";
        }
    echo "</select>"
   ?>
    </td></tr>
<tr><td><input type="radio" name="difficulty" value="2"></td><td>Easy</td></tr>
<tr><td><input type="radio" name="difficulty" value="1" checked></td><td>Success</td></tr>
<tr><td><input type="radio" name="difficulty" value="0"></td><td>Fail</td></tr>
<tr><td>Date:</td><td><?php require 'date_select.php'?></td></tr>
  </table>

<input class=inputSubmit type="submit" value="Submit" />

</form>
<button class=inputSubmit onclick="submitXML()">AJAX button</button>

<br>
<span id="myspan"></span>

</body>




</html>