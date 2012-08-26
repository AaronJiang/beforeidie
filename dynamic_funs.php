<?php
	include_once('public_funs.php');
	
	//获取某 User 所关注的人的所有动态
	function get_followee_dynamics($userID){
		//获取 Goal 相关的动态
		$query = "(SELECT 'newGoal' as type, users.Username as Poster, goals.UserID as PosterID, GoalID, Title as GoalTitle, Reason as GoalReason, NULL as LogTitle, NULL as LogContent, CreateTime as Time\n"
				. "FROM goals, users\n"
				. "WHERE goals.UserID = users.UserID\n"
				. "AND goals.UserID IN\n"
					. "(SELECT FolloweeID\n"
					. "FROM followers\n"
					. "WHERE followers.FollowerID =". $userID. ")\n"
				. ")\n";
		$query .= "UNION ALL\n";
		//获取 Log 相关的动态
		$query .= "(SELECT 'newLog' as type, users.Username as Poster, goals.UserID as PosterID, goals.GoalID, goals.Title as GoalTitle, NULL as GoalReason, logs.LogTitle, logs.LogContent, logs.LogTime as Time\n"
				. "FROM goal_logs as logs, goals, users\n"
				. "WHERE logs.GoalID = goals.GoalID\n"
				. "AND goals.UserID = users.UserID\n"
				. "AND goals.UserID IN\n"
					. "(SELECT FolloweeID\n"
					. "FROM followers\n"
					. "WHERE followers.FollowerID = ". $userID. ")\n"
				.")\n";
		$query .= "ORDER BY Time DESC";
		
		$result = db_exec($query);
		
		$rows = array();
		while($row = $result->fetch_assoc()){
			array_push($rows, $row);
		}
		
		return $rows;
	}
	
	//获取某 User 的个人动态
	function get_dynamics($userID){
		//获取 Goal 相关的动态
		$query = "(SELECT 'newGoal' as type, users.Username as Poster, goals.UserID as PosterID, GoalID, Title as GoalTitle, Reason as GoalReason, NULL as LogTitle, NULL as LogContent, CreateTime as Time\n"
				. "FROM goals, users\n"
				. "WHERE goals.UserID = users.UserID\n"
				. "AND goals.UserID = ". $userID. ")\n";
		$query .= "UNION ALL\n";
		//获取 Log 相关的动态
		$query .= "(SELECT 'newLog' as type, users.Username as Poster, goals.UserID as PosterID, goals.GoalID, goals.Title as GoalTitle, NULL as GoalReason, logs.LogTitle, logs.LogContent, logs.LogTime as Time\n"
				. "FROM goal_logs as logs, goals, users\n"
				. "WHERE logs.GoalID = goals.GoalID\n"
				. "AND goals.UserID = users.UserID\n"
				. "AND goals.UserID = ". $userID. ")\n";
		$query .= "ORDER BY Time DESC\n"
				. "LIMIT 1, 3";

		$result = db_exec($query);
		
		$rows = array();
		while($row = $result->fetch_assoc()){
			array_push($rows, $row);
		}
		
		return $rows;	
	}
	
	//获取与我相关的动态
	function get_dynamics_about_me($userID){
		//鼓励
		$query = "(SELECT 'newCheer' as type, users.Username as Poster, users.UserID as PosterID, goals.GoalID, goals.Title as GoalTitle, goals.Reason, NULL as LogID, NULL as LogTitle, NULL as LogContent, NULL as Comment, goal_cheers.Time as Time\n"
				. "FROM goal_cheers, goals, users\n"
				. "WHERE goal_cheers.UserID = users.UserID\n"
				. "AND goal_cheers.GoalID = goals.GoalID\n"
				. "AND goals.UserID = ". $userID. "\n"
				. ")\n";
		$query .= "UNION ALL\n";
		//评论
		$query .= "(SELECT 'newComment' as Type, users.Username as Poster, users.UserID as PosterID, goals.GoalID, goals.Title as GoalTitle, goals.Reason, logs.LogID as LogID, logs.LogTitle as LogTitle, Logs.LogContent as LogContent, comments.Comment as Comment, comments.Time as Time\n"
				. "FROM comments, goals, goal_logs as logs, users\n"
				. "WHERE comments.PosterID != ". $userID. "\n"
				. "AND comments.PosterID = users.UserID\n"
				. "AND comments.LogID = logs.LogID\n"
				. "AND Logs.GoalID = goals.GoalID\n"
				. "AND goals.UserID = ". $userID ."\n"
				. ")\n";
		$query .= "ORDER BY Time DESC";
		
		$result = db_exec($query);
		
		$rows = array();
		while($row = $result->fetch_assoc()){
			array_push($rows, $row);
		}
		
		return $rows;
	}

?>
