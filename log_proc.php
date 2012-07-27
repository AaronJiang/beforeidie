<?php
	require_once("public_funs.php");
	require_once("data_funs.inc");

	//调度请求
	$proc = $_REQUEST['proc'];
	
	switch($proc){
		case "delete":
			break;
			
		case "new":
			new_log($_REQUEST['logContent'], $_REQUEST['goalID']);
			update_goal_updatetime($_REQUEST['goalID'], now_time());
			page_jump($_SERVER['HTTP_REFERER']);
			break;
	}
?>