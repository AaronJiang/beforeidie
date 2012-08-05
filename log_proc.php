<?php
	require_once("data_funs.inc");

	//调度请求
	$proc = $_REQUEST['proc'];
	
	switch($proc){
		case "delete":
			break;
			
		case "new":
			$logTitle = isset($_REQUEST['logTitle'])? $_REQUEST['logTitle']: '';
			new_log($logTitle, $_REQUEST['logContent'], $_REQUEST['goalID']);
			update_goal_updatetime($_REQUEST['goalID'], now_time());
			page_jump($_SERVER['HTTP_REFERER']);
			break;
	}
?>