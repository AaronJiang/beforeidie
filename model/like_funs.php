<?php
	require_once('public_funs.php');

	function check_goal_like($goalID, $userID){
		$query = "SELECT * FROM likes WHERE GoalID = ". $goalID. " AND UserID = ". $userID;
		$result = db_exec($query);
		return ($result->num_rows > 0);
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
		$row = $result->fetch_assoc();

		return $row['num'];
	}

?>