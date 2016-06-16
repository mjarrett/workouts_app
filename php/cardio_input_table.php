  <span id="cardioText" class="title" onclick="showEl('cardioTable')">Choose an existing cardio:</span>
  <div id="cardioTable" style="display: none">
  <form id="inputFormCardio" action="process_input.php" method="post">
  <table>
  <tr>
  <td> </td>
  <td><select name="cardio">
  <option>--exercise--</option>
<?php

   require 'connect_weights_db.php'; // Connect to project DB

   $result = mysql_query("SELECT exercise FROM `exercises` WHERE type='1' ORDER BY exercise");

   //for each row returned by sql query, add an item to drop-down menu
   while($row = mysql_fetch_array($result))
   {
   $item=$row['exercise'];
   echo "<option value=\"$item\">$item</option>";
   echo "<br />";
   }

?>
    </select>   </td>
   </tr>
   <tr><td>Time:</td> <td><select name="time"><option></option> <?php for ($y=0; $y<5; $y++) {for ($x=0; $x<60; $x++) { if ($x < 10) {echo "<option>$y:0$x</option>";} else {echo "<option>$y:$x</option>";}}} ?></select> H:MM</td></tr>
   <tr><td>Distance:</td> <td><select name="distance"><option></option> <?php for ($x=0; $x<1000; $x++) {if ($x % 10 == 0) { echo "<option>" . $x/10 . ".0</option>";} else{ echo "<option>" . $x/10 . "</option>";}} ?></select> km</td></tr>
   <tr><td>Effort:</td> <td><select name="effort"><option></option> <?php for ($x=0; $x<11; $x++) {echo "<option>$x</option>";} ?></select> 0-10</td></tr>
<tr><td>Date:</td><td><?php require 'date_select.php'?></td></tr>
  </table>


<span id="moreCardioInputText" class="moreInputText" onclick="showEl('moreCardioInput');">More options &raquo</span>
<div id=moreCardioInput class=moreInput style="display:none;">
<table>
<tr><td>Sets:</td> <td><select name="sets"><option></option> <?php for ($x=0; $x<11; $x++) { echo "<option>$x</option>"; } ?></select></td></tr>
  <tr><td>Reps:</td> <td><select name="reps"><option></option> <?php for ($x=0; $x<11; $x++) { echo "<option>$x</option>";} ?></select></td></tr>
  <tr><td>Weight:</td> <td><select name="weight"> <?php echo "<option></option>"; for ($x=0; $x<300; $x=$x+2.5) {echo "<option>$x</option>";} ?> </select> </td></tr>
<tr><td><input type="radio" name="difficulty" value="2"></td><td>Easy</td></tr>
<tr><td><input type="radio" name="difficulty" value="1" checked></td><td>Success</td></tr>
<tr><td><input type="radio" name="difficulty" value="0"></td><td>Fail</td></tr>
</table>
</div>
<br />

<input class=inputSubmit type="submit" value="Submit" />
</form>
</div>

<br />
<br />
<span id="newCardioText" class="title" onclick="showEl('newCardioTable')">Add a new cardio exercise:</span>
<div id="newCardioTable" style="display: none">
<table>
<form action="process_input.php" method="post">
  <tr><td>Name:</td> <td><input type="text" name="newCardio" /></td></tr>
  <tr><td>Time:</td> <td><select name="time"><option></option> <?php for ($y=0; $y<5; $y++) {for ($x=0; $x<60; $x++) { if ($x < 10) {echo "<option>$y:0$x</option>";} else {echo "<option>$y:$x</option>";}}} ?></select> H:MM</td></tr>
   <tr><td>Distance:</td> <td><select name="distance"><option></option> <?php for ($x=0; $x<1000; $x++) {if ($x % 10 == 0) { echo "<option>" . $x/10 . ".0</option>";} else{ echo "<option>" . $x/10 . "</option>";}} ?></select> km</td></tr>
   <tr><td>Effort:</td> <td><select name="effort"><option></option> <?php for ($x=0; $x<11; $x++) {echo "<option>$x</option>";} ?></select> 0-10</td></tr>
<tr><td>Date:</td><td><?php require 'date_select.php'?></td></tr>
</table>

<span id=moreCardioInputText1 class=moreInputText onclick="showEl('moreCardioInput1');">More options &raquo</span>
<div id=moreCardioInput1 class=moreInput style="display:none;">
<table>
<tr><td>Sets:</td> <td><select name="sets"><option></option> <?php for ($x=0; $x<11; $x++) { echo "<option>$x</option>";} ?></select></td></tr>
  <tr><td>Reps:</td> <td><select name="reps"><option></option> <?php for ($x=0; $x<11; $x++) {  echo "<option>$x</option>";} ?></select></td></tr>
  <tr><td>Weight:</td> <td><select name="weight"> <?php echo "<option></option>"; for ($x=0; $x<300; $x=$x+2.5) {echo "<option>$x</option>";} ?> </select> </td></tr>
<tr><td><input type="radio" name="difficulty" value="2"></td><td>Easy</td></tr>
<tr><td><input type="radio" name="difficulty" value="1" checked></td><td>Success</td></tr>
<tr><td><input type="radio" name="difficulty" value="0"></td><td>Fail</td></tr>

</table>
</div>
<br />

<input class=inputSubmit type="submit" value="Submit" />
</form>
</div>


<br />
<br />
<button type="button" onclick="showEl('reviewTableCardio');">Show Previous</button>
<div id="reviewTableCardio" style="display:none;">
<?php require 'review_table_cardio.php'; // Build review table ?>
</div>
