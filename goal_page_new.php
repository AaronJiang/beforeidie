<?php
	require_once('data_funs.inc');
	require_once('html_helper.php');
	html_output_authed_header('设立新的Goal', 'page-new-goal');
?>

<script type="text/javascript">
	$(document).ready(function(){
	
		$('#goal-starttime').datepicker({
			changeMonth: true,
			changeYear: true,
			showOtherMonths: true,
			selectOtherMonths: true
		});
	
		$('#goal-type').change(function(){
			var $time = $('#goal-starttime');
			if(this.selectedIndex == 1){
				$time.fadeIn('fast');
				$('#goal-starttime').datepicker('show');
			}
			else{
				$time.fadeOut('fast');
			}
		});
	});
</script>

<p class='subtitle'>设立新的 Goal</p>

<form id="form-new-goal" action="goal_proc.php" method="post">
	<input type="text" placeholder="写下你的目标" name="title" id="goal-title" autocomplete="off"/>
	
	<textarea rows="8" placeholder="用几句话描绘一下你的愿景！" name="why" id="goal-why"></textarea>
	
	<div>
		<select name="goalType" id="goal-type">
			<option value="now">立即启动</option>
			<option value="future">在未来启动</option>
		</select>
		<input type="text" name="startTime" id="goal-starttime" autocomplete="off"/>
	</div>
	
	<div>
		<select id='goal-ispublic' name='isPublic'>
			<option value='1'>公开</option>
			<option value='0'>私密</option>
		</select>
	</div>
	
	<input type="hidden" name="proc" value="new"/>
	<input type="hidden" name="userID" value=<?php echo $_SESSION['valid_user_id']; ?>>
	
	<input type="submit" id="create-goal" value="添加" />
</form>

<?php
	require('footer.php');
?>