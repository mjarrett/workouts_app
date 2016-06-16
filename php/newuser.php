<!DOCTYPE html>


<HTML>


<head>
<title>Login</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

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






<BODY>
  <h2>New user</h2>
  <form name="login" method="post" action="php/adduser.php">
   <table>
   <tr><td>Username: </td><td><input type="text" name="username"></td></tr>
   <tr><td>First Name: </td><td><input type="text" name="firstname"></td></tr>
   <tr><td>Last Name: </td><td><input type="text" name="lastname"></td></tr>
   <tr><td>Password: </td><td><input type="password" name="password"></td></tr>
   </table>
  
  <input class="button" type="submit" value="Add User">
  </form>


</BODY>
</HTML>
     
