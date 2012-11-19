<?php 
include 'core/init.php';
logged_in_redirect();
include 'includes/overall/header.php';


if(empty($_POST)=== false){
	$required_fields = array('username','password','password_again','firstname');
	foreach($_POST as $key=>$value){
		if(empty($value)&& in_array($key, $required_fields) === true){
			$errors[] = 'fields marked with an * are required';
			break 1;
		}
	}
	
	if(empty($errors)=== true){
		if(user_exists($_POST['username']) === true ){
			$errors[] = 'sorry, the username \'' . $_POST['username'] . '\' is already taken';
		}
		if(preg_match("/\\s/", $_POST['username']) == true){
			$errors[] = 'your username must not contain any spaces';
		}
		if (strlen($_POST['password'])<6){
			$errors[] = 'your password must be atleast 6 characters';
		}
		if($_POST['password'] !== $_POST['password_again']){
			$errors[] = 'your password must match';
		}
		if(empty($_POST['activityLevel']) === false&&$_POST['activityLevel']>=10&&$_POST['activityLevel']<=1){
			$errors[] = 'Activity level bust be in the range 1-10';
		}
		if(empty($_POST['weight']) === false&&$_POST['weight']<=0&&$_POST['activityLevel']>=999){
			$errors[] = 'Weight must be in the range 1-999';
		}
		if(empty($_POST['foot']) === false&&$_POST['foot']<=0){
			$errors[] = 'Height in feet must be in the range 1-9';
		}
		if(empty($_POST['inches']) === false&&$_POST['inches']<0&&$_POST['inches']>12){
			$errors[] = 'Height in feet must be in the range 0-12';
		}
		
		//print_r($errors);	
	}
}
?>
<h2>Register</h2>
<?php
if(isset($_GET['success']) && empty($_GET['success'])){
	echo 'you have been registered successfully!';
}else{
	if(empty($_POST) === false && empty($errors) === true){
		$register_data= array(
			'Login' => $_POST['username'],
			'Password' => $_POST['password'],
			'Fname' => $_POST['Fname'],
			'Lname' => $_POST['Lname'],
			'Gender' => $_POST['sex'],
			'HeightFeet' => $_POST['feet'],
			'HeightInches' => $_POST['inches'],
			'Weight' => $_POST['weight'],
			'ActivityLevel' => ($_POST['activityLevel']-1)
		);

		register_user($register_data);
		header('Location: register.php?success');
		exit();
		
	}else if (empty($errors)=== false){
		echo output_errors($errors);
	}

	?>

	<form action="" method="post">
		<ul>
			<li>
				Username*:<br>
				<input type="text" name="username">
			</li>
			<li>
				Password*:<br>
				<input type="text" name="password">
			</li>
			<li>
				Password again*:<br>
				<input type="text" name="password_again">
			</li>
			<li>
				First name*:<br>
				<input type="text" name="Fname">
			</li>
			<li>
				Last name:<br>
				<input type="text" name="Lname">
			</li>
			<li>
				Gender:<br>
				<input type="radio" name="sex" value="M" > Male<br />
				<input type="radio" name="sex" value="F" > Female
			</li>
			<li>
				Height:<br>
				<input type="text" name="feet" maxlength="1" style="width:20px;"/>Feet<br>
				<input type="text" name="inches" maxlength="2"style="width:20px;"/>Inches
			</li>
			<li>
				Weight:<br>
				<input type="text" name="weight" maxlength="3" style="width:30px;"/>Lbs
			</li>
			<li>
				Activity Level (1-10):<br>
				<input type="text" name="activityLevel" maxlength="2" style="width:30px;"/>(1 for no exercise, 10 for 8 hours a day of exercise)
			</li>
			<li> 
				<input type="submit" value="Register">
			</li>
		</ul>
	</form>
	<?php
}
 include 'includes/overall/footer.php';?>