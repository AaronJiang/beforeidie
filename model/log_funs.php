<?php
	require_once('public_funs.php');
	
	//插入新记录
	function new_log($logContent, $goalID){
		$goalID = trim($goalID);
		$logContent = trim($logContent);
		
		if(!$logContent || !$goalID){
			echo "You have not enter all the required details!";
			exit;
		}
	
		if(!get_magic_quotes_gpc()){
			$logContent = addslashes($logContent);
		}
		
		$logContent = nl2br($logContent);
	
		$query = "insert into goal_logs (LogContent, GoalID)\n"
				. "values ('". $logContent. "', '". $goalID. "')";
		$result = db_exec($query);
		
		return $result? "true": "false";
	}
	
	//更新记录
	function update_log($logID, $logContent){
		$logID = trim($logID);
		$logContent = trim($logContent);
		
		if(!$logContent || !$logID){
			echo "You have not enter all the required details!";
			exit;
		}
	
		if(!get_magic_quotes_gpc()){
			$logContent = addslashes($logContent);
		}

		$logContent = nl2br($logContent);
		
		$query = "UPDATE goal_logs\n"
				. "SET LogContent = '". $logContent. "'\n"
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
	function get_log($goalID){
		$query = "SELECT logs.*, b.commentsNum\n"
				. "FROM goal_logs as logs LEFT JOIN (SELECT COUNT(*) as commentsNum, LogID FROM comments GROUP BY LogID) as b\n"
				. "ON logs.LogID = b.LogID\n"
				. "WHERE logs.GoalID = ". $goalID. "\n";
				
		$results = db_exec($query);
		
		$log = $results->fetch_assoc();
	
		return $log;
	}
	
	//获取某 Goal 的记录数目
	function get_goal_logs_num($goalID){
		$query = "select count(*) as num from goal_logs where GoalID = ". $goalID;
		$result = db_exec($query);
		
		$num = $result->fetch_assoc();

		return $num['num'];
	}
	
	function get_log_poster_id($logID){
		$query = "SELECT goals.UserID\n"
				. "FROM goal_logs, goals\n"
				. "WHERE goal_logs.LogID = ". $logID. "\n"
				. "AND goal_logs.GoalID = goals.GoalID";
				
		$result = db_exec($query);
		$row = $result->fetch_assoc();
		
		return $row['UserID'];
	}
?>