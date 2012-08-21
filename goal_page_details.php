<?php
	require('header.php');
	require('data_funs.inc');
	
	$isCreator = check_goal_ownership($_REQUEST['goalID'], $_SESSION['valid_user_id']);
?>

<script type="text/javascript">

$(document).ready(function(){
	//全局变量
	var GOAL_ID = <?php echo $_REQUEST['goalID'] ?>;
	
	var isCreator = <?php echo $isCreator? 1: 0; ?>;
	if(!isCreator){
		return;
	}
	
	//初始化记录增加框
	$('#dialog-add-log').dialog({
		autoOpen: false,
		modal: true,
		draggable: false,
		resizable: false,
		title: '记录点滴',
		width: 500,
		buttons: {
			'添加': function(){
				$('#form-new-log').submit();
			},
			'取消': function(){
				$(this).dialog('close');
			}
		}	
	});
	
	//打开记录增加框
	$('#cmd-add-log').click(function(){
		$('#dialog-add-log').dialog('open');
	});
	
	//初始化记录修改框
	$('#dialog-edit-log').dialog({
		autoOpen: false,
		modal: true,
		draggable: false,
		resizable: false,
		title: '编辑',
		width: 500,
		buttons: {
			'保存': function(){
				$('#form-edit-log').submit();
			},
			'取消': function(){
				$(this).dialog('close');
			}
		}	
	});
	
	//打开记录修改框
	$('.log-cmd-edit').click(function(){
		//ID
		var logID = $(this).data('log-id');
		$("#form-edit-log input[name='logID']").val(logID);
		//标题
		var logTitle = $(this).data('log-title');
		$("#form-edit-log #log-title").val(logTitle);
		//内容
		var logContent = $(this).data('log-content');
		$("#form-edit-log #log-content").val(logContent);
		
		$('#dialog-edit-log').dialog('open');
	});
	
	//记录删除警告框
	$('.log-cmd-delete').click(function(){
		if(!confirm("确定删除此记录？")){
			return false;
		}
	});
	
	//隐藏记录操作按钮
	$('.log-cmd').hide();
	
	//显示&隐藏记录操作按钮
	$('.log-item').hover(
		function(){
			$(this).find('.log-cmd').fadeIn('fast');
		}, 
		function(){
			$(this).find('.log-cmd').fadeOut('fast');	
		}
	);
	
	//初始化步骤编辑框
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
			type: 'POST',
			data: {
				proc: 'getSteps',
				goalID: GOAL_ID
			},
			dataType: 'json',
			async: false,	//使用同步 Ajax，解决对话框居中问题
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
	global $GOAL_ID;
	$GOAL_ID = trim($_REQUEST['goalID']);
	$goal = get_goal_by_ID($GOAL_ID);
?>

<!-- Title 和 Prospect -->
<div id='goal-title-panel'>
	<div>
		<p id='goal-details-title'> <?php echo $goal['Title']; ?> </p>
		<p id='goal-why'> <?php echo $goal['Reason']; ?> </p>
		
		<div id='goal-cmd-wap'>
			<?php
			//若为所有者
			if($isCreator){
				$isFinished = check_goal_is_finished($GOAL_ID);
				if(!$isFinished){	//若还未完成
			?>
			<a href='goal_proc.php?proc=finish&goalID=<?php echo $GOAL_ID ?>'>完成</a>
			<?php
				}
				else {	//若已经完成
				}
			} 
			else {	//若不是所有者
				$isCheered = check_goal_is_cheered($_SESSION['valid_user_id'], $GOAL_ID);
				if(!$isCheered){	//若还未鼓励
			?>
			<a href='cheer_proc.php?proc=cheer&userID=<?php echo $_SESSION['valid_user_id'] ?>&goalID=<?php echo $GOAL_ID ?>'>鼓励</a>
			<?php 
				} 
				else {	//若已经鼓励 ?>
			<a class='isCheered' href='#'>已鼓励</a>			
			<?php 
				}
			} ?>
		</div>
		
		<div id='goal-num-wap'>
			<div class='goal-num-item goal-num-item-border'>
				<div class='goal-num'><?php echo get_goal_steps_num($GOAL_ID) ?></div>
				<div>计划</div>
			</div
			
			><div class='goal-num-item goal-num-item-border'>
				<div class='goal-num'><?php echo get_goal_logs_num($GOAL_ID) ?></div>
				<div>记录</div>
			</div
			><div class='goal-num-item'>
				<div class='goal-num'><?php echo get_goal_cheers_num($GOAL_ID) ?></div>
				<div>鼓励</div>
			</div>
		</div>
	</div>
</div>

<!-- Steps 和 Logs -->
<div id='goal-details-panel'>	
	
	<div class='panel-header'>
		<div class='panel-title'>计划</div
		><div class='panel-cmd-wapper'>	
		<?php if($isCreator){ ?>
			<span>......（</span
			><span class='panel-cmd' id='cmd-edit-steps'>编辑</span
			><span>）<span>
		<?php } ?>
		</div>
	</div>
	
	<?php
	$steps = get_steps($GOAL_ID);
	if(count($steps) == 0){
		echo "<p id='no-step-caution' style='margin-bottom:5px;font-size:14px;'>还没有任何规划哦~</p>";
	} ?>
	
	<ul id='goal-steps'>
		<?php
		foreach($steps as $step){
			echo "<li>". $step['StepContent']. "</li>";
		} ?>
	</ul>
	
	<div class='panel-header panel-log-header'>
		<div class='panel-title'>记录</div
		><div class='panel-cmd-wapper'>
		<?php if($isCreator){ ?>
			<span>......（<span
			><span class='panel-cmd' id='cmd-add-log'>说说</span
			><span>）</span>
		<?php } ?>
		</div>
	</div>
	
	<?php
	$logs = get_logs($GOAL_ID);

	if(count($logs) == 0){
		echo "<p style='font-size:14px;clear:both;'>还没有任何记录哦~</p>";
	} else {
		foreach($logs as $log){
			echo "<div class='log-item'>";
			if($log['LogTitle'] != ''){
				echo "<p class='log-title'>". $log['LogTitle']. "</p>";			
			}
			echo "<p class='log-content'>". $log['LogContent']. "</p>";
			echo "<div class='log-cmd-time-wap'>";
			if($isCreator){
				echo "<a class='log-cmd log-cmd-edit' data-log-id=". $log['LogID'] ." data-log-title=". $log['LogTitle']. " data-log-content=". $log['LogContent']. ">编辑</a>";
				echo "<a class='log-cmd log-cmd-delete' href='log_proc.php?proc=delete&logID=". $log['LogID']. "'>删除</a>";
			}
			echo "<p class='log-time'>". $log['LogTime']. "</p>";
			echo "</div>";
			echo "</div>";
		}
	}
	?>
</div>

<!-- 边栏 -->
<div id="goal-sidebar-panel">
	<!-- 创建者 -->
	<?php if(!$isCreator){ 
		$goalOwner = get_goal_owner($GOAL_ID);
	?>
	<div class='panel-header'>
		<div class='panel-title'>创建者</div>
	</div>
	<a class='user-icon' href='person.php?userID=<?php echo $goalOwner['UserID'] ?>' title='<?php echo $goalOwner['Username'] ?>' >
		<img src='./imgs/gravatar-140.png' />
	</a>
	<?php } ?>
	
	<div class='panel-header'>
		<div class='panel-title'>活跃度</div>
	</div>
	
	<div class='panel-header'>
		<div class='panel-title'>鼓励的人</div>

	</div>
	
	<?php 
		$cheerers = get_goal_cheerers($GOAL_ID);
		foreach($cheerers as $cheerer){
			echo "<a class='user-icon' href='person.php?userID=". $cheerer['UserID']. "' title='". $cheerer['Username']. "'>"
					. "<img src='./imgs/gravatar-140.png' />"
				. "</a>";
		}
	?>
</div>

<?php if($isCreator){ ?>

<!-- 编辑步骤 -->
<div id='dialog-edit-steps'></div>

<!-- 添加记录 -->
<div id='dialog-add-log'>
	<form id="form-new-log" action="log_proc.php" method="post">
		<input type='text' id='log-title' autocomplete='off' placeholder='标题（可不填）' name='logTitle'>	
		<textarea id="log-content" autocomplete='off' placeholder="内容" name="logContent"></textarea>
		<input type="hidden" name="goalID" value="<?php echo $GOAL_ID ?>" />
		<input type="hidden" name="proc" value="new" />
	</form>	
</div>

<!-- 修改记录 -->
<div id='dialog-edit-log'>
	<form id="form-edit-log" action="log_proc.php" method="post">
		<input type='text' id='log-title' autocomplete='off' placeholder='标题（可不填）' name='logTitle'>
		<textarea id="log-content" autocomplete='off' placeholder="内容" name="logContent"></textarea>	
		<input type="hidden" name="logID" />
		<input type="hidden" name="proc" value="update" />
	</form>	
</div>

<?php 
	}
	require('footer.php');	
?>