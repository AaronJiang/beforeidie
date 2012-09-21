<?php
	include_once('public_funs.php');
	
	//获取某 User 所关注的人的所有动态
	function get_followee_dynamics($userID){
		//设立新的 Goal
		$query = "(SELECT 'newGoal' as type, users.Username as Poster, users.UserID as PosterID, NULL as Followee, NULL as FolloweeID, GoalID, Title as GoalTitle, Reason as GoalReason, NULL as LogID, NULL as LogTitle, NULL as LogContent, CreateTime as Time\n"
				. "FROM goals, users\n"
				. "WHERE goals.UserID = users.UserID\n"
				. "AND goals.UserID IN\n"
					. "(SELECT FolloweeID\n"
					. "FROM followers\n"
					. "WHERE followers.FollowerID =". $userID. ")\n"
				. ")\n";
		$query .= "UNION ALL\n";
		//发表新的 Log
		$query .= "(SELECT 'newLog' as type, users.Username as Poster, users.UserID as PosterID, NULL as Followee, NULL as FolloweeID, goals.GoalID, goals.Title as GoalTitle, NULL as GoalReason, logs.LogID, logs.LogTitle, logs.LogContent, logs.LogTime as Time\n"
				. "FROM goal_logs as logs, goals, users\n"
				. "WHERE logs.GoalID = goals.GoalID\n"
				. "AND goals.UserID = users.UserID\n"
				. "AND goals.UserID IN\n"
					. "(SELECT FolloweeID\n"
					. "FROM followers\n"
					. "WHERE followers.FollowerID = ". $userID. ")\n"
				.")\n";
		$query .= "UNION ALL\n";
		//完成了目标	
		$query .= "(SELECT 'finishGoal' as type, users.Username as Poster, users.UserID as PosterID, NULL as Followee, NULL as FolloweeID, goals.GoalID, goals.Title as GoalTitle, NULL as GoalReason, logs.LogID, logs.LogTitle, logs.LogContent, goals.EndTime as Time\n"
			    . "FROM goal_logs as logs, goals, users\n"
			    . "WHERE goals.GoalType = 'finish'\n"
			    . "AND goals.GoalID = logs.GoalID\n"
			    . "AND logs.TypeID = 0\n"
			    . "AND goals.UserID = users.UserID\n"
				. "AND goals.UserID IN\n"
					. "(SELECT FolloweeID\n"
					. "FROM followers\n"
					. "WHERE followers.FollowerID = ". $userID. ")\n"
			    . ")\n";
		$query .= "UNION ALL\n";
		//关注了他人
		$query .= "(SELECT 'followOther' as type, u1.Username as Poster, u1.UserID as PosterID, u2.Username as Followee, u2.UserID as FolloweeID, NULL as GoalID, NULL as GoalTitle, NULL as GoalReason, NULL as LogID, NULL as LogTitle, NULL as LogContent, fows.Time as Time\n"
				. "FROM followers as fows, users as u1, users as u2\n"
				. "WHERE fows.FollowerID IN\n"
					. "(SELECT FolloweeID\n"
					. "FROM followers\n"
					. "WHERE followers.FollowerID = ". $userID. ")\n"
				. "AND fows.FolloweeID != ". $userID. "\n"	//关注自己的消息不显示在这里，而显示在私信中
				. "AND fows.FollowerID = u1.UserID\n"
				. "AND fows.FolloweeID = u2.UserID\n"
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
	function get_dynamics($userID, $num){
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
		$query .= "ORDER BY Time DESC\n";

		if(isset($num)){
			$query .= "LIMIT 0, ". $num;
		}

		$result = db_exec($query);
		
		$rows = array();
		while($row = $result->fetch_assoc()){
			array_push($rows, $row);
		}
		
		return $rows;	
	}
	
	//获取与我相关的动态
	function get_dynamics_about_me($userID){
		//鼓励我的Goal
		$query = "(SELECT 'newCheer' as type, users.Username as Poster, users.UserID as PosterID, goals.GoalID, goals.Title as GoalTitle, goals.Reason, NULL as LogID, NULL as LogTitle, NULL as LogContent, NULL as CommentID, NULL as CommentIsRoot, NULL as Comment, goal_cheers.Time as Time\n"
				. "FROM goal_cheers, goals, users\n"
				. "WHERE goal_cheers.UserID = users.UserID\n"
				. "AND goal_cheers.GoalID = goals.GoalID\n"
				. "AND goals.UserID = ". $userID. "\n"
				. ")\n";
		$query .= "UNION ALL\n";
		//关注我
		$query .= "(SELECT 'newFollow' as type, users.Username as Poster, users.UserID as PosterID, NULL as GoalID, NULL as GoalTitle, NULL as Reason, NULL as LogID, NULL as LogTitle, NULL as LogContent, NULL as CommentID, NULL as CommentIsRoot, NULL as Comment, fows.Time as Time\n"
				. "FROM followers as fows, users\n"
				. "WHERE fows.FolloweeID = ". $userID. "\n"
				. "AND fows.FollowerID = users.UserID)\n";
		$query .= "UNION ALL\n";
		//在我的Goal中出现的回复
		$query .= "(SELECT 'newCommentOnMyLog' as Type, users.Username as Poster, users.UserID as PosterID, goals.GoalID, goals.Title as GoalTitle, goals.Reason, logs.LogID as LogID, logs.LogTitle as LogTitle, Logs.LogContent as LogContent, comments.CommentID, comments.IsRoot as CommentIsRoot, comments.Comment as Comment, comments.Time as Time\n"
				. "FROM comments, goals, goal_logs as logs, users\n"
				. "WHERE comments.PosterID != ". $userID. "\n"
				. "AND comments.PosterID = users.UserID\n"
				. "AND comments.LogID = logs.LogID\n"
				. "AND Logs.GoalID = goals.GoalID\n"
				. "AND goals.UserID = ". $userID ."\n"
				. "AND comments.CommentID IN"
					. "(SELECT comments.CommentID\n"
					. "FROM comments\n"
					. "RIGHT JOIN\n"
						. "(SELECT LogID, Max(Time) as MaxTime\n"
						. "FROM comments\n"
						. "GROUP BY LogID) as B\n"
						. "ON comments.LogID = B.LogID\n"
						. "AND comments.Time = B.MaxTime\n"
					. ")\n"
				. ")\n";
		$query .= "UNION ALL\n";
		//在他人的Goal中针对我的回复
		$query .= "(SELECT 'newCommentOnOtherLog' as Type, users.Username as Poster, users.UserID as PosterID, goals.GoalID, goals.Title as GoalTitle, goals.Reason, logs.LogID as LogID, logs.LogTitle as LogTitle, Logs.LogContent as LogContent, c1.CommentID, NULL as CommentIsRoot, c1.Comment as Comment, c1.Time as Time\n"
				. "FROM comments as c1, comments as c2, goals, goal_logs as logs, users\n"
				. "WHERE c1.PosterID != ". $userID. "\n"
				. "AND c1.IsRoot = 0\n"
				. "AND c1.PosterID = users.UserID\n"
				. "AND c1.LogID = logs.LogID\n"
				. "AND logs.GoalID = goals.GoalID\n"
				. "AND goals.UserID != ". $userID. "\n"
				. "AND c1.ParentCommentID = c2.CommentID\n"
				. "AND c2.PosterID = ". $userID. "\n"
				. "AND c1.CommentID IN\n"
				. "(SELECT comments.CommentID\n"
					. "FROM comments\n"
					. "RIGHT JOIN\n"
						. "(SELECT LogID, Max(Time) as MaxTime\n"
						. "FROM comments\n"
						. "GROUP BY LogID) as B\n"
						. "ON comments.LogID = B.LogID\n"
						. "AND comments.Time = B.MaxTime\n"
					. ")\n"
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
