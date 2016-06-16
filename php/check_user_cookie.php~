<?php

	

	$currentUser = $_COOKIE['username'];
	$currentUserPassword = $_COOKIE['password'];

	

        require 'connect_weights_db.php'; // Connect to project DB

	//RETRIEVE HASHED PASSWORD FOR $USER
	$results = mysql_fetch_assoc(mysql_query("SELECT password, super FROM users WHERE username='$currentUser' LIMIT 1"));
	$hashedPassword = $results['password'];
	$super = $results['super'];

	
	if($currentUserPassword == $hashedPassword && $currentUser != '' && $currentUserPassword != '') {
	$loggedIn = 1;
	
	}
	else {
	$loggedIn = 0;
	header('Location: login.html');
	}
	
?>
