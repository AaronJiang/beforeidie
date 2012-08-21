<?php
	require_once('public_funs.php');
	
	//插入新记录
	function new_log($logTitle, $logContent, $goalID){
		$goalID = trim($goalID);
		$logTime = now_time();
		$logTitle = trim($logTitle);
		$logContent = trim($logContent);
		
		if(!$logContent || !$logID){
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
	
	//更新记录
	function update_log($logID, $logTitle, $logContent){
		$logID = trim($logID);
		$logTitle = trim($logTitle);
		$logContent = trim($logContent);
		
		if(!$logContent || !$logID){
			echo "You have not enter all the required details!";
			exit;
		}
	
		if(!get_magic_quotes_gpc()){
			$logTitle = addslashes($logTitle);
			$logContent = addslashes($logContent);
		}
		
		$query = "UPDATE goal_logs\n"
				. "SET LogTitle = '". $logTitle. "',\n"
				. "LogContent = '". $logContent. "'\n"
				. "WHERE LogID = ". $logID;
		
		return db_exec($query);
	}
	
	//删除记录
	function delete_log($logID){
		$query = "delete from goal_logs where logID = ". $logID;
		return db_exec($query);
	}
	
	//获取所有记录的总数
	function get_all_logs_num(){
		$query = "select count(*) as logs_num from goal_logs";
		$result = db_exec($query);
		$row = $result->fetch_assoc();
		
		return $row['logs_num'];
	}
	
	//获取某 Goal 的所有记录
	function get_logs($goalID){
		$query = "select * from goal_logs where GoalID = ". $goalID. " order by logTime desc";
		$results = db_exec($query);
		
		$logs = array();
		while($row = $results->fetch_assoc()){
			array_push($logs, $row);
		}
		
		return $logs;
	}
	
	//获取某 User 的所有记录
	function get_all_logs($userID){
		$query = "SELECT goal_logs.LogTitle, goal_logs.LogContent, goal_logs.LogTime, goals.Title, goals.GoalID\n"
				. "FROM goals, goal_logs\n"
				. "WHERE goals.UserID = ". $userID. "\n"
				. "AND goals.GoalID = goal_logs.GoalID\n"
				. "ORDER BY goal_logs.LogTime DESC\n"
				. "LIMIT 0 , 3";
				
		$results = db_exec($query);
		
		$logs = array();
		while($row = $results->fetch_assoc()){
			array_push($logs, $row);
		}
		
		return $logs;
	}
	
	//获取某用户所关注的 User 的所有动态
	function get_followed_logs($followerID){
		$query = "SELECT logs.LogTitle, logs.LogID, logs.LogContent, logs.LogTime, goals.GoalID, goals.Title, users.Username, users.UserID\n"
				. "FROM followers as fows, goals, goal_logs as logs, users\n"
				. "WHERE fows.FollowerID = ". $followerID. "\n"
				. "AND fows.FolloweeID = goals.UserID\n"
				. "AND goals.GoalID = logs.GoalID\n"
				. "AND goals.IsPublic = 1\n"
				. "AND users.UserID = fows.FolloweeID\n"
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