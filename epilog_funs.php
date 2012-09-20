<?php
	require_once('public_funs.php');
	
	//增加某 Goal 的结语
	function add_epilog($goalID, $feel, $howTo, $advice){
		$query = "INSERT INTO goal_epilog (GoalID, Feel, HowTo, Advice)\n"
				. "VALUES ('". $goalID. "', '". $feel. "', '". $howTo. "', '". $advice. "')";
		return db_exec($query);
	}
	
	//修改某 Goal 的结语
	function update_epilog($goalID, $feel, $howTo, $advice){
		$query = "UPDATE goal_epilog\n"
				. "SET Feel = '". $feel. "', HowTo = '". $howTo. "', Advice = '". $advice. "'\n"
				. "WHERE GoalID = ". $goalID;
		return db_exec($query);
	}
	
	//获取某 Goal 的结语
	function get_epilog($goalID){
		$query = "SELECT * FROM epilog WHERE GoalID = ". $goalID;
		$result = db_exec($query);
		return $result->fetch_assoc();
	}
?>