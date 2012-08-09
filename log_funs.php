<?php
	require_once('public_funs.php');
	
	//插入新动态
	function new_log($logTitle, $logContent, $goalID){
		$goalID = trim($goalID);
		$logTime = now_time();
		$logTitle = trim($logTitle);
		$logContent = trim($logContent);
		
		if(!$logContent){
			echo "You have not enter all the required details!";
			exit;
		}
	
		if(!get_magic_quotes_gpc()){
			$logTime = addslashes($logTime);
			$logTitle = addslashes($logTitle);
			$logContent = addslashes($logContent);
		}
	
		$query = "insert into goal_logs values (NULL, '". $logTime. "', '". $logTitle. "', '". $logContent. "', '". $goalID. "')";
		$result = db_exec($query);
		
		return $result? "true": "false";
	}
	
	//获取某目标的所有动态
	function get_logs($goalID){
		$query = "select * from goal_logs where GoalID = ". $goalID. " order by logTime desc";
		$results = db_exec($query);
		
		$logs = array();
		while($row = $results->fetch_assoc()){
			array_push($logs, $row);
		}
		
		return $logs;
	}
	
	//获取个人的所有动态
	function get_all_logs($userID){
		$query = "select users.Username, users.UserID, goal_logs.LogContent, goal_logs.LogTime, goals.Title, goals.GoalID ";
		$query .= "from goals, goal_logs, users ";
		$query .= "where users.UserID = ". $userID. " and goals.UserID = ". $userID. " and goals.GoalID = goal_logs.GoalID order by goal_logs.LogTime desc";
	
		return db_exec($query);
	}
	
	//获取某用户所关注的 Goal 的所有动态
	function get_followed_logs($userID){
		$query = "SELECT logs.LogTitle, logs.LogID, logs.LogContent, logs.LogTime, goals.GoalID, goals.Title, users.Username, users.UserID\n"
    			. "FROM goal_logs as logs, goal_followers as fows, goals, users\n"
				. "WHERE fows.FollowerID = ". $userID. "\n"
				. "AND fows.GoalID = logs.GoalID\n"
				. "AND logs.GoalID = goals.GoalID\n"
				. "AND users.UserID = goals.UserID\n"
				. "ORDER BY logs.LogTime desc";

		$result = db_exec($query);
		
		$logs = array();
		while($row = $result->fetch_assoc()){
			array_push($logs, $row);
		}

		return $logs;
	}
	
	//获取某种类型的 Goal 的动态数目
	function get_goal_logs_num($goalID){
		$query = "select count(*) from goal_logs where GoalID = ". $goalID;
		$result = db_exec($query);
		
		$num = $result->fetch_assoc();

		return $num['count(*)'];
	}
?>