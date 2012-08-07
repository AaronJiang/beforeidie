<?php
	require('header.php');
	require_once('data_funs.inc');
	
	if(!is_auth()){
		page_jump('account_page_login.php');
	}
?>

<script type="text/javascript">
	$(document).ready(function(){
		$('body').prop('id', 'page-newgoal');
	
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

<form id="form-new-goal" action="goal_proc.php" method="post">
	<div>
		<!--<label for="goal-title">目标：</label>-->
		<input type="text" placeholder="写下你的目标" name="title" id="goal-title" autocomplete="off"/>
	</div>
	
	<div>
		<!--<label for="goal-why">愿景：</label>-->
		<textarea rows="8" placeholder="用几句话描绘一下你的愿景吧！" name="why" id="goal-why"></textarea>
	</div>
	
	<div>
		<!--<label for="goal-type">启动：</label>-->
		<select name="goalType" id="goal-type">
			<option value="now">立即启动梦想</option>
			<option value="future">在未来启动梦想</option>
		</select>
		<input type="text" name="startTime" id="goal-starttime" autocomplete="off"/>
	</div>
	
	<div>
		<select id='goal-ispublic' name='isPublic'>
			<option value='1'>公开</option>
			<option value='0'>私密</option>
		</select>
	<div>
	
	<input type="hidden" name="proc" value="new"/>
	<input type="hidden" name="userID" value=<?php echo $_SESSION['valid_user_id']; ?>>
	
	<input type="submit" id="create-goal" value="添加" />

</form>

<?php
	require('footer.php');
?>