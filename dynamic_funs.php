<?php
	include_once('public_funs.php');
	
	//获取某 User 所关注的人的所有动态
	function get_dynamics($userID){
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

?>
