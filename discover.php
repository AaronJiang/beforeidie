<?php	require('header.php');	require_once('data_funs.inc');		if(!is_auth()){		page_jump('account_page_login.php');	}?><script type='text/javascript'>$(document).ready(function(){	$('body').prop('id', 'page-discover');	//$('#discover-goal-type-list a').click(function(){});	//$('#discover-goal-type-list').addClass('');});</script><p class='subtitle'>发现他人的梦想</p><!--<ul id='discover-goal-type-list'>	<li><a>我猜</a></li>	<li><a>美食</a></li>	<li><a>编程</a></li>	<li><a>旅游</a></li>	<li><a>创业</a></li>	<li><a>读书</a></li>	<li><a>健康</a></li>	<li><a>家居</a></li>	<li><a>宠物</a></li></ul>--><?php	$userID = $_SESSION['valid_user_id'];		//获取热度较高的目标		$hotGoals = get_hot_goals($userID);		foreach($hotGoals as $goal){		$goalID = $goal['GoalID'];		$creator = get_goal_owner($goalID);				echo "<div class='discover-goal-item'>"				. "<p class='discover-goal-title'>"					. "<a href='goal_page_details.php?goalID=". $goalID. "'>". $goal['Title']. "</a>"				. "</p>"				. "<p class='discover-goal-reason'>". $goal['Reason']. "</p>"				. "<p class='discover-goal-creator'>By <a href='person.php?userID=". $creator['UserID']. "'>". $creator['Username']. "<a></p>"				. "<div class='goal-num-wap'>"					. "<span><b>". get_goal_steps_num($goalID). "</b> 规划</span>"					. " | "					. "<span><b>". get_goal_logs_num($goalID). "</b> 记录</span>"					. " | "					. "<span><b>". get_goal_cheers_num($goalID). "</b> 鼓励</span>"				. "</div>"			."</div>";	}?><?php	require('footer.php');?>