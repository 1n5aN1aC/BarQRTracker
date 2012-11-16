<?php 
require 'core/init.php';
protect_page();
include 'includes/overall/header.php';

if(empty($_POST)=== false){
	//checks for required fields
	$required_fields = array('Fname','email');
	foreach($_POST as $key=>$value){
		if(empty($value)&& in_array($key, $required_fields) === true){
			$errors[] = 'fields marked with an * are required';
			break 1;
		}
	}
	
	if(empty($errors)=== true){
		if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)=== false){
			$errors[] = 'A valid email address is required';
		}
		if(email_exists($_POST['email']) === true && $user_data['Email'] !== $_POST['email']){
			$errors[] = 'sorry, the email \'' . $_POST['email'] . '\' is already in use';
		}
		
		/* if(user_exists($_POST['username']) === true ){
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
		 */
	}
	
}
	//print_r($errors);
?>
<h1>Settings</h2>

<?php 
if(isset($_GET['success']) && empty($_GET['success'])){
	echo 'your settings have been updated successfully!';
}
else{
	if(empty($_POST) === false && empty($errors) === true){
		$update_data = array(
			'Fname' => $_POST['Fname'],
			'Lname' => $_POST['Lname'],
			'Email' => $_POST['email'],
			'Job' => $_POST['job'],
			'DOB' => $_POST['dob'],
			'Location' => $_POST['location'],
			'About_you' => $_POST['about_you'],
			'College' => $_POST['college'],
			'High_school' => $_POST['high_school'],
			'Sex' => $_POST['sex'],
		);
		
		update_user($update_data);
		header('Location: settings.php?success');
		exit();
		
	}
	else if (empty($errors)=== false){
		echo output_errors($errors);
	}
	?>
	<form action="" method="post">
		<ul>
			<li>
				First name*:<br>
				<input type="text" name ="Fname" value="<?php echo $user_data['Fname']; ?>">
			</li>
			<li>
				Lasr name:<br>
				<input type="text" name ="Lname" value="<?php echo $user_data['Lname']; ?>">
			</li>
			<li>
				Email*:<br>
				<input type="text" name ="email" value="<?php echo $user_data['Email']; ?>">
			</li>
			<li>
				Job:<br>
				<input type="text" name ="job" value="<?php echo $user_data['Job']; ?>">
			</li>
			<li>
				Sex:<br>
			<input type="radio" name="sex" value="M" <?php if ($user_data['Sex']=='M'){echo 'checked';} ?>> Male<br />
			<input type="radio" name="sex" value="F" <?php if ($user_data['Sex']=='F'){echo 'checked';} ?>> Female
			</li>
			<li>
				Date of Birth:<br>
				<input type="text" name ="dob" value="<?php echo $user_data['DOB']; ?>"> Formatting (YYYY-MM-DD)
			</li>
			<li>
				High school:<br>
				<input type="text" name ="high_school" value="<?php echo $user_data['High_school']; ?>">
			</li>
			<li>
				Location:<br>
				<input type="text" name ="location" value="<?php echo $user_data['Location']; ?>">
			</li>
			<li>
				College:<br>
				<input type="text" name ="college" value="<?php echo $user_data['College']; ?>">
			</li>
			<li>
				About you:<br>
				<textarea name="about_you" COLS=40 ROWS=2><?php echo $user_data['About_you']; ?></TEXTAREA>
			</li>
			<li>
				<input type="submit" value ="update">
			</li>
	<?php
}
include 'includes/overall/footer.php';
?>