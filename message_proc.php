<?php
	include_once('data_funs.inc');
	
	$proc = trim($_REQUEST['proc']);
	
	switch($proc){
		case "new":
			new_message($_REQUEST['message'], $_REQUEST['posterID'], $_REQUEST['receiverID']);
			page_jump_back();
			break;
	}

?>