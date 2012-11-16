<?php 
include 'core/init.php';
protect_page();
include 'includes/overall/header.php';

if (isset($_GET['username']) === true && empty($_GET['username']) === false){
	$username = $_GET['username'];
	if(user_exists($username)){
	
		$user_id = user_id_from_username($username);
		$profile_data= user_data($user_id, 'Fname', 'Lname','Email','idPERSON','Login','About_you','Sex','DOB','Location','About_you','Job');
		$friends = mysql_result(mysql_query("SELECT COUNT(idFRIEND1) FROM `FRIENDS` WHERE `Pending_on` = 0 AND `idFRIEND1`= ".$user_data['idPERSON']." and `idFRIEND2`=".$profile_data['idPERSON']),0);
		$pending_to=mysql_result(mysql_query("SELECT COUNT(idFRIEND1) FROM `FRIENDS` WHERE `Pending_on` = ".$profile_data['idPERSON']." AND `idFRIEND2`= ".$user_data['idPERSON']." and `idFRIEND1`=".$profile_data['idPERSON']),0);
		$pending_from=mysql_result(mysql_query("SELECT COUNT(idFRIEND1) FROM `FRIENDS` WHERE `Pending_on` = ".$user_data['idPERSON']." AND `idFRIEND1`= ".$user_data['idPERSON']." and `idFRIEND2`=".$profile_data['idPERSON']),0);

		?>	
		<h1><?php echo $profile_data['Fname'];?>'s profile</h1>
		<?php
		if($friends==0 &&$pending_to==0 && $pending_from==0 && $user_data['idPERSON']!= $profile_data['idPERSON']){
			if(isset($_GET['addfriend']) === true && empty($_GET['addfriend']) === true){
				friend_request($profile_data['idPERSON'],$user_data['idPERSON']);
				header('Location:profile.php?username='.$profile_data['Login']); 
				exit();
			}
			echo '<a href="profile.php?username='.$profile_data['Login'].'&addfriend">add as friend<br><br></a>';
		}
		else if ($pending_from ==0 && $pending_to==1 && $user_data['idPERSON']!= $profile_data['idPERSON']){
			echo 'Friend request pending...<br><br>';
		}
		else if ($pending_from ==1 && $pending_to==0 && $user_data['idPERSON']!= $profile_data['idPERSON']){
			if(isset($_GET['denyfriend']) === true && empty($_GET['denyfriend']) === true){
				friend_request_denied($user_data['idPERSON'],$profile_data['idPERSON']);
				header('Location:profile.php?username='.$profile_data['Login']); 
				exit();
			}else if(isset($_GET['acceptfriend']) === true && empty($_GET['acceptfriend']) === true){
				friend_request_accepted($user_data['idPERSON'],$profile_data['idPERSON']);
				header('Location:profile.php?username='.$profile_data['Login']);
				exit();				
			}
			echo '<a href="profile.php?username='.$profile_data['Login'].'&acceptfriend">accept friend request</a><br>';
			echo '<a href="profile.php?username='.$profile_data['Login'].'&denyfriend">deny friend request<br><br></a>';
		}
		 
		?>
		<p>Name: <?php echo $profile_data['Fname'].' '.$profile_data['Lname'].'<br>      Email: '.$profile_data['Email'].'<br>      Sex: '.$profile_data['Sex'].'<br>    Date of Birth: '. $profile_data['DOB'].'<br>    Location: '.  $profile_data['Location'].'<br>    Job: '.  $profile_data['Job'].'<br>About me: '.$profile_data['About_you'];?>    
		<?php if($user_data['Login']===$profile_data['Login']){
			echo '<br><br><a href="settings.php">Edit</a>';
		}?>
		<p>
		<?php	
	}
	else{
		echo'sorry that user doesnt exists';
	}
}
else{
	header('Location: index.php');
	exit();
}

include 'includes/profileposts.php';

include 'includes/overall/footer.php';
?>