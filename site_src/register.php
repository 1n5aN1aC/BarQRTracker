<?php 
include 'core/init.php';
logged_in_redirect();
include 'includes/overall/header.php';

if(empty($_POST)=== false){
	$required_fields = array('username','password','password_again','firstname','email');
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
		if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)=== false){
			$errors[] = 'A valid email address is required';
		}
		if(email_exists($_POST['email']) === true ){
			$errors[] = 'sorry, the email \'' . $_POST['email'] . '\' is already in use';
		}
		//print_r($errors);	
	}
}
?>
<h2>Register</h2>
<?php
if(isset($_GET['success']) && empty($_GET['success'])){
	echo 'you have been registered successfully!';
}
else{
	if(empty($_POST) === false && empty($errors) === true){
		$register_data= array(
			'Login' => $_POST['username'],
			'Password' => $_POST['password'],
			'Fname' => $_POST['Fname'],
			'Lname' => $_POST['Lname'],
			'email' => $_POST['email'],
		);

		register_user($register_data);
		header('Location: register.php?success');
		exit();
	}
	else if (empty($errors)=== false){
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
				Email*:<br>
				<input type="text" name="email">
			</li>
			<li>
				<input type="submit" value="Register">
			</li>
		</ul>
	</form>
<?php
}
 include 'includes/overall/footer.php';?>