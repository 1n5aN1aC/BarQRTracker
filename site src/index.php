<?php 
include 'core/init.php';
include 'includes/overall/header.php';
?>
<h1>Home</h1>
<p> hello.</p>
<?php
if(logged_in()){
	echo '<h3>WELCOME</h3>';
}
include 'includes/overall/footer.php';?>