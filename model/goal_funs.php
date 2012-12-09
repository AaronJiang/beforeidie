<?php

	require_once('public_funs.php');

	//获取单个目标
	function get_goal_by_ID($goalID){
		$query = "SELECT * FROM goals WHERE GoalID = ". $goalID;
		$results = db_exec($query);
		return $results->fetch_assoc();	
	}
	
	//获取某用户的全部目标
	function get_goals($userID, $isMe){
		$query = "SELECT GoalID, Title, UserID\n"
				. "FROM goals\n"
				. "WHERE UserID = ". $userID. "\n";
		
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
		$sql = "SELECT GoalID, Title\n"
	    	. "FROM goals\n"
			. "WHERE goals.isPublic = 1\n"
			//. "AND goals.UserID != ". $userID. "\n"
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
	
	//新增目标
	function new_goal($userID, $title, $content, $isPublic){
		$title = trim($title);
		$reason = trim($content);
	
		if(!$title || !$content){
			echo "You have not enter all the required details!";
			exit;
		}
		
		if(!get_magic_quotes_gpc()){
			$title = addslashes($title);
			$content = addslashes($content);
		}
		
		$query = "INSERT INTO goals (UserID, Title, Content, IsPublic)\n"
				. "VALUES (". $userID. ", '". $title. "', '". $content. "', ". $isPublic. ")";
		
		$result = db_exec($query);
	}

	function update_goal($goalID, $title, $content){
		if(!get_magic_quotes_gpc()){
			$title = addslashes($title);
			$content = addslashes($content);
		}
		
		$query = "UPDATE goals SET Title = '". $title. "', Content = '". $content. "' WHERE GoalID = ". $goalID;

		ECHO $query;
		
		return db_exec($query);
	}
	
	//更新目标的题目
	function update_goal_title($goalID, $goalTitle){
		$query = "UPDATE goals SET Title = '". $goalTitle. "' WHERE GoalID = ". $goalID;
		return db_exec($query);
	}

	// 更新目标的内容
	function update_goal_content($goalID, $content){
		$query = "UPDATE goals SET Content = '". $content. "' WHERE GoalID = ". $goalID;
		return db_exec($query);
	}
	
	//检查 Goal 的所有权
	function check_goal_ownership($goalID, $userID){
		$query = "select * from goals where GoalID = ". $goalID. " and UserID = ". $userID;
		$result = db_exec($query);
		
		return ($result->num_rows > 0)? true: false;
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
