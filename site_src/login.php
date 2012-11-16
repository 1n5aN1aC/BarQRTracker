<?php
include 'core/init.php';
logged_in_redirect();

if (empty($_POST) === false) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	if(empty($username) === true || empty($password) === true){
		$errors[] = 'you need to enter a username and password';
	}
	else if(user_exists($username) === false) {
		$errors[] = 'username does not exist';
	}
	else {
		$login = login($username, $password);
		if($login===false){
			$errors[] = 'username/ pw combination is incorrect';
		}
		else {
			$_SESSION['user_id'] = $login;
			header("Location: http://web.engr.oregonstate.edu/~rindalp/foodSite/index.php");
			exit();
		} 	
	}
	
	
}
else{
	$errors[] = 'No data received';
}
include 'includes/overall/header.php';
if(empty($errors)===false){
?>
	<h2>We tried to log you in, but...</h2>
<?php
	echo output_errors($errors);
}
include 'includes/overall/footer.php';
?>