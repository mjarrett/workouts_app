<button type="button" onclick="showEl('workoutNote');">Notes</button>



<div id='workoutNote' style="display:none">

<?php
require 'connect_weights_db.php'; // Connect to project DB

//Retrieve user note
$result=mysql_query("SELECT notes FROM users WHERE username='$currentUser' ");

while($row = mysql_fetch_array($result))
{
$note=$row['notes'];
}

//$note = nl2br($_POST["note"]);
//$note = trim($note);

echo "<pre>$note</pre>";  //pre tags needed to retain formatting. PRobably better to swap in <br>s but haven't bothered
?>

<button type="button" onclick="showEl('editWorkoutNote');">Edit Note</button>

<div id='editWorkoutNote' style="display:none">
<form action='process_input.php' method="post" id="noteform">
<input type="submit" value="Save Note" />
<textarea rows="8" cols="40" name="note" form="noteform"><?php echo $note; ?></textarea>
</form>

</div>

</div>

