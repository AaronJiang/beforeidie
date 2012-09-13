<?php
	require_once('data_funs.inc');
	
	$mailSubject = '[Goal意见反馈]';
	
	session_start();
	$mailContent = "<h1 style='margin:0 0 10px 0;font-size:15px'>"
					. "<a href='http://localhost/Dream/person.php?userID=". $_SESSION['valid_user_id']. "'>"
						. $_SESSION['valid_user']
					. "</a>"
					. " 说："
				. "</h1>";
	
	if(trim($_REQUEST['feedbackSubject']) != ""){
		$mailContent .= "<p style='margin:0 0 10px 0;font-size:16px;font-weight:bold;font-family:微软雅黑;'>". $_REQUEST['feedbackSubject']. "</p>";
	}
	
	$mailContent .= "<p style='margin:0;'>". $_REQUEST['feedbackContent']. "</p>";
	
	send_email('hustlzp@qq.com', $mailSubject, $mailContent);
	page_jump_back();

?>