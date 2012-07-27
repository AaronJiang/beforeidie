<?php

	require_once('public_funs.php');

	//插入新动态
	function new_log($logContent, $goalID){
		$goalID = trim($goalID);
		$logTime = now_time();
		$logContent = trim($logContent);
		
		if(!$logContent){
			echo "You have not enter all the required details!";
			exit;
		}
	
		if(!get_magic_quotes_gpc()){
			$logTime = addslashes($logTime);
			$logContent = addslashes($logContent);
		}
	
		$query = "insert into goal_logs values (NULL, '". $logTime. "', '". $logContent. "', '". $goalID. "')";
		$result = db_exec($query);
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
?>