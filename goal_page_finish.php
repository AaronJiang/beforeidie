<?php
	require_once('data_funs.inc');
	require_once('html_helper.php');
	
	//全局变量 GOAL_ID
	$goalID = trim($_REQUEST['goalID']);

	//全局变量 GOAL
	$goal = get_goal_by_ID($goalID);
	
	html_output_authed_header('完成'.$goal['Title'], 'page-finish-goal');
?>

<p class='subtitle'>祝贺你完成目标 <?php echo $goal['Title'] ?>！</p>

<p id='period'>从 <?php echo $goal['StartTime']. ' 至 '. now_date() ?></p>

<form id='form-finish-goal' action='goal_proc.php' method='post'>
	<textarea rows='5' placeholder='说说你的感受' name='feel'></textarea>
	<textarea rows='5' placeholder='你是如何做到的？' name='howTo'></textarea>
	<textarea rows='5' placeholder='你有什么建议吗？（可不填）' name='advice'></textarea>
	
	<input type='hidden' name='goalID' value='<?php echo $goalID ?>' />
	<input type='hidden' name='proc' value='finish' />
	
	<input type='submit' value='提交' />	
	<input type='button' class='cancel' value='取消' />
</form>

<?php
	html_output_authed_footer();
?>