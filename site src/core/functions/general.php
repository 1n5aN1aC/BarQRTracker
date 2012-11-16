<?php
function Logged_in_redirect(){
	if(logged_in() === true){
		header('Location: index.php');
		exit();
	}
}

function protect_page(){
	if(logged_in() === false){
		header('Location: protected.php');
		exit();
	}
}

function sanitize($data){
	return htmlentities(strip_tags(mysql_real_escape_string($data)));
}
function array_sanitize(&$item){
	$item= htmlentities(strip_tags(mysql_real_escape_string($item)));
}

function output_errors($errors){
	$output = array();
	foreach($errors as $error){
		$output[] = '<li>'. $error .'</li>';
	}
	return '<ul>' . implode('',$output) . '</ul>';
}
?>