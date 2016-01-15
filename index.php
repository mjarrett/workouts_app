<?php require 'check_user_cookie.php'; 
session_start(); 
$updateText = $_SESSION['updateText'];
$_SESSION['updateText'] = '';
?>
<!DOCTYPE html>


<HTML>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Input Exercises</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	 <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	 <link rel="icon" href="favicon.ico" type="image/x-icon">

	<!--<script src="js/vendor/modernizr-2.6.2.min.js"></script>-->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="http://malsup.github.com/jquery.form.js"></script> 
	<script src="../myjs/workouts.js"></script>   

        <link rel="stylesheet" href="css/workouts.css">
	<link rel="stylesheet" href="css/foundation.css">        

    </head>


<?php require 'menu.php'; ?>

<body>




<?php 
echo "<span id=\"topUpdateText\" class=\"updateText\">$updateText</span>";
?>

<br />

<h2>Strength</h2>
<br />


<?php require 'strength_input_table.php'; ?>

<br /> 
<br />


<h2>Cardio</h2> 
<br />

<?php require 'cardio_input_table.php'; ?>


<br />
<br />


<?php require 'add_weight_form.php'; ?>


<br />
<br />


<?php require 'note_input.php'; ?>

</body>
</HTML>



