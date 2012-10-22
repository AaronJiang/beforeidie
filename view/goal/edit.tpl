{include file='../header.tpl' title='编辑Goal' page='page-edit-goal'}

{literal}
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
{/literal}

<p class='subtitle'>编辑 Goal</p>

<form id="form-edit-goal" action="GoalC.php" method="post">
	<div>
		<input type="text" name="title" class='validate[required]' id="goal-title" autocomplete="off" value="{$goal.Title}" />
	</div>
			
	<div>
		<textarea rows="8" name="why" class='validate[required]' id="goal-why">{$goal.Reason}</textarea>
	</div>
	
	<div style="display:{if $goal.GoalType == 'finish'}none{else}block{/if}">
		<select name="goalType" id="goal-type">
			<option value="now" {if $goal.GoalType == 'now'}selected='selected'{/if}>立即启动梦想</option>
			<option value="future" {if $goal.GoalType == 'future'}selected='selected'{/if}>在未来启动梦想</option>
			<option value="finish" style="display:none" {if $goal.GoalType == 'finish'}selected='selected'{/if}></option>
		</select>
		<input type="text" name="startTime" id="goal-starttime" value="{$goal.StartTime}" autocomplete="off"/>
	</div>

	<div>
		<select name="isPublic" id="goal-ispublic">
			<option value="1" {if $goal.IsPublic == 1} selected='selected'{/if}>公开</option>
			<option value="0" {if $goal.IsPublic == 0} selected='selected'{/if}>私密</option>
		</select>
	</div>

	<div>
		<input type="submit" value="确定" id="update-goal" />
	</div>
	
	<input type="hidden" name="goalID" value="{$goal.GoalID}">
	<input type="hidden" name="act" value="updateGoal">
</form>

{include file='../footer.tpl'}