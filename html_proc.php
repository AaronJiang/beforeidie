<?php
	include_once('data_funs.inc');
	include_once('html_helper.php');
	
	$act = $_REQUEST['act'];
	
	switch($act){
		case 'getLogs':
			$logs = get_logs($_REQUEST['goalID'], $_REQUEST['pageNum'], $_REQUEST['numPerPage']);
			html_output_logs($logs, $_REQUEST['isCreator']);
			break;
			
		case 'get_dynamics_others':
			$dyns = get_followee_dynamics($_REQUEST['userID'], $_REQUEST['pageIndex'], $_REQUEST['numPerPage']);
			html_output_dynamics_others($dyns, $_REQUEST['userID']);
			break;
		
		case 'get_dynamics_me':
			$dyns = get_dynamics_about_me($_REQUEST['userID'], $_REQUEST['pageIndex'], $_REQUEST['numPerPage']);
			html_output_dynamics_me($dyns);
			break;
			
		case 'get_dyns_single':
			$dyns = get_single_dynamics($_REQUEST['userID'], $_REQUEST['pageIndex'], $_REQUEST['numPerPage']);
			html_output_dynamics_single($dyns, $_REQUEST['isMe']);
			break;
	}

?>