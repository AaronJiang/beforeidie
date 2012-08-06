<?php

	require_once('public_funs.php');

	//获取多个目标
	function get_goals($userID, $goalType){
	
		$query = "select * from goals where UserID = ".$userID. " and GoalType = '". $goalType. "'";
		$results = db_exec($query);
		
		$array = array();
		while($row = $results->fetch_assoc()){
			array_push($array, $row);
		}
		
		return $array;
	}
	
	//获取单个目标
	function get_goal_by_ID($goalID){
		$query = "select * from goals where GoalID = ". $goalID;
		$results = db_exec($query);
		return $results->fetch_assoc();	
	}

	//删除目标
	function delete_goal($goalID){
		$goalID	= trim($goalID);

		$query = "delete from goals where GoalID = ". $goalID;
		$result = db_exec($query);
	
		return $result? "true": "false";
	}
	
	//新增目标
	function new_goal($userID, $title, $reason, $goalType, $startTime){
		$title = trim($title);
		$reason = trim($reason);
		$goalType = trim($goalType);
		
		if($goalType == "now"){
			$startTime = now_date();
		}
		elseif($goalType == "future"){
			$startTime = trim($startTime);
		}
	
		$createTime = now_time();
		$updateTime = now_time();
	
		if(!$title || !$reason || !$goalType || !$startTime){
			echo "You have not enter all the required details!";
			exit;
		}
		
		if(!get_magic_quotes_gpc()){
			$title = addslashes($title);
			$reason = addslashes($reason);
			$goalType = addslashes($goalType);
			$startTime = addslashes($startTime);
		}
		
		$query = "insert into goals (UserID, Title, Reason, GoalType, StartTime, CreateTime, UpdateTime) ";
		$query .= "values (". $userID. ", '". $title. "', '". $reason. "', '". $goalType. "', '". $startTime. "', '". $createTime. "', '". $updateTime. "')";
		
		$result = db_exec($query);
		
		return $result? 'true': 'false';
	}
	
	//启动目标
	function start_goal($goalID){
		$goalID	= trim($goalID);

		$query = "update goals set GoalType = 'now' where GoalID = ". $goalID;
		$result = db_exec($query);
		
		return $result? "true": "false";
	}
	
	//自动启动到达预定日期的目标
	function autostart_goals($userID){
		$query = "select GoalID from goals where UserID = ". $userID. " and GoalType = 'future' and StartTime <= '". now_date(). "'";
		$result = db_exec($query);
		
		if($result->num_rows != 0){
			while($row = $result->fetch_assoc()){
				start_goal($row['GoalID']);
			}	
		}
	}
	
	//延迟目标
	function delay_goal($goalID, $startTime){
		$goalID	= trim($goalID);
		$startTime = trim($startTime);
		
		if(!$goalID || !$startTime){
			echo "You have not enter all the required details!";
			exit;
		}
		
		if(!get_magic_quotes_gpc()){
			$goalID = addslashes($goalID);
			$startTime = addslashes($startTime);
		}

		$query = "update goals set GoalType = 'future', StartTime = '". $startTime. "'where GoalID = ". $goalID;
		$result = db_exec($query);
	
		return $result? "true": "false";
	}
	
	//更新目标
	function update_goal($goalID, $title, $reason, $goalType, $startTime){
		$goalID = trim($goalID);
		$title = trim($title);
		$reason = trim($reason);
		$goalType = trim($goalType);
		$startTime = trim($startTime);
	
		if(!$title || !$reason || !$goalType){
			echo "You have not enter all the required details!";
			exit;
		}
		
		if(!get_magic_quotes_gpc()){
			$title = addslashes($title);
			$reason = addslashes($reason);
			$goalType = addslashes($goalType);
			$startTime = addslashes($startTime);
		}
	
		$query = "update goals set Title = '". $title. "', Reason = '". $reason. "', GoalType = '". $goalType. "', StartTime = '". $startTime. "', UpdateTime = '". now_time(). "' where GoalID = ". $goalID;
		$result = db_exec($query);
		
		return $result? "true": "false";
	}
	
	//更新目标的最后修改时间
	function update_goal_updatetime($goalID, $updateTime){
		$goalID = trim($goalID);
		$updateTime = trim($updateTime);
		
		if(!$goalID  || !$updateTime){
			echo "You have not enter all the required details!";
			exit;
		}
		
		if(!get_magic_quotes_gpc()){
			$goalID = addslashes($goalID);
			$updateTime = addslashes($updateTime);
		}
		
		$query = "update goals set UpdateTime = '". $updateTime. "' where GoalID = ". $goalID;
		$result = db_exec($query);
		
		return $result? 'true': 'false';
	}
	
	
	//获取对应类型的目标个数
	function get_goal_num($userID, $goalType){	
		$query = "select count(*) from goals where UserID = ". $userID. " and GoalType = '". $goalType ."'";
		$result = db_exec($query);
		
		$num = $result->fetch_assoc();

		return $num['count(*)'];
	}
?>
