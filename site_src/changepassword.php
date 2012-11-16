<?php 
include 'core/init.php';
protect_page();

if(empty($_POST) === false){
	$required_fields = array('current_passwor','password','password_again');
	foreach($_POST as $key=>$value){
		if(empty($value)&& in_array($key, $required_fields) === true){
			$errors[] = 'fields marked with an * are required';
			break 1;
		}
	}
	
	if($user_data['Password'] === md5($_POST['current_password'])){
		if(trim($_POST['password']) !== trim($_POST['password_again'])){
			$errors[]='your new passwords do not match';
		}
		if (strlen($_POST['password'])<6){
			$errors[]='your new passwords has to be at least 6 characters';
		}
	}
	else{
		$errors[] ='you \'current password\' is incorrect';
	}
	//print_r($errors);
}
include 'includes/overall/header.php';
?>
<h1>Change password</h1>
<?php
if(isset($_GET['success']) && empty($_GET['success'])){
	echo 'you have been registered successfully!<br>';
}
else {
	if(empty($_POST) === false && empty($errors) === true){
		change_password($session_user_id, $_POST['password']);	
		header('Location: changepassword.php?success');
	}
	else if (empty($errors)=== false){
		echo output_errors($errors);
	}
	?>
<form action="" method="post">
	<ul>
		<li>
			Current password*:<br>
			<input type="password" name ="current_password">
		</li>
		<li>
			New password*:<br>
			<input type="password" name ="password">
		</li>
		<li>
			new password again*:<br>
			<input type="password" name ="password_again">
		</li>
		<li>
			<input type="submit" value ="change password">
		</li>
	</ul>
<?php 
}
include 'includes/overall/footer.php';?>