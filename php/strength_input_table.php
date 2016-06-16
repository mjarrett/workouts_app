<span id="existsText" class="title" onclick="showEl('existsTable')">Choose an existing exercise:</span>
  <div id="existsTable" style="display: none">
  <form id="inputForm" action="process_input.php" method="post">
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

   <tr><td>Sets:</td> <td><select id="sets" name="sets"><option></option> <?php for ($x=0; $x<11; $x++) { if ($x==3){echo "<option selected='selected'>$x</option>";} else{echo "<option>$x</option>";}} ?></select></td></tr>
  <tr><td>Reps:</td> <td><select id="reps" name="reps"><option></option> <?php for ($x=0; $x<11; $x++) { if ($x==5){echo "<option selected='selected'>$x</option>";} else{echo "<option>$x</option>";}} ?></select></td></tr>

    <tr>
    <?php
    echo "<td>Weight</td> <td> <select id='weight' name='weight'>";
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


<span id=moreStrengthInputText class=moreInputText onclick="showEl('moreStrengthInput');">More options &raquo</span>
<div id=moreStrengthInput class=moreInput style="display:none;">
<table>
<tr><td>Time:</td> <td><select name="time"><option></option> <?php for ($y=0; $y<5; $y++) {for ($x=0; $x<60; $x++) { if ($x < 10) {echo "<option>$y:0$x</option>";} else {echo "<option>$y:$x</option>";}}} ?></select> H:MM</td></tr>
<tr><td>Distance:</td> <td><select name="distance"><option></option> <?php for ($x=0; $x<1000; $x++) {if ($x % 10 == 0) { echo "<option>" . $x/10 . ".0</option>";} else{ echo "<option>" . $x/10 . "</option>";}} ?></select> km</td></tr>
<tr><td>Effort:</td> <td><select name="effort"><option></option> <?php for ($x=0; $x<11; $x++) {echo "<option>$x</option>";}?></select> 0-10</td></tr>
</table>
</div>
<br />



<input class=inputSubmit type="submit" value="Submit" />
<div id='strength_preloader' class='preloader' style="display:none;"><img src="../../images/loading.gif" width="42" height="42"></div>
</form>

<br />

<br />
</div>




<br /><br /><span id="newText" class="title" onclick="showEl('newTable');" onmouseover="highlight('newText')" onmouseout="unhighlight('newText')">Add a new exercise:</span> <br />
<div id="newTable" style="display:none;">
<table>
<form action="process_input.php" method="post">
  <tr><td>Name:</td> <td><input type="text" name="newExercise" /></td></tr>
  <tr><td>Sets:</td> <td><select name="sets"><option></option> <?php for ($x=0; $x<11; $x++) { if ($x==3){echo "<option selected='selected'>$x</option>";} else{echo "<option>$x</option>";}} ?></select></td></tr>
  <tr><td>Reps:</td> <td><select name="reps"><option></option> <?php for ($x=0; $x<11; $x++) { if ($x==5){echo "<option selected='selected'>$x</option>";} else{echo "<option>$x</option>";}} ?></select></td></tr>
  <tr><td>Weight:</td> <td><select name="weight"> <?php echo "<option></option>"; for ($x=0; $x<300; $x=$x+2.5) {echo "<option>$x</option>";} ?> </select> </td></tr>
<tr><td><input type="radio" name="difficulty" value="2"></td><td>Easy</td></tr>
<tr><td><input type="radio" name="difficulty" value="1" checked></td><td>Success</td></tr>
<tr><td><input type="radio" name="difficulty" value="0"></td><td>Fail</td></tr>
<tr><td>Date:</td><td><?php require 'date_select.php'?></td></tr>
</table>



<span id=moreStrengthInputText1 class=moreInputText onclick="showEl('moreStrengthInput1');">More options &raquo</span>
<div id=moreStrengthInput1 class=moreInput style="display:none;">
<table>
<tr><td>Time:</td> <td><select name="time"><option></option> <?php for ($y=0; $y<5; $y++) {for ($x=0; $x<60; $x++) { if ($x < 10) {echo "<option>$y:0$x</option>";} else {echo "<option>$y:$x</option>";}}} ?></select> H:MM</td></tr>
<tr><td>Distance:</td> <td><select name="distance"><option></option> <?php for ($x=0; $x<1000; $x++) {if ($x % 10 == 0) { echo "<option>" . $x/10 . ".0</option>";} else{ echo "<option>" . $x/10 . "</option>";}} ?></select> km</td></tr>
<tr><td>Effort:</td> <td><select name="effort"><option></option> <?php for ($x=0; $x<11; $x++) {echo "<option>$x</option>";}?></select> 0-10</td></tr>
</table>
</div>
<br />
<input class=inputSubmit type="submit" value="Submit" />
</form>

<br />
</div>
<br />



<button type="button" onclick="showEl('reviewTable');">Show Recent</button>
<div id="reviewTable" style="display:none;">
<?php require 'review_table.php'; // Build review table ?>
</div>
