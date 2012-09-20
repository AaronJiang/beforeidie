<?php
	require_once("data_funs.inc");
	
	//调度请求
	$proc = $_REQUEST['proc'];
	
	switch($proc){
		case "getGoals":	/* 返回数据格式为 json，专用于 ajax 远程调用 */
			$goals = get_goals($_REQUEST['goalType'], $_REQUEST['userID']);
			echo urldecode(json_encode(urlencodeAry($goals)));
			break;
		
		case "delete":
			delete_goal($_REQUEST['goalID']);
			break;
			
		case "new":
			$goalID = new_goal($_REQUEST['userID'], $_REQUEST['title'], $_REQUEST['why'], $_REQUEST['goalType'], $_REQUEST['startTime'], $_REQUEST['isPublic']);
			//page_jump('goal_page_details.php?goalID='. $goalID);
			page_jump('home.php?goalType='. $_REQUEST['goalType']);
			break;
			
		case "start":
			start_goal($_REQUEST['goalID']);
			page_jump('home.php?goalType=now');
			break;
			
		case "delay":
			delay_goal($_REQUEST['goalID'], $_REQUEST['startTime']);
			page_jump('home.php');
			break;
			
		case "update":
			update_goal($_REQUEST['goalID'], $_REQUEST['title'], $_REQUEST['why'], $_REQUEST['goalType'], $_REQUEST['startTime'], $_REQUEST['isPublic']);
			page_jump('home.php?goalType='. $_REQUEST['goalType']);
			break;
		
		case "finish":
			$goalID = $_REQUEST['goalID'];
			new_log($_REQUEST['logTitle'], $_REQUEST['logContent'], 0, $goalID);
			finish_goal($goalID);
			page_jump_back();	
			break;
		
		case "drop":
			drop_goal($_REQUEST['goalID']);
			page_jump_back();
			break;
		
		case "update_goal_reason":
			update_goal_reason($_REQUEST['goalID'], $_REQUEST['goalReason']);
			page_jump_back();
			break;
			
		case "update_goal_title":
			update_goal_title($_REQUEST['goalID'], $_REQUEST['goalTitle']);
			page_jump_back();
			break;
	}
?>