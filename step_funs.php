<?php

	require_once('public_funs.php');

	//获取某个Goal的全部步骤
	function get_steps($goalID){
	
		$query = "select * from steps where GoalID = ". $goalID;
		$results = db_exec($query);
		
		$steps = array();
		while($row = $results->fetch_assoc()){
			array_push($steps, $row);
		}
		
		return $steps;
	}
	
	//新的步骤
	function new_step($goalID, $stepContent){
		$goalID = trim($goalID);
		$stepContent = trim($stepContent);
	
		$query = "insert into steps values (NULL, '". $goalID. "', 0, '". $stepContent. "', NULL)";
		$result = db_exec($query);
	
		return $result? "true": "false";
	}
	
	//更新步骤
	function update_step($stepID, $stepContent){
		$stepID = trim($stepID);
		$stepContent = trim($stepContent);
		
		$query = "update steps set StepContent = '". $stepContent. "' where StepID = ". $stepID;
		echo $query;
		$result = db_exec($query);
		
		return $result? "true": "false";
	}
	
	//删除步骤
	function delete_step($stepID){
		$stepID = trim($stepID);
		
		$query = "delete from steps where StepID = ". $stepID;
		$result = db_exec($query);
		
		return $result? "true": "false";
	}
	
	//获取步骤的数目
	function get_goal_steps_num($goalID){
		$query = "select count(*) from steps where GoalID = ". $goalID;
		$result = db_exec($query);
		
		$num = $result->fetch_assoc();

		return $num['count(*)'];
	}
?>