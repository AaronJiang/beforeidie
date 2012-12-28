<?php
	require_once('public_funs.php');

	function check_goal_like($goalID, $userID){
		$query = "SELECT * FROM likes WHERE GoalID = ". $goalID. " AND UserID = ". $userID;
		$result = db_exec($query);
		return mysql_num_rows($result) > 0;
	}

	function change_goal_like($goalID, $userID, $isLike){
		if($isLike == 1){
			$query = "DELETE FROM likes WHERE GoalID = ". $goalID. " AND UserID = ". $userID;
		} else {
			$query = "INSERT INTO likes (GoalID, UserID) VALUES (". $goalID. ", ". $userID. ")";
		}

		return db_exec($query);
	}

	function get_likes_num($userID){
		$query = "SELECT COUNT(*) AS num FROM likes WHERE UserID = ". $userID;
		$result = db_exec($query);
		$row = mysql_fetch_assoc($result);

		return $row['num'];
	}

	function get_likes($userID){
		$query = "SELECT goals.GoalID, goals.Title, goals.Content, users.UserID, users.Username\n"
				. "FROM likes, goals, users\n"
				. "WHERE likes.UserID = ". $userID. "\n"
				. "AND likes.GoalID = goals.GoalID\n"
				. "AND goals.UserID = users.UserID";

		$result = db_exec($query);

		$array = array();
		while($row = mysql_fetch_assoc($result)){
			array_push($array, $row);
		}
		
		return $array;
	}
?>