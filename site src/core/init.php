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
	$user_data = user_data($session_user_id, 'idPERSON','Login','Password','Fname','Lname', 'Sex', 'Job', 'About_you','DOB','Location','Email','College','High_school');
	if(user_active($user_data['Login']) === false){
		session_destroy();
		header('Location : index.php');
		exit();
		
	}
}

$errors = array();
?>