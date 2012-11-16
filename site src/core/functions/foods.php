<?php 



function food_data($user_id){
	$data = array();
	$user_id= (int)$user_id;
	$func_num_args = func_num_args();
	$func_get_args = func_get_args();
	if($func_num_args >1){
		unset($func_get_args[0]);
		$fields = '`' . implode('` , `', $func_get_args) .'`';
		$data = mysql_fetch_assoc(mysql_query("SELECT $fields FROM `PERSON` WHERE `idPERSON` = $user_id"));
		return $data;
	}
}


function food_exists($IDFood){
	$username= sanitize($IDFood);
	$query= mysql_query("SELECT COUNT('IDFood') from `Food` where `IDFood` = '$IDFood'");
	return (mysql_result($query, 0)== 1) ? true : false;
}

?>