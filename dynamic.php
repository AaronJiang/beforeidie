<?php	require('header.php');	require_once('data_funs.inc');		if(!is_auth()){		page_jump('account_page_login.php');	}?><script type='text/javascript'>	$('body').prop('id', 'page-dynamic');</script><div id='dynamic-panel'><?php	$result = get_all_logs($_SESSION['valid_user_id']);		while($log = $result->fetch_assoc()){		echo "<div class='dynamic-item'>";		echo "<p><a class='dynamic-goal-creater' href='person.php?userID=". $log['UserID']. "'>". $log['Username']. "</a>";		echo " 在 ";		echo "<a href='goal_page_details.php?goalID=". $log['GoalID']. "' class='dynamic-goal-title'>". $log['Title']. "</a> 中写道：</p>";		echo "<p class='dynamic-content'>". $log['LogContent']. "</p>";		echo "<p class='dynamic-time'>". $log['LogTime']. "</p>";		echo "</div>";	}		require('footer.php');?></div><div id='dynamic-sidebar-panel'>	<div class='panel-header'>		<div class='panel-title'>我的关注</div>		<div class='panel-cmd-wapper'>......（<span class='panel-cmd' id='cmd-add-log'>管理</span>）</div>	</div>	<div class='panel-header'>		<div class='panel-title'>关注我的</div>	</div></div><?php	require('footer.php');?>