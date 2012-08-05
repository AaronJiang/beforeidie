<?php
	require_once('public_funs.php');
	
	//用户登录
	function login($user, $pwd){
		$query = "select * from users where Username = '". $user. "' and Password = '". $pwd. "'";
		$result = db_exec($query);
		
		return ($result->num_rows > 0)? true: false;
	}
	
	//用户注册
	function new_user($user, $pwd, $email){
		$query = "insert into users (Username, Password, Email) values ('". $user. "', '". $pwd. "', '". $email. "')";
		$result = db_exec($query);
		
		return $result? true: false;
	}
?>