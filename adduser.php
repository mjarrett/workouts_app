<?php
     
//Hash password
$username = $_POST['username'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$salt = hash('sha256',uniqid(mt_rand(),true) . 'ldgjroear' . strtolower($_POST['username']));
$hash = $salt . $_POST['password'];

//Make hashed password by hashing $hash and appending $salt to the front
$hashedPassword = $salt . hash('sha256',$hash);

require 'connect_weights_db.php'; // Connect to project DB

//Check that username doesn't already exist
$check_name = mysql_query("SELECT username FROM users WHERE username = '$username'");

//if there is already a username, send them back to the add user page
while($row = mysql_fetch_array($check_name)) {
  if($row['username'] == $username) {
    header('location: newuser.php');
  }
}

//Otherwise, add user to DB

$submit = mysql_query("INSERT INTO users VALUES((SELECT max+1 AS new_id FROM (SELECT MAX(user_id) AS max FROM users)t),'$username','$hashedPassword','$firstname','$lastname','')");

//if the new user submit was a success, set cookies
if($submit) {
  setcookie('username', $_POST['username'], time()+60*60*24*365);
  setcookie('password', $hashedPassword, time()+60*60*24*365); 
}
else{
  header('location: login.html');
}//Close else

?>

<HTML>
<title>
New User
</title>


<body>
     <?php require('header.php'); ?>
     <?php require('bottom_menu.php'); ?>
</body>
</HTML>
