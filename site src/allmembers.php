<?php 
include 'core/init.php';
protect_page();
include 'includes/overall/header.php';

echo '<h2>All Members</h2>';
$user_names=mysql_query("SELECT `Login`,`Fname`,`Lname` FROM `PERSON` WHERE `Active` = 1 ");
echo '<ul>';
for($i= 0;$i< user_count();$i++){
	echo'<li><a href="/~rindalp/profile.php?username='.mysql_result($user_names, $i).'">'.mysql_result($user_names, $i,0).'</a> - '. mysql_result($user_names, $i,1).' '. mysql_result($user_names, $i,2).'</li>';
}
echo '</ul>';

include 'includes/overall/footer.php';
 
?>