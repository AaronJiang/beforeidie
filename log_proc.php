<?php
	require_once("data_funs.inc");

	//调度请求
	$proc = $_REQUEST['proc'];
	
	switch($proc){
		case "get_logs":
			$logs = get_logs($_REQUEST['goalID'], $_REQUEST['pageNum'], $_REQUEST['numPerPage']);
			echo urldecode(json_encode(urlencodeAry($logs)));
			break;
			
		case "delete":
			delete_log($_REQUEST['logID']);
			page_jump_back();
			break;
			
		case "new":
			$logTitle = isset($_REQUEST['logTitle'])? $_REQUEST['logTitle']: '';
			new_log($logTitle, $_REQUEST['logContent'], $_REQUEST['goalID']);
			update_goal_updatetime($_REQUEST['goalID'], now_time());
			page_jump_back();
			break;
			
		case "update":
			update_log($_REQUEST['logID'], $_REQUEST['logTitle'], $_REQUEST['logContent']);
			page_jump_back();
			break;
	}
?>