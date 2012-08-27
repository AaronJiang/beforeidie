<?php
	require_once('public_funs.php');
	
	//插入新记录
	function new_log($logTitle, $logContent, $goalID){
		$goalID = trim($goalID);
		$logTime = now_time();
		$logTitle = trim($logTitle);
		$logContent = trim($logContent);
		
		if(!$logContent || !$goalID){
			echo "You have not enter all the required details!";
			exit;
		}
	
		if(!get_magic_quotes_gpc()){
			$logTime = addslashes($logTime);
			$logTitle = addslashes($logTitle);
			$logContent = addslashes($logContent);
		}
		
		$logContent = nl2br($logContent);
	
		$query = "insert into goal_logs (LogTime, LogTitle, LogContent, GoalID)\n"
				. "values ('". $logTime. "', '". $logTitle. "', '". $logContent. "', '". $goalID. "')";
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
		
		$logContent = nl2br($logContent);
		
		/*
		//将 textarea 文本中的 \n 换成 <br>
		$logContent = str_replace("\r\n", "<br>", $logContent);
		$logContent = str_replace("\n", "<br>", $logContent);		
		//将 textarea 文本中的 空格 换成 &nbsp;
		$logContent = str_replace(' ', '&nbsp;', $logContent);
		*/
		
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
	
	//获取某种类型的 Goal 的动态数目
	function get_goal_logs_num($goalID){
		$query = "select count(*) from goal_logs where GoalID = ". $goalID;
		$result = db_exec($query);
		
		$num = $result->fetch_assoc();

		return $num['count(*)'];
	}
?>