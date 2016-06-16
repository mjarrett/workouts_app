<?php

date_default_timezone_set('America/Vancouver');

$thisyear=date(Y);
$lastyear=$thisyear-1;
$thismonth=date(F);
$thismonthnum=date(n);
$thisday=date(j);

echo "<select name=year><option value=$lastyear>$lastyear</option><option value='$thisyear' selected='selected'>$thisyear</option></select>";

$montharray = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');

echo "<select name=month>";
for ($x=1; $x<13; $x++) { if ($x == $thismonthnum) {echo "<option value='$x' selected='selected'>" . $montharray[$x-1] . "</option>";} else { echo "<option value='$x'>" . $montharray[$x-1] . "</option>"; }}
echo "</select>";

echo "<select name=day>";
for ($x=1; $x<32; $x++) { if ($x == $thisday) {echo "<option value='$x' selected='selected'>$x</option>";} else { echo "<option value='$x'>$x</option>"; }}
echo "</select>";

?>

