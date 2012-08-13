<?php
	require_once('public_funs.php');
	
	//检查是否已经关注
	function check_goal_is_followed($goalID, $userID){
		$query = "select * from goal_followers where GoalID = ". $goalID. " and FollowerID = ". $userID;
		$result = db_exec($query);
		
		return ($result->num_rows > 0)? true: false;
	}
	
	//关注 Goal
	function follow_goal($goalID, $userID){
		$query = "insert into goal_followers values (NULL, ". $goalID. ", ". $userID. ")";
		return db_exec($query);
	}
	
	//取消关注
	function disfollow_goal($goalID, $userID){
		$query = "delete from goal_followers where GoalID = ". $goalID. " and FollowerID = ". $userID;
		return db_exec($query);
	}
	
	//获取某 Goal 的所有关注者信息
	function get_goal_followers($goalID){
		$query = "SELECT users.Username, users.UserID\n"
				. "FROM users, goal_followers\n"
				. "WHERE goal_followers.GoalID = ". $goalID. "\n"
				. "AND goal_followers.FollowerID = users.UserID";
		
		$result =db_exec($query);
		
		$array = array();
		while($row = $result->fetch_assoc()){
			array_push($array, $row);
		}
		
		return $array;		
	}
	
	//获取某用户所关注的 User
	function get_followed_users($followerID){
		$query = "SELECT users.Username, users.UserID\n"
				. "FROM followers as fows, users\n"
				. "WHERE fows.FollowerID = ". $followerID. "\n"
				. "AND fows.UserID = users.UserID";
				
		$result = db_exec($query);
		
		$array = array();
		while($row = $result->fetch_assoc()){
			array_push($array, $row);
		}
		
		return $array;
	}
?>