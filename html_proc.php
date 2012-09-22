<?php
	include_once('data_funs.inc');
	include_once('html_helper.php');
	
	$proc = $_REQUEST['proc'];
	
	switch($proc){
		case 'get_logs':
			html_output_logs($_REQUEST['goalID'], $_REQUEST['pageNum'], $_REQUEST['numPerPage'], $_REQUEST['isCreator']);
			break;
			
		case 'get_dynamics_others':
			html_output_dynamics_others($_REQUEST['userID'], $_REQUEST['pageIndex'], $_REQUEST['numPerPage']);
			break;
		
		case 'get_dynamics_me':
			html_output_dynamics_me($_REQUEST['userID'], $_REQUEST['pageIndex'], $_REQUEST['numPerPage']);
			break;
			
		case 'get_dyns_single':
			html_output_dynamics_single($_REQUEST['userID'], $_REQUEST['pageIndex'], $_REQUEST['numPerPage'], $_REQUEST['isMe']);
			break;
	}

?>