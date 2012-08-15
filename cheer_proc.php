<?php
	require_once('data_funs.inc');

	$proc = trim($_REQUEST['proc']);
	
	switch($proc){
		case "cheer":
			cheer($_REQUEST['userID'], $_REQUEST['goalID']);
			page_jump_back();
			break;
	}
?>