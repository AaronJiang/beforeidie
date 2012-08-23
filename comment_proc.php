<?php
	require_once('data_funs.inc');

	$proc = trim($_REQUEST['proc']);
	
	switch($proc){
		case 'new':
			$isSucc = new_comment($_REQUEST['comment'], $_REQUEST['posterID'], $_REQUEST['parentID'], $_REQUEST['isRoot']);
			echo $isSucc? "true": "false";
			break;
	}

?>