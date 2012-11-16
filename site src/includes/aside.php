<aside>
	<?php
		if(logged_in()===true){
			include 'includes/widgets/notifications.php';
			include 'includes/widgets/loggedin.php';
			include 'includes/widgets/groupcontrols.php';
			include 'includes/widgets/eventcontrols.php';
		}else{
			include 'includes/widgets/login.php';
		}
		
		include 'includes/widgets/user_count.php';
	?>
</aside>