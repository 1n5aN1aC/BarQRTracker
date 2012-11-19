<?php 
include 'core/init.php';
include 'includes/overall/header.php';
?>
<h1>Home</h1>

<?php
if(empty($_POST)=== false){
	$required_fields = array('IDFood');
	foreach($_POST as $key=>$value){
		if(empty($value)&& in_array($key, $required_fields) === true){
			$errors[] = 'fields marked with an * are required';
			break 1;
		}
	}
	if(empty($errors)=== true){
		if(food_exists($_POST['IDFood']) === false ){
			$errors[] = 'sorry, the food ID \'' . $_POST['IDFood'] . '\' does not exist';
		}
		//print_r($errors);	
	}
}
?>
<h2>Food Look Up</h2>
<?php
if(empty($_POST) === false && empty($errors) === true){
	$food_data= array(
		'IDFood' => $_POST['IDFood']	
	);
	header('Location: food.php?IDFood='.$food_data['IDFood']);
	exit();
}
else if (empty($errors)=== false){
	echo output_errors($errors);
}
?>

<form action="" method="post">
	<ul>
		<li>
			Food ID*:<br>
			<input type="text" name="IDFood">
		</li>
		<li>
			<input type="submit" value="Submit">
		</li>
	</ul>
</form>

<?php
if(logged_in()){
	
}
include 'includes/overall/footer.php';?>