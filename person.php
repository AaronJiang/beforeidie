<?php
	require('header.php');
	require_once('data_funs.inc');
	
	$userID = $_REQUEST['userID'];
?>

<div id='person-page'>
	<!-- 用户信息 -->
	<div id='user-info-panel' class='clearfix'>
		<img id='user-profile' src='./imgs/gravatar-140.png' />
		<div id='user-info-wap'>
			<span id='user-name'> <?php echo get_username_by_id($userID); ?> </span>
		</div>
	</div>
	
	<!-- 用户的 Goals -->
	<div id='goals-panel'>
		<?php
		function goal_html_output($userID, $type){
			$goals = get_goals($userID, $type);
			foreach($goals as $goal){
				$goalID = $goal['GoalID'];
				echo "<div class='goal-item goal-item-". $type ."'>"
						."<p class='goal-title'><a href='goal_page_details.php?goalID=". $goalID. "'>". $goal['Title']. "</a></p>"
						."<p class='goal-reason'>". $goal['Reason']. "</p>"
						. "<div class='goal-num-wap'>"
							. "<span><b>". get_goal_steps_num($goalID). "</b> 规划</span>"
							. " | "
							. "<span><b>". get_goal_logs_num($goalID). "</b> 记录</span>"
						. "</div>"
						. "<div class='goal-cmd-wap'>"
							."<a class='goal-cmd'>赞</a>"
						. "</div>"
					. "</div>";
			}
		} ?>
		
		<ul id='goal-wap-header'>
			<li><a href='person.php?userID=<?php echo $userID ?>&goalType=now'>进行中 [<?php echo get_goal_num($userID, 'now'); ?>]</a></li
			><li><a href='person.php?userID=<?php echo $userID ?>&goalType=future'>待启动 [<?php echo get_goal_num($userID, 'future'); ?>]</a></li
			><li><a href='person.php?userID=<?php echo $userID ?>&goalType=finish'>已完成 [<?php echo get_goal_num($userID, 'finish'); ?>]</a></li>
		</ul>
		
		<div class='goal-wap'>
			<?php 
			$goalType = isset($_REQUEST['goalType'])? $_REQUEST['goalType']: 'now';		
			goal_html_output($userID, $goalType) ?>
		</div>
	</div>

	<!-- 用户的个人动态 -->	
	<div id="personal-dynamics-panel">
		<p id='dynamic-header'>个人动态</p>
		
		<?php
		$dynamics = get_all_logs($userID);
		foreach($dynamics as $dyn){
			echo "<div class='dynamic-item'>"
					. "<p class='dynamic-goal-title'>在 <b><a href=goal_page_details.php?goalID=". $dyn['GoalID'] .">". $dyn['Title']. "</b></a> 中写道:</p>"
					. "<p class='dynamic-content'>". $dyn['LogContent']. "</p>"
					. "<p class='dynamic-time'>". $dyn['LogTime']. "</p>"
				. "</div>";
		}
		?>
	</div>
</div>
<?php
	require('footer.php');
?>