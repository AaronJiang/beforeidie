<?php
	require_once('public_funs.php');

	//验证用户 by 邮箱和密码
	function check_user_by_email($email, $pwd){
		$query = "select * from users where Email = '". $email. "' and Password = '". sha1($pwd). "' and IsActive = 1";
		$result = db_exec($query);

		return ($result->num_rows > 0)? true: false;
	}
	
	//验证未激活用户 by 邮箱和密码
	function check_unactive_user_by_email($email, $pwd){
		$query = "select * from users where Email = '". $email. "' and Password = '". sha1($pwd). "' and IsActive = 0";
		$result = db_exec($query);
		
		return ($result->num_rows > 0)? true: false;		
	}
	
	//验证用户ID和密码是否存在
	function check_user_by_id($userID, $pwd){
		$userState = "";
	
		$query = "select * from users where UserID = ". $userID. " and Password = '". sha1($pwd). "' and IsActive = 1";
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
	
	//获取用户ID by name
	function get_userID($username){
		$query = "select UserID from users where Username = '". $username. "'";
		$result = db_exec($query);
		$row = $result->fetch_assoc();
		return $row['UserID'];
	}
	
	//获取用户名 by ID
	function get_username_by_id($userID){
		$query = "select Username from users where UserId = ". $userID;
		$result = db_exec($query);
		$row = $result->fetch_assoc();
		return $row['Username'];
	}
	
	//获取用户名 by Email
	function get_username_by_email($email){
		$query = "select Username from users where Email = '". $email ."'";
		$result = db_exec($query);
		$row = $result->fetch_assoc();
		return $row['Username'];	
	}

	//获取用户名ID by Email
	function get_userid_by_email($email){
		$query = "select UserID from users where Email = '". $email. "'";
		$result = db_exec($query);
		$row = $result->fetch_assoc();
		return $row['UserID'];	
	}
	
	//获取用户邮箱 by ID
	function get_email_by_id($userID){
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
	
	//获取用户总数
	function get_all_users_num(){
		$query = "select count(*) as users_num from users";
		$result = db_exec($query);
		$row = $result->fetch_assoc();
		
		return $row['users_num'];
	}
	
	//获取用户在 Gravatar 上的头像
	function get_user_profile($userID){
		$email = get_email_by_id($userID);
		$hash = md5(strtolower(trim($email)));
		return "http://www.gravatar.com/avatar/". $hash;
	}
	
	//检验某用户是否已在 Gravatar 注册
	function validate_gravatar($userID) {
		$uri = get_user_profile($userID). '?d=404';
		
		$headers = @get_headers($uri);
		
		if (!preg_match("|200|", $headers[0])) {
			$has_valid_avatar = FALSE;
		} else {
			$has_valid_avatar = TRUE;
		}
		
		return $has_valid_avatar;
	}
?>