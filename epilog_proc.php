<?php
	require_once('data_funs.inc');
	
	$proc = $_REQUEST['proc'];
	
	switch($proc){
		case 'update':
			update_epilog($_REQUEST['goalID'], $_REQUEST['feel'], $_REQUEST['howTo'], $_REQUEST['advice']);
			page_jump('goal_page_details.php?goalID='. $goalID);
			break;
	}

?>