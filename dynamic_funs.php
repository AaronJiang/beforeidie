<?php
	include_once('public_funs.php');
	
	//获取某 User 所关注的人的所有动态
	function get_followee_dynamics($userID){
		//获取 Goal 相关的动态
		$query = "(SELECT 'newGoal' as type, users.Username as Poster, goals.UserID as PosterID, GoalID, Title as GoalTitle, Reason as GoalReason, NULL as LogID, NULL as LogTitle, NULL as LogContent, CreateTime as Time\n"
				. "FROM goals, users\n"
				. "WHERE goals.UserID = users.UserID\n"
				. "AND goals.UserID IN\n"
					. "(SELECT FolloweeID\n"
					. "FROM followers\n"
					. "WHERE followers.FollowerID =". $userID. ")\n"
				. ")\n";
		$query .= "UNION ALL\n";
		//获取 Log 相关的动态
		$query .= "(SELECT 'newLog' as type, users.Username as Poster, goals.UserID as PosterID, goals.GoalID, goals.Title as GoalTitle, NULL as GoalReason, logs.LogID, logs.LogTitle, logs.LogContent, logs.LogTime as Time\n"
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
		$query = "(SELECT 'newGoal' as type, users.Username as Poster, goals.UserID as PosterID, GoalID, Title as GoalTitle, Reason as GoalReason, NULL as LogID, NULL as LogTitle, NULL as LogContent, CreateTime as Time\n"
				. "FROM goals, users\n"
				. "WHERE goals.UserID = users.UserID\n"
				. "AND goals.UserID = ". $userID. ")\n";
		$query .= "UNION ALL\n";
		//获取 Log 相关的动态
		$query .= "(SELECT 'newLog' as type, users.Username as Poster, goals.UserID as PosterID, goals.GoalID, goals.Title as GoalTitle, NULL as GoalReason, logs.LogID, logs.LogTitle, logs.LogContent, logs.LogTime as Time\n"
				. "FROM goal_logs as logs, goals, users\n"
				. "WHERE logs.GoalID = goals.GoalID\n"
				. "AND goals.UserID = users.UserID\n"
				. "AND goals.UserID = ". $userID. ")\n";
		$query .= "ORDER BY Time DESC\n"
				. "LIMIT 0, 3";

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
		$query = "(SELECT 'newCheer' as type, users.Username as Poster, users.UserID as PosterID, goals.GoalID, goals.Title as GoalTitle, goals.Reason, NULL as LogID, NULL as LogTitle, NULL as LogContent, NULL as CommentID, NULL as Comment, goal_cheers.Time as Time\n"
				. "FROM goal_cheers, goals, users\n"
				. "WHERE goal_cheers.UserID = users.UserID\n"
				. "AND goal_cheers.GoalID = goals.GoalID\n"
				. "AND goals.UserID = ". $userID. "\n"
				. ")\n";
		$query .= "UNION ALL\n";	
		//评论我的Goal
		$query .= "(SELECT 'newCommentOnGoal' as Type, users.Username as Poster, users.UserID as PosterID, goals.GoalID, goals.Title as GoalTitle, goals.Reason, logs.LogID as LogID, logs.LogTitle as LogTitle, Logs.LogContent as LogContent, comments.CommentID, comments.Comment as Comment, comments.Time as Time\n"
				. "FROM comments, goals, goal_logs as logs, users\n"
				. "WHERE comments.PosterID != ". $userID. "\n"
				. "AND comments.IsRoot = 1\n"
				. "AND comments.PosterID = users.UserID\n"
				. "AND comments.LogID = logs.LogID\n"
				. "AND Logs.GoalID = goals.GoalID\n"
				. "AND goals.UserID = ". $userID ."\n"
				. ")\n";
		$query .= "UNION ALL\n";
		//评论我的Comment
		$query .= "(SELECT 'newCommentOnComment' as Type, users.Username as Poster, users.UserID as PosterID, goals.GoalID, goals.Title as GoalTitle, goals.Reason, logs.LogID as LogID, logs.LogTitle as LogTitle, Logs.LogContent as LogContent, c1.CommentID, c1.Comment as Comment, c1.Time as Time\n"
				. "FROM comments as c1, comments as c2, goals, goal_logs as logs, users\n"
				. "WHERE c1.PosterID != ". $userID. "\n"
				. "AND c1.IsRoot = 0\n"
				. "AND c1.PosterID = users.UserID\n"
				. "AND c1.LogID = logs.LogID\n"
				. "AND logs.GoalID = goals.GoalID\n"
				. "AND c1.ParentCommentID = c2.CommentID\n"
				. "AND c2.PosterID = ". $userID. "\n"
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
