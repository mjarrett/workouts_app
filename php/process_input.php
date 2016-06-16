<?php require 'check_user_cookie.php';

session_start(); //start session to hold get variables to pass back to index on rediret

if(isset($_POST['exercise'])) {
  include 'update.php';
}

if(isset($_POST['cardio'])) {
  include 'update_cardio.php';
}

if(isset($_POST['newExercise'])) {
  include 'addnew.php';
}

if(isset($_POST['newCardio'])) {
  include 'addnew_cardio.php';
}

if(isset($_POST['bodyWeight'])) {
  include 'addweight.php';
}

if(isset($_POST['note'])) {
  include 'add_note.php';
}

header('location: index.php');
?>