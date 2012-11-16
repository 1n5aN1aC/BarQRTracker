<?php 

function update_user($update_data){
	$update= array();
	array_walk($update_data, 'array_sanitize');
	
	foreach($update_data as $field =>$data){
		$update[] = '`' . $field . '` = \'' . $data . '\'';
	}
	//print_r($update);
	//echo "UPDATE `PERSON` SET " . implode(', ', $update) . " WHERE `idPERSON` = " . $_SESSION['user_id'];;
	
	mysql_query("UPDATE `PERSON` SET " . implode(', ', $update) . " WHERE `idPERSON` =" . $_SESSION['user_id']);
}


function change_password($user_id, $password){
	$user_id=(int)$user_id;
	$password = md5($password);
	
	mysql_query("UPDATE `PERSON` SET `Password` = '$password' WHERE `idPERSON` = $user_id ");
}
function register_user($register_data){
	array_walk($register_data, 'array_sanitize');
	$register_data['Password']=md5($register_data['Password']);
	
	$fields = '`' . implode('`, `', array_keys($register_data)) . '`';
	$data = '\'' . implode('\',\'', $register_data) . '\'';
	//echo "INSERT INTO `PERSON` ($fields) VALUES ($data)";
	mysql_query("INSERT INTO `PERSON` ($fields) VALUES ($data)");
}

function user_count(){
	return mysql_result(mysql_query("SELECT COUNT(`idPERSON`) FROM `PERSON` WHERE `Active` = 1 "),0);
}

function user_data($user_id){
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


function user_active($username){
	$username= sanitize($username);
	return (mysql_result(mysql_query("SELECT COUNT(`idPERSON`) FROM `PERSON` WHERE `Login` = '$username' AND `Active` = 1 "),0) == 1) ? true : false;	
}

function logged_in() {
	return (isset($_SESSION['user_id'])) ? true : false;
}

function email_exists($email){
	$email= sanitize($email);
	$query= mysql_query("SELECT COUNT('idPERSON') from `PERSON` where `Email` = '$email'");
	return (mysql_result($query, 0)== 1) ? true : false;
}

function user_exists($username){
	$username= sanitize($username);
	$query= mysql_query("SELECT COUNT('idPERSON') from `PERSON` where `Login` = '$username'");
	return (mysql_result($query, 0)== 1) ? true : false;
}

function user_id_from_username($username){
	$username = sanitize($username);
	return mysql_result(mysql_query("SELECT `idPERSON` from `PERSON` where `Login` = '$username'"), 0, 'idPERSON');
} 
function username_from_user_id($userid){
	$userid = sanitize($userid);
	return mysql_result(mysql_query("SELECT `Login` from `PERSON` where `idPERSON` = $userid"), 0);
} 

function login($username, $password){
	$user_id = user_id_from_username($username);
	$username = sanitize($username);
	$password = md5($password);
	return (mysql_result(mysql_query("SELECT  COUNT(`idPERSON`) FROM `PERSON` WHERE `Login`='$username' AND `Password`= '$password'"), 0) == 1) ? $user_id : false; 
} 
?>