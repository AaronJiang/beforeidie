<?php
	require_once('data_funs.inc');
	require_once('html_helper.php');

 	$goal = get_goal_by_ID($_REQUEST['goalID']);
	
	html_output_authed_header("编辑：". $goal['Title'], 'page-edit-goal');
?>

<script type="text/javascript">
	$(document).ready(function(){
		$('#form-edit-goal').validationEngine();
	
		$('#goal-starttime').datepicker({
			changeMonth: true,
			changeYear: true,
			showOtherMonths: true,
			selectOtherMonths: true
		});
	
		if($('#goal-type')[0].selectedIndex == 1){
			$('#goal-starttime').show();
		}
		
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


<p class='subtitle'>编辑 Goal</p>

<form id="form-edit-goal" action="goal_proc.php" method="post">
	<div>
		<input type="text" name="title" class='validate[required]' id="goal-title" autocomplete="off" value="<?php echo $goal['Title']?>" />
	</div>
			
	<div>
		<textarea rows="8" name="why" class='validate[required]' id="goal-why"><?php echo $goal['Reason'] ?></textarea>
	</div>
	
	<div style="display:<?php echo $goal['GoalType'] == 'finish'? 'none': 'block' ?>">
		<select name="goalType" id="goal-type">
			<option value="now" <?php if($goal['GoalType'] == 'now') echo "selected='selected'";?>>立即启动梦想</option>
			<option value="future" <?php if($goal['GoalType'] == 'future') echo "selected='selected'";?>>在未来启动梦想</option>
			<option value="finish" style="display:none" <?php if($goal['GoalType'] == 'finish') echo "selected='selected'";?>></option>
		</select>
		<input type="text" name="startTime" id="goal-starttime" value="<?php echo $goal['StartTime'] ?>" autocomplete="off"/>
	</div>
	
	<div>
		<select name="isPublic" id="goal-ispublic">
			<option value="1" <?php if($goal['IsPublic'] == 1) echo "selected='selected'";?>>公开</option>
			<option value="0" <?php if($goal['IsPublic'] == 0) echo "selected='selected'";?>>私密</option>
		</select>
	</div>

	<div>
		<input type="submit" value="确定" id="update-goal" />
	</div>
	
	<input type="hidden" name="goalID" value="<?php echo $goal['GoalID'] ?>">
	<input type="hidden" name="proc" value="update">
</form>

<?php
	html_output_authed_footer();
?>