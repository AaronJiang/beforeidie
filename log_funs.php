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
	function get_all_logs(){
		$query = "select goal_logs.LogContent, goal_logs.LogTime, goals.Title, goals.GoalID from goal_logs, goals ";
		$query .= "where goal_logs.GoalID = goals.GoalID order by goal_logs.LogTime desc";
	
		return db_exec($query);
	}
	
	function get_logs_num($goalID){
		$query = "select count(*) from goal_logs where GoalID = ". $goalID;
		$result = db_exec($query);
		
		$num = $result->fetch_assoc();

		return $num['count(*)'];
	}
?>