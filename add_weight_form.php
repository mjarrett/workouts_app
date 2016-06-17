<span id="weightText" onclick="showEl('weightForm');" onmouseover="highlight('weightText')" onmouseout="unhighlight('weightText')"><strong>Or, add your current weight:</strong></span>
<div id="weightForm" style=" display:none;">
<form  action="process_input.php" method="post"> <br / >
   Weight: <select name="bodyWeight"><option></option> <?php for ($x=100; $x<300; $x++) {echo "<option>$x</option>";} ?></select> <br />
   <input type="submit" value="Submit" />
</form>

<?php
echo "<div style=\"display: none\">";
require 'review_weight.php';
echo "</div>";
$points_serialized = urlencode(serialize($points));
$date_serialized = urlencode(serialize($dates));


echo "<img border=\"0\" src=\"make_plot.php?points=" . $points_serialized . "&date=" . $date_serialized . "\">";
?>
</div>
