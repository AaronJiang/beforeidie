<?php
	require_once("data_funs.inc");
	
	//调度请求
	$proc = $_REQUEST['proc'];
	
	switch($proc){
		case "follow":
			follow_user($_REQUEST['followerID'], $_REQUEST['followeeID']);
			page_jump($_SERVER['HTTP_REFERER']);
			break;
			
		case "disfollow":
			disfollow_user($_REQUEST['followerID'], $_REQUEST['followeeID']);
			page_jump($_SERVER['HTTP_REFERER']);			
			break;
	}
	
?>