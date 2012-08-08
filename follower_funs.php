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
	
	//获取某 Goal 的所有关注者
	function get_followers($goalID){
	
	}
	
	//获取某用户所有关注的 Goal
	function get_followed_goals($userID){
	
	}
?>