{include file='../header.tpl' title='新的Goal' page='page-new-goal'}

{literal}
<script type="text/javascript">
	$(document).ready(function(){
	
		$('#form-new-goal').validationEngine();
	
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
{/literal}

<p class='subtitle'>设立新的 Goal</p>

<form id="form-new-goal" action="GoalC.php" method="post">
	<div>
		<input type="text" placeholder="写下你的目标" class='validate[required]' name="title" id="goal-title" autocomplete="off"/>
	</div>
	
	<div>
		<textarea rows="8" placeholder="简单地描绘一下你的愿景吧！" class='validate[required]' name="why" id="goal-why"></textarea>
	</div>
	
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
	
	<input type="hidden" name="act" value="newGoal" />
	<input type="hidden" name="userID" value='{$userID}' />
	
	<input type="submit" id="create-goal" value="添加" />
</form>

{include file='../footer.tpl'}