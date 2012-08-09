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
	
	//获取某 Goal 的 关注者数目
	function get_goal_followers_num($goalID){
		$query = "select count(*) as num from goal_followers where GoalID = ". $goalID;
		$result = db_exec($query);
		
		$row = $result->fetch_assoc();
		
		return $row['num'];
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
	
	//获取某 User 所关注的 Goals
	function get_followed_goals($userID){
		$query = "SELECT goals.GoalID, goals.Title, goals.Reason\n"
				. "FROM goals\n"
				. "WHERE goals.GoalID IN\n"
				. "(SELECT GoalID From goal_followers WHERE FollowerID = ". $userID. ")\n";
			
		$result = db_exec($query);
		
		$array = array();
		while($row = $result->fetch_assoc()){
			array_push($array, $row);
		}
		
		return $array;	
	}
	

?>