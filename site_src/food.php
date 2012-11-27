<?php 
include 'core/init.php';
include 'includes/overall/header.php';
?>
<h1>Food Look Up</h1>

<?php
if(empty($_POST)=== false&&empty($_GET)===true){
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

if(empty($_POST) === false && empty($errors) === true){
	$food_data= array(
		'IDFood' => $_POST['IDFood']	
	);
	header('Location: Food.php?IDFood='.$food_data['IDFood']);
	exit();
	
}
else if (empty($errors)=== false){
	echo output_errors($errors);
}
if(food_exists($_GET['IDFood']) && isset($_GET['add']) ){
	addFood($_GET['IDFood'],$user_data['IDPerson']);
	header('Location: food.php?IDFood='.$_GET['IDFood'].'&added');
	exit();
}
if(empty($_GET['IDFood'])===false && food_exists($_GET['IDFood'])){
	$food_data=food_data($_GET['IDFood'],'IDPerson','Name','Description','PicURL','Calories','totalFat',
			'saturatedFat',
			'transFat',
			'cholesterol',
			'sodium',
			'totalCarbohydrates',
			'protien',
			'vA',
			'vC',
			'calcium',
			'iron',
			'dietaryFiber',
			'sugars');
	echo '<br><h2>'.$food_data['Name'].'</h2>';
	if(isset($_GET['added'])){
		echo 'Food added<br><br>';
	}else{
		echo '<a href="/~rindalp/foodSite/food.php?IDFood=41&add">Add food to my diet</a><br><br> ';
	}
	?><img src="upload/<?php echo $_GET['IDFood']?>"  width="300"> <?php
	echo '<br>Description:  '.$food_data['Description'].'<br>';
	echo 'Calories:  '.$food_data['Calories'].'<br>';
<<<<<<< HEAD:site_src/food.php
}
else{
=======
	echo 'total Fat:  '.$food_data['totalFat'].'<br>';
	echo '	saturated Fat:  '.$food_data['saturatedFat'].'<br>';
	echo '	trans Fat:  '.$food_data['transFat'].'<br>';
	echo 'cholesterol:  '.$food_data['cholesterol'].'<br>';
	echo 'sodium:  '.$food_data['sodium'].'<br>';
	echo 'Total Carbohydrates:  '.$food_data['totalCarbohydrates'].'<br>';
	echo '	dietary Fiber:  '.$food_data['dietaryFiber'].'<br>';
	echo '	Suger:  '.$food_data['sugars'].'<br>';
	echo 'protien:  '.$food_data['protien'].'<br>';
	echo 'vitamin A:  '.$food_data['vA'].'<br>';
	echo 'vitamin C:  '.$food_data['vC'].'<br>';
	echo 'calcium:  '.$food_data['calcium'].'<br>';
	echo 'iron:  '.$food_data['iron'].'<br>';
}else{
>>>>>>> add food ro person:site src/food.php

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
}
if(logged_in()){
	//do something
}
include 'includes/overall/footer.php';
?>
