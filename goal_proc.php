<?php
	
	require_once("data_funs.inc");
	
	//调度请求
	$proc = $_REQUEST['proc'];
	
	switch($proc){
		case "getGoals":	/* 返回数据格式为 json，专用于 ajax 远程调用 */
			$goals = get_goals($_REQUEST['goalType']);
			echo urldecode(json_encode(urlencodeAry($goals)));
			break;
		
		case "delete":
			delete_goal($_REQUEST['goalID']);
			break;
			
		case "new":
			new_goal($_REQUEST['title'], $_REQUEST['why'], $_REQUEST['goalType'], $_REQUEST['startTime']);
			page_jump('home.php?goalType='. $_REQUEST['goalType']);
			break;
			
		case "start":
			start_goal($_REQUEST['goalID']);
			page_jump('home.php?goalType=now');
			break;
			
		case "delay":
			delay_goal($_REQUEST['goalID'], $_REQUEST['startTime']);
			page_jump('home.php?goalType=future');
			break;
			
		case "update":
			update_goal($_REQUEST['goalID'], $_REQUEST['title'], $_REQUEST['why'], $_REQUEST['goalType'], $_REQUEST['startTime']);
			//page_jump($_SERVER['HTTP_REFERER']);
			page_jump('home.php?goalType='. $_REQUEST['goalType']);
			break;
	}
?>