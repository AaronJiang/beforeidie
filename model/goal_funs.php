<?php

	require_once('public_funs.php');

	//获取单个目标
	function get_goal_by_ID($goalID){
		$query = "SELECT * FROM goals WHERE GoalID = ". $goalID;
		$results = db_exec($query);
		return $results->fetch_assoc();	
	}
	
	//获取某个用户的某种类型的全部目标
	function get_goals($userID, $isMe){
		$query = "SELECT a.GoalID, a.Title, a.Reason, a.UserID, IFNULL(b.logsNum, 0) as logsNum\n"
				. "FROM goals as a\n"
					. "LEFT JOIN\n"
					. "(SELECT GoalID, count(*) as logsNum FROM goal_logs GROUP BY GoalID) as b\n"
					. "ON a.GoalID = b.GoalID\n"
				. "WHERE a.UserID = ". $userID. "\n";
		
		if(!$isMe){
			$query .= "AND IsPublic = 1\n";
		}
		
		$results = db_exec($query);
		
		$array = array();
		while($row = $results->fetch_assoc()){
			array_push($array, $row);
		}
		
		return $array;
	}

	// 获取某用户的目标总数
	function get_goals_num($userID, $isMe){
		$query = "SELECT count(*) as goalsNum\n"
				. "FROM goals\n"
				. "WHERE goals.UserID = ". $userID. "\n";

		if(!$isMe){
			$query .= "IsPublic = 1\n";
		}


		$result = db_exec($query);
		$row = $result->fetch_assoc();

		return $row["goalsNum"];
	}
	
	//获取热门目标
	function get_hot_goals($userID){
		$sql = "SELECT goals.GoalID, goals.Title, goals.Reason\n"
	    	. "FROM goals\n"
			. "LEFT JOIN\n"
				. "(SELECT goal_logs.GoalID, COUNT(*) AS LogsNum\n"
				. "FROM goal_logs GROUP BY goal_logs.GoalID) AS c1\n"
			. "ON goals.GoalID = c1.GoalID\n"
			. "WHERE goals.isPublic = 1\n"
			//. "AND goals.UserID != ". $userID. "\n"
			. "ORDER BY c1.LogsNum\n"
			. "LIMIT 0, 20\n";
		
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
	function new_goal($userID, $title, $reason, $isPublic){
		$title = trim($title);
		$reason = trim($reason);
		$goalType = trim($goalType);
	
		if(!$title || !$reason){
			echo "You have not enter all the required details!";
			exit;
		}
		
		if(!get_magic_quotes_gpc()){
			$title = addslashes($title);
			$reason = addslashes($reason);
		}
		
		$query = "insert into goals (UserID, Title, Reason, CreateTime, IsPublic) ";
		$query .= "values (". $userID. ", '". $title. "', '". $reason. "', NOW(), ". $isPublic. ")";
		
		$result = db_exec($query);
		
		//return $result? mysql_insert_id(): 'false';
	}

	//更新目标
	function update_goal($goalID, $title, $reason, $isPublic){
		$goalID = trim($goalID);
		$title = trim($title);
		$reason = trim($reason);
	
		if(!$title || !$reason){
			echo "You have not enter all the required details!";
			exit;
		}
		
		if(!get_magic_quotes_gpc()){
			$title = addslashes($title);
			$reason = addslashes($reason);
		}
	
		$query = "update goals set Title = '". $title. "', Reason = '". $reason. "', UpdateTime = '". now_time(). "', IsPublic = ". $isPublic. " where GoalID = ". $goalID;
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
	
	//放弃目标
	function drop_goal($goalID){
		$query = "DELETE FROM goals WHERE GoalID = ". $goalID;
		$result = db_exec($query);
		
		return $result? "true": "false";
	}
?>
