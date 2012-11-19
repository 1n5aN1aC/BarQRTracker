<?php 
require 'core/init.php';
protect_page();
include 'includes/overall/header.php';

if(empty($_POST)=== false){
	$required_fields = array('Fname','email');
	foreach($_POST as $key=>$value){
		if(empty($value)&& in_array($key, $required_fields) === true){
			$errors[] = 'fields marked with an * are required';
			break 1;
		}
	}
	//^^^^checks for required fields
	
	if(empty($errors)=== true){
		if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)=== false){
			$errors[] = 'A valid email address is required';
		}
		if(email_exists($_POST['email']) === true && $user_data['Email'] !== $_POST['email']){
			$errors[] = 'sorry, the email \'' . $_POST['email'] . '\' is already in use';
		}
		if(empty($_POST['activityLevel']) === false&&$_POST['activityLevel']>=10&&$_POST['activityLevel']<=1){
			$errors[] = 'Activity level must be in the range 1-10';
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
		
		
		
		
		
	}
	
}
	//print_r($errors);
?>
<h1>Settings</h2>

<?php 
if(isset($_GET['success']) && empty($_GET['success'])){
	echo 'your settings have been updated successfully!';
}else{
	if(empty($_POST) === false && empty($errors) === true){
		$update_data = array(
			'Fname' => $_POST['Fname'],
			'Lname' => $_POST['Lname'],
			'Gender' => $_POST['sex'],
			'HeightFeet' => $_POST['feet'],
			'HeightInches' => $_POST['inches'],
			'Weight' => $_POST['weight'],
			'ActivityLevel' => ($_POST['activityLevel'])
		);
		
		update_user($update_data);
		header('Location: settings.php?success');
		exit();
		
	}else if (empty($errors)=== false){
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
				Last name:<br>
				<input type="text" name ="Lname" value="<?php echo $user_data['Lname']; ?>">
			</li>
			
			<li>
				Gender:<br>
				<input type="radio" name="sex" value="M" <?php if ($user_data['Gender']=='M'){echo 'checked';} ?>> Male<br />
				<input type="radio" name="sex" value="F" <?php if ($user_data['Gender']=='F'){echo 'checked';} ?>> Female
			</li>
			<li>
				Height:<br>
				<input type="text" name="feet" maxlength="1" value="<?php echo $user_data['HeightFeet']; ?>" style="width:20px;"/>Feet<br>
				<input type="text" name="inches" maxlength="2" value="<?php echo $user_data['HeightInches']; ?>" style="width:20px;"/>Inches
			</li>
			<li>
				Weight:<br>
				<input type="text" name="weight" maxlength="3"  value="<?php echo $user_data['Weight']; ?>" style="width:30px;"/>Lbs
			</li>
			<li>
				Activity Level (1-10):<br>
				<input type="text" name="activityLevel" maxlength="2"  value="<?php echo $user_data['ActivityLevel']; ?>" style="width:30px;"/>(1 for no exercise, 10 for 8 hours a day of exercise)
			</li>
			<li>
				<input type="submit" value ="update">
			</li>
	<?php
}
include 'includes/overall/footer.php';
?>