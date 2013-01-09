<?php 

class Account_model extends CI_Model{

// GET

	function get_user_by_id($userID){
		$query = "SELECT * FROM users WHERE UserID = ". $userID;
		$result = $this->db->query($query);
		return $result->row();
	}

	function get_user_by_email($email){
		$query = "SELECT * FROM users WHERE Email = '". $email. "'";
		$result = $this->db->query($query);
		return $result->row();
	}

	function get_email_by_id($userID){
		$query = "SELECT Email FROM users WHERE UserID = ". $userID;
		$result = $this->db->query($query);
		$row = $result->row();
		return $row->Email;
	}

// NEW

	//用户注册
	function new_user($username, $pwd, $email, $gravatarUrl){
		$query = "INSERT INTO users (Username, Password, Email, AvatarUrl) VALUES (?, ?, ?, ?)";
		return $this->db->query($query, array($username, sha1($pwd), $email, $gravatarUrl));
	}

// UPDATE

	function active_account($email){
		$query = "UPDATE users SET IsActive = 1 WHERE Email = '". $email. "'";
		return $this->db->query($query);
	}

	function change_pwd_by_email($email, $pwd){
		$query = "UPDATE users SET Password = ? WHERE Email = ?";
		return $this->db->query($query, array(sha1($pwd), $email));
	}

	function change_pwd_by_id($userID, $pwd){
		$query = "UPDATE users SET Password = ? WHERE UserID = ?";
		return $this->db->query($query, array(sha1($pwd), $userID));
	}

	function change_sex($userID, $sex){
		$query = "UPDATE users SET Sex = ? WHERE UserID = ?";
		return $this->db->query($query, array($sex, $userID));
	}

// CHECK

	function check_user_pwd_by_email($email, $pwd){
		$query = "SELECT * FROM users WHERE Email = ? AND Password = ?";
		$result = $this->db->query($query, array($email, sha1($pwd)));
		return ($result->num_rows > 0);
	}

	function check_user_pwd_by_id($userID, $pwd){
		$query = "SELECT * FROM users WHERE UserID = ? AND Password = ?";
		$result = $this->db->query($query, array($userID, sha1($pwd)));
		return ($result->num_rows > 0);		
	}

	function check_user_active($email, $pwd){
		$query = "SELECT * FROM users WHERE Email = ? AND Password = ? AND IsActive = 1";
		$result = $this->db->query($query, array($email, sha1($pwd)));
		return ($result->num_rows > 0);
	}

	// 检查邮箱是否已存在
	function check_email_repeat($email){
		$query = "SELECT * FROM users WHERE Email = '". $email. "'";
		$result = $this->db->query($query);
		return ($result->num_rows > 0);
	}

	// 检查用户名是否已存在
	function check_username_repeat($username){
		$query = "SELECT * FROM users WHERE Username = '". $username. "'";
		$result = $this->db->query($query);
		return ($result->num_rows > 0);
	}
}

?>