<?php
	include_once('data_funs.inc');
	include_once('html_helper.php');
	
	$proc = $_REQUEST['proc'];
	
	switch($proc){
		case 'get_logs':
			html_output_logs($_REQUEST['goalID'], $_REQUEST['pageNum'], $_REQUEST['isCreator']);
			break;
			
		case 'get_dynamics':
		
			break;
		
	}

?>