<?php
	require_once('public_funs.php');
	
	//验证用户名和密码是否存在
	function check_user_by_name($username, $pwd){
		$query = "select * from users where Username = '". $username. "' and Password = '". sha1($pwd). "'";
		$result = db_exec($query);
		
		return ($result->num_rows > 0)? true: false;
	}
	
	//验证用户ID和密码是否存在
	function check_user_by_id($userID, $pwd){
		$query = "select * from users where UserID = ". $userID. " and Password = '". sha1($pwd). "'";
		$result = db_exec($query);
		
		return ($result->num_rows > 0)? true: false;
	}
	
	//用户注册
	function new_user($username, $pwd, $email){
		$query = "insert into users (Username, Password, Email) values ('". $username. "', '". sha1($pwd). "', '". $email. "')";
		$result = db_exec($query);
		
		return $result? true: false;
	}
	
	//验证用户是否已经登录
	function is_auth(){
		return isset($_SESSION['valid_user']);
	}
	
	//获取用户ID
	function get_userID($username){
		$query = "select UserID from users where Username = '". $username. "'";
		$result = db_exec($query);
		$row = $result->fetch_assoc();
		return $row['UserID'];
	}
	
	//获取用户邮箱
	function get_email($userID){
		$query = "select Email from users where UserID = ". $userID;
		$result = db_exec($query);
		$row = $result->fetch_assoc();
		return $row['Email'];
	}
	
	//修改密码
	function change_pwd($userID, $newPwd){
		$query = "update users set Password = '". sha1($newPwd). "' where UserID = ". $userID;
		$result = db_exec($query);
		return $result? true: false;
	}
?>