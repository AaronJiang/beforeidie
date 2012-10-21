<?php
	require_once('public_funs.php');

	//鼓励	
	function cheer($userID, $goalID){
		$query = "insert into goal_cheers (UserID, GoalID) values (". $userID. ", ". $goalID. ")";
		return db_exec($query);
	}
	
	//检测是否已经鼓励
	function check_goal_is_cheered($userID, $goalID){
		$query = "select * from goal_cheers where UserID = ". $userID. " and GoalID = ". $goalID;
		$result = db_exec($query);
		
		return ($result->num_rows > 0)? true: false;
	}

	//获取某 Goal 的鼓励数
	function get_goal_cheers_num($goalID){
		$query = "select count(*) as num from goal_cheers where GoalID = ". $goalID;
		$result = db_exec($query);
		$row = $result->fetch_assoc();
		return $row['num'];
	}
	
	//获取某 Goal 的鼓励者
	function get_goal_cheerers($goalID, $num){
		$query = "SELECT users.UserID, users.Username\n"
				. "FROM goal_cheers, users\n"
				. "WHERE goal_cheers.GoalID = ". $goalID ."\n"
				. "AND goal_cheers.UserID = users.UserID\n";
		
		if(isset($num)){
			$query .= "LIMIT 0, ". $num;
		}
		
		$result = db_exec($query);
		
		$rows = array();
		while($row = $result->fetch_assoc()){
			array_push($rows, $row);
		}
		
		return $rows;
	}
?>