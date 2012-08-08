<?php
	require('header.php');
	require('data_funs.inc');
	
	$isCreator = check_goal_ownership($_REQUEST['goalID'], $_SESSION['valid_user_id']);
?>

<script type="text/javascript">

$(function(){
	//全局变量
	var GOAL_ID = <?php echo $_REQUEST['goalID'] ?>;
	
	var isCreator = <?php echo $isCreator ?>;
	if(!isCreator){
		return;
	}
	
	//初始化记录添加框
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
			if(!$isFinished){
		?>
		<span><a href='goal_proc.php?proc=finish&goalID=<?php echo $GOAL_ID ?>'>完成</a></span>
		<?php
			}
		//若不是所有者
		} else {
			$isFollowed = check_goal_is_followed($GOAL_ID, $_SESSION['valid_user_id']);
			//若已经关注
			if($isFollowed){	
		?>
		<span><a href='follower_proc.php?proc=disfollow&goalID=<?php echo $GOAL_ID ?>&followerID=<?php echo $_SESSION['valid_user_id'] ?>'>取消关注</a></span>
		<?php
			//若尚未关注
			} else {  ?>
		<span><a href='follower_proc.php?proc=follow&goalID=<?php echo $GOAL_ID ?>&followerID=<?php echo $_SESSION['valid_user_id'] ?>'>关注</a></span>
		<?php 
			}
		} ?>
		</div>
	</div>
</div>

<!-- Steps 和 Logs -->
<div id='goal-details-panel'>	
	
	<div class='panel-header'>
		<div class='panel-title'>计划</div>
		<?php if($isCreator){ ?>
		<div class='panel-cmd-wapper'>......（<span class='panel-cmd' id='cmd-edit-steps'>编辑</span>）</div>
		<?php } ?>
	</div>
	
	<?php
	$steps = get_steps($GOAL_ID);
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
		<?php if($isCreator){ ?>
		<div class='panel-cmd-wapper'>......（<span class='panel-cmd' id='cmd-add-log'>我说</span>）</div>
		<?php } ?>
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
			echo "<p class='log-time'>". $log['LogTime']. "</p>";
			echo "</div>";
		}
	}
	?>
</div>

<!-- 边栏 -->
<div id="goal-sidebar-panel">
	<?php if(!$isCreator){ 
		$goalOwner = get_goal_owner($GOAL_ID);
	?>
	<div class='panel-header'>
		<div class='panel-title'>创建者</div>
	</div>
	<p><a href='person.php?userID=<?php echo $goalOwner['UserID'] ?>'> <?php echo $goalOwner['Username'] ?> </a></p>
	<?php } ?>
	
	<div class='panel-header'>
		<div class='panel-title'>关注者</div>
	</div>

	<div class='panel-header'>
		<div class='panel-title'>关注它的人也关注了</div>
	</div>
	
	<div class='panel-header'>
		<div class='panel-title'>关注它的人的梦想</div>
	</div>

</div>

<?php if($isCreator){ ?>
<div id='dialog-edit-steps'></div>

<div id='dialog-add-log'>
	<form id="form-new-log" action="log_proc.php" method="post">
		<div>
			<input type='text' id='log-title' autocomplete='off' placeholder='标题（可不填）' name='logTitle'>
		</div>
		
		<div>
			<textarea id="log-content" autocomplete='off' placeholder="内容" rows="3" name="logContent"></textarea>
		</div>
		
		<input type="hidden" name="goalID" value="<?php echo $goalID ?>" />
		<input type="hidden" name="proc" value="new" />
	</form>	
</div>

<?php 
	}
	require('footer.php');	
?>