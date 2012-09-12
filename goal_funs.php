<?php

	require_once('public_funs.php');

	//获取单个目标
	function get_goal_by_ID($goalID){
		$query = "SELECT * FROM goals WHERE GoalID = ". $goalID;
		$results = db_exec($query);
		return $results->fetch_assoc();	
	}
	
	//获取某个用户的某种类型的全部目标
	function get_goals($userID, $goalType, $isPublic){
		$query = "SELECT * FROM goals WHERE UserID = ". $userID. " AND GoalType = '". $goalType. "'\n";
		
		if($isPublic){
			$query .= "AND IsPublic = 1\n";
		}
		
		if($goalType == 'future'){
			$query .= "ORDER BY StartTime ASC\n";
		}
		elseif($goalType == 'finish'){
			$query .= "ORDER BY EndTime DESC\n";	
		}
		
		$results = db_exec($query);
		
		$array = array();
		while($row = $results->fetch_assoc()){
			array_push($array, $row);
		}
		
		return $array;
	}
	
	//获取热门目标
	function get_hot_goals($userID){
		$sql = "SELECT goals.GoalID, goals.Title, goals.Reason\n"
	    	. "FROM goals\n"
	    	. "WHERE goals.GoalType = 'now'\n"
			. "AND goals.isPublic = 1\n"
			. "AND goals.UserID != ". $userID. "\n"
			. "AND goals.GoalID IN\n"
				. "(SELECT GoalID FROM\n"
					. "(SELECT goal_logs.GoalID, COUNT(*) AS LogsNum\n"
					. "FROM goal_logs GROUP BY goal_logs.GoalID) AS c1\n"
					. "WHERE logsNum > 5)\n";
		
		$result = db_exec($sql);
		
		$array = array();
		while($row = $result->fetch_assoc()){
			array_push($array, $row);
		}
		
		return $array;		
	}

	//获取所有目标的总数
	function get_all_goals_num(){
		$query = "select count(*) as goals_num from goals";
		$result = db_exec($query);
		$row = $result->fetch_assoc();
		
		return $row['goals_num'];	
	}

	//删除目标
	function delete_goal($goalID){
		$goalID	= trim($goalID);

		$query = "delete from goals where GoalID = ". $goalID;
		$result = db_exec($query);
	
		return $result? "true": "false";
	}
	
	//新增目标
	function new_goal($userID, $title, $reason, $goalType, $startTime, $isPublic){
		$title = trim($title);
		$reason = trim($reason);
		$goalType = trim($goalType);
		
		if($goalType == "now"){
			$startTime = now_date();
		}
		elseif($goalType == "future"){
			$startTime = trim($startTime);
		}
	
		if(!$title || !$reason || !$startTime){
			echo "You have not enter all the required details!";
			exit;
		}
		
		if(!get_magic_quotes_gpc()){
			$title = addslashes($title);
			$reason = addslashes($reason);
			$goalType = addslashes($goalType);
			$startTime = addslashes($startTime);
		}
		
		$query = "insert into goals (UserID, Title, Reason, GoalType, StartTime, CreateTime, IsPublic) ";
		$query .= "values (". $userID. ", '". $title. "', '". $reason. "', '". $goalType. "', '". $startTime. "', NOW(), ". $isPublic. ")";
		
		$result = db_exec($query);
		
		//return $result? mysql_insert_id(): 'false';
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
	function update_goal($goalID, $title, $reason, $goalType, $startTime, $isPublic){
		$goalID = trim($goalID);
		$title = trim($title);
		$reason = trim($reason);
		$goalType = trim($goalType);
		$startTime = trim($startTime);
	
		if(!$title || !$reason){
			echo "You have not enter all the required details!";
			exit;
		}
		
		if(!get_magic_quotes_gpc()){
			$title = addslashes($title);
			$reason = addslashes($reason);
			$goalType = addslashes($goalType);
			$startTime = addslashes($startTime);
		}
	
		$query = "update goals set Title = '". $title. "', Reason = '". $reason. "', GoalType = '". $goalType. "', StartTime = '". $startTime. "', UpdateTime = '". now_time(). "', IsPublic = ". $isPublic. " where GoalID = ". $goalID;
		$result = db_exec($query);
		
		return $result? "true": "false";
	}
	
	//更新目标的最后修改时间
	function update_goal_updatetime($goalID, $updateTime){
		$goalID = trim($goalID);
		$updateTime = trim($updateTime);
		
		if(!$goalID || !$updateTime){
			echo "You have not enter all the required details!";
			exit;
		}
		
		if(!get_magic_quotes_gpc()){
			$goalID = addslashes($goalID);
			$updateTime = addslashes($updateTime);
		}
		
		$query = "UPDATE goals SET UpdateTime = '". $updateTime. "' WHERE GoalID = ". $goalID;
		$result = db_exec($query);
		
		return $result? 'true': 'false';
	}
	
	//更新目标的题目
	function update_goal_title($goalID, $goalTitle){
		$query = "UPDATE goals SET Title = '". $goalTitle. "' WHERE GoalID = ". $goalID;
		return db_exec($query);
	}
	
	//更新目标的愿景
	function update_goal_reason($goalID, $goalReason){
		$query = "UPDATE goals SET Reason = '". $goalReason. "' WHERE GoalID = ". $goalID;
		
		return db_exec($query);
	}
	
	//获取对应类型的目标个数
	function get_goals_num($userID, $goalType, $isMe){	
		$query = "SELECT COUNT(*) as num\n"
				. "FROM goals\n"
				. "WHERE UserID = ". $userID. "\n"
				. "AND GoalType = '". $goalType ."'\n";

		if(!$isMe){
			$query .= "AND IsPublic = 1";
		}
		
		$result = db_exec($query);
		
		$num = $result->fetch_assoc();

		return $num['num'];
	}
	
	//检查 Goal 的所有权
	function check_goal_ownership($goalID, $userID){
		$query = "select * from goals where GoalID = ". $goalID. " and UserID = ". $userID;
		$result = db_exec($query);
		
		return ($result->num_rows > 0)? true: false;
	}
	
	//检查是否已经完成
	function check_goal_is_finished($goalID){
		$query = "select GoalType from goals where GoalID = ". $goalID;
		$result = db_exec($query);
		
		$row = $result->fetch_assoc();
		
		return $row['GoalType'] == "finish"? true: false;
	}
	
	//获取某个 Goal 的创建者信息
	function get_goal_owner($goalID){
		$query = "select users.Username, users.UserID from users, goals "
			. "where users.UserID = goals.UserID and goals.GoalID = ". $goalID;
		$result = db_exec($query);
		
		return $result->fetch_assoc();
	}
	
	//完成目标
	function finish_goal($goalID){
		$query = "UPDATE goals SET GoalType = 'finish', EndTime = NOW() WHERE GoalID = ". $goalID;
		
		$result = db_exec($query);
		return $result? "true": "false";
	}
	
	//放弃目标
	function drop_goal($goalID){
		$query = "DELETE FROM goals WHERE GoalID = ". $goalID;
		
		$result = db_exec($query);
		return $result? "true": "false";
	}
?>
