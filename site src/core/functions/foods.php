<?php 



function food_data($IDFood){
	$data = array();
	$IDFood= (int)$IDFood;
	$func_num_args = func_num_args();
	$func_get_args = func_get_args();
	if($func_num_args >1){
		unset($func_get_args[0]);
		$fields = '`' . implode('` , `', $func_get_args) .'`';
		$data = mysql_fetch_assoc(mysql_query("SELECT $fields FROM `Food` WHERE `IDFood` = $IDFood"));
		return $data;
	}
}

function add_food($food_data){
	array_walk($food_data, 'array_sanitize');
	
	$fields = '`' . implode('`, `', array_keys($food_data)) . '`';
	$data = '\'' . implode('\',\'', $food_data) . '\'';
	//echo "INSERT INTO `PERSON` ($fields) VALUES ($data)";
	mysql_query("INSERT INTO `Food` ($fields) VALUES ($data)");
	return  mysql_insert_id();
}

function add_foodURL($id,$url){
	mysql_query("UPDATE `Food` SET `PicURL` = '$url' WHERE `IDFood` = $id ");
}

function food_exists($IDFood){
	$username= sanitize($IDFood);
	$query= mysql_query("SELECT COUNT('IDFood') from `Food` where `IDFood` = '$IDFood'");
	return (mysql_result($query, 0)== 1) ? true : false;
}

?>