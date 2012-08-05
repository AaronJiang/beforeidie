<?php
	require_once("data_funs.inc");
	
	$proc = trim($_REQUEST['proc']);
	
	switch($proc){
		case 'getSteps':
			$steps = get_steps($_REQUEST['goalID']);
			echo urldecode(json_encode(urlencodeAry($steps)));
			break;
			
		case 'update':
			echo update_step($_REQUEST['stepID'], $_REQUEST['stepContent']);
			break;
			
		case 'new':
			echo new_step($_REQUEST['goalID'], $_REQUEST['stepContent']);
			break;
			
		case 'delete':
			echo delete_step($_REQUEST['stepID']);
			break;
	}
	
?>