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
	
	//验证用户是否登录
	function check_valid_user(){
		return isset($_SESSION['valid_user']);
	}
	
	//获取用户ID
	function get_userID($username){
		$query = "select UserID from users where Username = '". $username. "'";
		$result = db_exec($query);
		$row = $result->fetch_assoc();
		return $row['UserID'];
	}
?>