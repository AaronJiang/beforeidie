<?php
	require_once('public_funs.php');

	//增加留言
	function new_message($message, $posterID, $parentID, $isRoot){
		if(!get_magic_quotes_gpc()){
			$message = addslashes($message);
		}

		$query = "insert into messages (Message, PosterID, ParentID, IsRoot) values\n"
				. "('". $message. "', '". $posterID. "', '". $parentID. "', '". $isRoot. "')";

		return db_exec($query);
	}

	//获取用户的所有留言
	function get_user_messages($userID){
		$query = "SELECT messages.Message, messages.Time, messages.PosterID, users.Username\n"
				. "FROM messages, users\n"
				. "WHERE messages.ReceiverID = ". $userID. "\n"
				. "AND messages.PosterID = users.UserID";
		
		$result = db_exec($query);
		
		$rows = array();
		while($row = $result->fetch_assoc()){
			array_push($rows, $row);
		}
		
		return $rows;
	}
?>