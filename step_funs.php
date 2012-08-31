<?php

	require_once('public_funs.php');

	//获取某个Goal的全部步骤
	function get_steps($goalID){
	
		$query = "SELECT * FROM steps WHERE GoalID = ". $goalID. "\n"
				. "Order by StepIndex ASC";
		$results = db_exec($query);
		
		$steps = array();
		while($row = $results->fetch_assoc()){
			array_push($steps, $row);
		}
		
		return $steps;
	}

	//新的步骤
	function new_step($goalID, $stepContent, $stepIndex){
		$goalID = trim($goalID);
		$stepContent = trim($stepContent);
	
		$query = "INSERT INTO steps (GoalID, StepContent, StepIndex)\n"
				. "VALUES ('". $goalID. "', '". $stepContent. "', '". $stepIndex. "')";
		$result = db_exec($query);

		return $result? "true": "false";
	}
	
	//更新步骤
	function update_step($stepID, $stepContent, $stepIndex){
		$stepID = trim($stepID);
		$stepContent = trim($stepContent);
		
		$query = "UPDATE steps\n"
				. "SET StepContent = '". $stepContent. "',\n"
				. "StepIndex = '". $stepIndex. "'\n"
				. "WHERE StepID = ". $stepID;
		echo $query;
		$result = db_exec($query);
		
		return $result? "true": "false";
	}
	
	//删除步骤
	function delete_step($stepID){
		$stepID = trim($stepID);
		
		$query = "DELETE FROM steps WHERE StepID = ". $stepID;
		$result = db_exec($query);
		
		return $result? "true": "false";
	}
	
	//获取步骤的数目
	function get_goal_steps_num($goalID){
		$query = "SELECT COUNT(*) as num FROM steps WHERE GoalID = ". $goalID;
		$result = db_exec($query);
		
		$num = $result->fetch_assoc();

		return $num['num'];
	}
?>