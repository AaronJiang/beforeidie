<?php
	require('header.php');
	require('data_funs.inc');
?>

<script type="text/javascript">

$(function(){
	//全局变量
	var GOAL_ID = <?php echo $_REQUEST['goalID'] ?>;
	
	$("#dialog-edit-steps").dialog({
		autoOpen: false,
		modal: true,
		draggable: false,
		resizable: false,
		title: '编辑步骤',
		width: 430,
		buttons: {
			'保存': function(){
				$('#goal-steps').empty();
			
				$('.step-edit-area').each(function(index){
					var text = $.trim($(this).text());
					
					if(text == ''){
						return true;	//若为空，则跳过此次循环
					}
					
					var stepType = $(this).attr('data-type'),
						stepID = $(this).attr('data-stepid');
					
					//若存在无步骤的警告标语，则去掉
					if($('#no-step-caution')[0]){
						$('#no-step-caution').remove();
					}
					
					//更新页面中的步骤
					if(stepType != 'delete'){
						$('#goal-steps').append("<li>" + text + "</li>");
					}
					
					//修改步骤
					if(stepType == 'modified'){
						$.ajax({
							url: 'step_proc.php',
							data: {
								proc: 'update',
								stepID: stepID,
								stepContent: text
							}
						});
					}	//删除步骤
					else if(stepType == 'delete'){
						$.ajax({
							url: 'step_proc.php',
							data: {
								proc: 'delete',
								stepID: stepID
							}
						});
					}	//新增步骤
					else if(stepType == 'new'){
						$.ajax({
							url: 'step_proc.php',
							data: {
								proc: 'new',
								goalID: GOAL_ID,
								stepContent: text
							}
						});
					}
				});
				
				$(this).dialog('close');
			},
			'取消': function(){
				$(this).dialog('close');
			}
		}
	});
	
	//打开步骤编辑框
	$("#cmd-edit-steps").click(function(){
		$.ajax({
			url: 'step_proc.php',
			data: {
				proc: 'getSteps',
				goalID: GOAL_ID
			},
			dataType: 'json',
			async: false,	//使用同步 Ajax，以解决
			success: function(data){
				var html = "<ul id='step-edit-list'>";
				
				//若不存在步骤
				if(data.length == 0){
					html += "<li>";
					html += "<div class='step-edit-area' data-type='new' contenteditable='true'></div>";
					html += "<span class='delete-step-item'>删除</span>";
					html += "<span class='add-step-item'>增加</span>";
					html += "</li>";
				} else {	
					$.each(data, function(index, entry){
						html += "<li>";
						html += "<div class='step-edit-area' data-type='original' data-stepid='" + entry.StepID +"' contenteditable='true'>" + entry.StepContent + "</div>";
						html += "<span class='delete-step-item'>删除</span>";
						html += "<span class='add-step-item'>增加</span>"
						html += "</li>";
					});
				}
				
				html += '</ul>';

				$("#dialog-edit-steps").html(html);
			}
		});
		
		$("#dialog-edit-steps").dialog('open');
	});
	
	//删除步骤
	$('#step-edit-list .delete-step-item').live('click', function(){
		$(this).prev().attr('data-type', 'delete');
		$(this).parent().hide();
	});

	//增加步骤
	$('#step-edit-list .add-step-item').live('click', function(){
		var html = '';
		html += "<li>";
		html += "<div class='step-edit-area' data-type='new' contenteditable='true'></div>";
		html += "<span class='delete-step-item'>删除</span>";
		html += "<span class='add-step-item'>增加</span>"
		html += "</li>";
		$(this).parent().after(html);
	});

	//修改步骤
	$('#step-edit-list .step-edit-area').live('keydown', function(){
		var stepType = $(this).attr('data-type');
		if(stepType == 'original'){
			$(this).attr('data-type', 'modified');
		}
	});
});

</script>

<?php
	global $goalID;
	$goalID	= trim($_REQUEST['goalID']);
	$goal = get_goal_by_ID($goalID);
?>

<!-- 标题 -->
<div class='clearfix' id='goal-title-panel'>
	<div class='floatleft'>
		<h2 id='goal-details-title'> <?php echo $goal['Title']; ?> </h2>
		<p id='goal-why'> <?php echo $goal['Reason']; ?> </p>
	</div>
	<!--<span id='cmd-finish-goal'>我做到了！</span>-->
</div>

<!-- 步骤  -->
<div id='content-goal-steps'>		
	<div class='panel-header'>
		<div class='panel-title'>计划</div>
		<div class='panel-cmd-wapper'>......（<span class='panel-cmd' id='cmd-edit-steps'>编辑</span>）</div>
	</div>
	
	<?php
	$steps = get_steps($goalID);
	if(count($steps) == 0){
		echo "<p id='no-step-caution' style='margin-bottom:5px;font-size:14px;'>还没有任何规划哦~</p>";
	}
	?>
	
	<ul id='goal-steps'>
		<?php
		foreach($steps as $step){
			echo "<li>". $step['StepContent']. "</li>";
		}
		?>
	</ul>
	
	<div class='panel-header panel-log-header'>
		<div class='panel-title'>记录</div>
		<div class='panel-cmd-wapper'>......（<span class='panel-cmd' id='cmd-edit-steps'>记录</span>）</div>
	</div>
	
	<!--
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
	-->
	
	<?php
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

<!-- 记录 -->
<div id="content-goal-logs">
	

	
</div>

<div id='dialog-edit-steps'></div>

<?php
	require('footer.php');	
?>