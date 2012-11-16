<?php
$pending_count=mysql_result(mysql_query("SELECT COUNT(Login) FROM `PERSON`,`FRIENDS` WHERE `Pending_on` = ".$user_data['idPERSON']." AND `idFRIEND1`= ".$user_data['idPERSON']." and `idFRIEND2`=`idPERSON`"),0);
$attending_count=mysql_result(mysql_query("SELECT COUNT(`idPERSON`) FROM `ATTENDING` WHERE `idPERSON` = ".$user_data['idPERSON']." and Yes_no_maybe=3"),0); 
$new_group_count=mysql_result(mysql_query("SELECT COUNT(`idPERSON`) FROM `MEMBER` WHERE `idPERSON` = ".$user_data['idPERSON']." and `New_mem`=1 and `Member_request`=0"),0); 
$notifi=mysql_query("SELECT `idPERSON`,`idPOST`,`Comment`,`idCOMMENT`,`idNOTIF` FROM `Notification` WHERE `viewed`=0 and `idPERSON` = ".$user_data['idPERSON']);
$notifi_count=mysql_num_rows($notifi); 
$mem_request=mysql_query("SELECT `idGROUP`,`Name`,`idPERSON` FROM `MEMBER` NATURAL JOIN `GROUP` WHERE `Made_by`=".$user_data['idPERSON']." AND `Member_request`=1");
$mem_request_count=mysql_num_rows($mem_request);
$count =$pending_count+ $attending_count+$new_group_count+$notifi_count+$mem_request_count;
if($count>0){
?>
<div class="widget">
	<h2>Notifications(<?php echo $count; ?>)</h2>
	<div class="inner">
		<ul>
		<?php
		if($pending_count>0){
			echo '<li><a href="myfriends.php">friend requests('.$pending_count.')</a></li>';
		}
		if($attending_count>0){
			echo '<li><a href="attend.php?idPERSON='.$user_data['idPERSON'].'">Event invitations('.$attending_count.')</a></li>';
		}
		if($new_group_count>0){
			echo '<li><a href="mygroups.php?idPERSON='.$user_data['idPERSON'].'">Member of a new group('.$new_group_count.')</a></li>';
		}
		for ($i=0;$i<$mem_request_count;$i++){
			echo '<li><a href="group.php?idGROUP='.mysql_result($mem_request,$i,0).'&manage"><b>'.username_from_user_id(mysql_result($mem_request,$i,2)).'</b> wants to join '.mysql_result($mem_request,$i,1).'</a></li>';
		
		}
		for ($i=$notifi_count-1;$i>=0;$i--){
		
			if(mysql_result($notifi,$i,1)!=NULL){
				$result=mysql_query("SELECT `On_idPERSON` , `On_idGROUP` , `On_idEVENT` FROM `POST` NATURAL JOIN `Notification` WHERE `idNOTIF` = ".mysql_result($notifi,$i,4));
				if(mysql_result($result,0,0)!=NULL){
					echo '<li><a href="profile.php?username='.username_from_user_id(mysql_result($result,0,0)).'">'.mysql_result($notifi,$i,2).'</a></li>';
		
				}else if(mysql_result($result,0,1)!=NULL){
					echo '<li><a href="group.php?idGROUP='.mysql_result($result,0,1).'">'.mysql_result($notifi,$i,2).'</a></li>';
		
				}else if(mysql_result($result,0,2)!=NULL){
					echo '<li><a href="event.php?idEVENT='.mysql_result($result,0,2).'">'.mysql_result($notifi,$i,2).'</a></li>';
		
				}
				
			}else if(mysql_result($notifi,$i,3)!=NULL){
				$result_com=mysql_query("SELECT `On_idPERSON` , `On_idGROUP` , `On_idEVENT` FROM `POST` as p ,`Notification` as n , `COMMENTS` as c WHERE c.idPOST=p.idPOST and n.idCOMMENT=c.idCOMMENT and n.idNOTIF = ".mysql_result($notifi,$i,4));
				
				if(mysql_result($result_com,0,0)!=NULL){
					echo '<li><a href="profile.php?username='.username_from_user_id(mysql_result($result_com,0,0)).'">'.mysql_result($notifi,$i,2).'</a></li>';
		
				}else if(mysql_result($result_com,0,1)!=NULL){
					echo '<li><a href="group.php?idGROUP='.mysql_result($result_com,0,1).'">'.mysql_result($notifi,$i,2).'</a></li>';
		
				}else if(mysql_result($result_com,0,2)!=NULL){
					echo '<li><a href="event.php?idEVENT='.mysql_result($result_com,0,2).'">'.mysql_result($notifi,$i,2).'</a></li>';
		
				}
			}
		}
		?>
		</ul>
	</div>
</div>	

<?php
}
?>