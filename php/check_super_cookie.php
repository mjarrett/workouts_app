<?php
     
     
     require 'check_user_cookie.php'; // First run normal check user script

     // then check if user is an admin

     if ($super != 1) {
     
     //Send normal users back home
     header('Location: index.php');
     }

     
?>   


