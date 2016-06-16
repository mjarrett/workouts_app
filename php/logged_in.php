<?php
     
     //GRAB USER AND PASSWORD FROM FORM
     //$user=$_POST['username'];
     //$password=$_POST['password'];
     $user='msj';
     $password='nitro666';
     require 'connect_weights_db.php'; // Connect to project DB

     //RETRIEVE HASHED PASSWORD FOR $USER
     $results = mysql_fetch_assoc(mysql_query("SELECT password, firstname, super FROM users WHERE username='$user' LIMIT 1"));
     $hashedPassword = $results['password'];
     $firstname = $results['firstname'];
     $super = $results['super'];

     //RETRIEVE SALT FROM BEGINNING OF HASHED PASSWORD
     $salt = substr($hashedPassword,0,64);

     //HASH INPUT PASSWORD WITH SALT
     $hash = $salt . $password;
     $hash = $salt . hash('sha256',$hash);
            
     //CHECK THAT A USERNAME AND A PASSWORD WERE INPUTED
     if(isset($_POST['username']) && isset($_POST['password'])) {
     
     //CHECK THAT THE PASSWORD IS VALID FOR THE USERNAME
     if( $hashedPassword == $hash) {
     
     //SET COOKIE TO EXPIRE IN 1 YEAR
     setcookie('username', $_POST['username'], time()+60*60*24*365);
     setcookie('password', $hashedPassword, time()+60*60*24*365);
     
     //Send user to their home page
     header('Location: ../index.php');
     
     }
       
     // IF USERNAME/PASSWORD DON'T MATCH
     else {     
     echo 'Username/password invalid. Please <a href="login.html">try again</a>.<br>';
     }
     }

     // IF USERNAME/PASSWORD AREN'T INPUTED
     else {
     echo 'You must enter a username and password. Please <a href="login.html">try again</a>.';
     }
     
?>   


