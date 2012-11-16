<?php 
ob_start();
session_start();
ini_set('display_errors', 'On');
require 'database/connect.php';
require 'functions/users.php';
require 'functions/general.php';
require 'functions/foods.php';


if (logged_in() === true){
	$session_user_id= $_SESSION['user_id'];
	$user_data = user_data($session_user_id, 'IDPerson','Login','Password','Fname','Lname', 'Gender','HeightFeet','HieghtInches','Weight','ActivityLevel');
	
}

$errors = array();
?>