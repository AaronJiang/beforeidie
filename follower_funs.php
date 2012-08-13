<?php
	require_once('public_funs.php');
	
	//检查是否已经关注
	function check_is_followed($followerID, $followeeID){
		$query = "select * from followers where FollowerID = ". $followerID. " and FolloweeID = ". $followeeID;
		$result = db_exec($query);
		
		return ($result->num_rows > 0)? true: false;
	}
	
	//关注 Goal
	function follow_user($followerID, $followeeID){
		$query = "insert into followers (FollowerID, FolloweeID) values (". $followerID. ", ". $followeeID. ")";
		return db_exec($query);
	}
	
	//取消关注
	function disfollow_user($followerID, $followeeID){
		$query = "delete from followers where FollowerID = ". $followerID. " and FolloweeID = ". $followeeID;
		return db_exec($query);
	}
	
	//获取某 User 的所有关注者信息
	function get_followers($goalID){
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
				. "AND fows.FolloweeID = users.UserID";
				
		$result = db_exec($query);
		
		$array = array();
		while($row = $result->fetch_assoc()){
			array_push($array, $row);
		}
		
		return $array;
	}
?>