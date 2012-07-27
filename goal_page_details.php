<?php
	require('header.php');
	require('data_funs.inc');
?>

<?php
	global $goalID;
	$goalID	= trim($_GET['goalID']);
	
	$goal = get_goal_by_ID($goalID);

	//Goal 标题
	echo "<h2 id='goal-details-title'>". $goal['Title']. "</h2>";
?>

<?php
	//Goal 愿景
	echo "<div id='content-goal-details'>";
	echo "<p class='subTitle'>愿景</p>";
	echo "<p id='goal-why'>". $goal['Reason']. "</p>";
	
	// Goal 步骤
	echo "<div class='subTitle'>步骤</div>";
	
	$steps = get_steps($goalID);
	if(count($steps) == 0){
		echo "<p style='margin-bottom:5px;font-size:14px;'>还没有任何规划哦~</p>";
	}
	
	echo "<ul id='goal-steps'>";
	foreach($steps as $step){
		echo "<li>". $step['StepContent']. "</li>";
	}
	echo "</ul>";
	
	echo "</div>";
?>

<!-- 右面板 -->
<div id="content-goal-logs">
	
	<div class='subTitle'>动态</div>
	
	<ul id="mode-links">
		<li><a id="mode-sound" href="#">视频</a></li>
		<li><a id="mode-img" href="#">图片</a></li>
		<li><a id="mode-text" href="#">文字</a></li>
	</ul>
	
	<form id="form-new-log" action="log_proc.php" method="post">
		<div>
			<textarea id="log-content" placeholder="说点啥~" rows="3" name="logContent"></textarea>
		</div>
		
		<div>
			<input type="submit" id="create-log" value="发表" />
		</div>
		
		<input type="hidden" name="goalID" value="<?php echo $goalID ?>" />
		<input type="hidden" name="proc" value="new" />
	</form>
	
	<?php
	
	//显示动态
	$logs = get_logs($goalID);

	if(count($logs) == 0){
		echo "<p style='font-size:14px;clear:both;'>还没有任何记录哦~</p>";
	} else {
		foreach($logs as $log){
			echo "<div class='log-item'>";
			echo "<p class='log-content'>". $log['LogContent']. "</p>";
			echo "<p class='log-time'>". $log['LogTime']. "</p>";
			echo "</div>";
		}
	}
	?>
	
</div>

<?php
	require('footer.php');	
?>