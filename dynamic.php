<?php	require('header.php');	require_once('data_funs.inc');		if(!is_auth()){		page_jump('account_page_login.php');	}?><script type='text/javascript'>	$('body').prop('id', 'page-dynamic');</script>	<?php	$result = get_all_logs($_SESSION['valid_user_id']);		while($log = $result->fetch_assoc()){		echo "<div class='dynamic-item'>";		echo "<p>在 <a href='goal_page_details.php?goalID=". $log['GoalID']. "' class='dynamic-goal-title'>". $log['Title']. "</a> 中写道：</p>";		echo "<p class='dynamic-content'>". $log['LogContent']. "</p>";		echo "<p class='dynamic-time'>". $log['LogTime']. "</p>";		echo "</div>";	}		require('footer.php');?>