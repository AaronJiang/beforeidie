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
		$stepContent = trim($_POST['stepContent']);
	
		$query = "insert into steps values (NULL, '". $goalID. "', 0, '". $stepContent. "', NULL)";
		$result = db_exec($query);
	
		if(!$result){
			echo "Item was not added!";
		}
	}
?>