<?php
	require_once('data_funs.inc');
	require_once('html_helper.php');
	
	//全局变量 GOAL_ID
	global $GOAL_ID;
	$GOAL_ID = trim($_REQUEST['goalID']);

	//全局变量 GOAL
	global $GOAL;	
	$GOAL = get_goal_by_ID($GOAL_ID);
	
	html_output_authed_header($GOAL['Title'], 'page-goal-details');
	
	$isCreator = check_goal_ownership($GOAL_ID, $_SESSION['valid_user_id']);
?>

<script type="text/javascript">

$(document).ready(function(){
	//全局变量
	var GOAL_ID = <?php echo $_REQUEST['goalID'] ?>;
	
	//弹出回复框
	$('.cmd-new-comment').click(function(){
		var posterID = $(this).data('poster-id'),
			logID = $(this).data('log-id'),
			isRoot = $(this).data('is-root'),
			commentsNum = $(this).data('num-comments'),
			parentCommentID = isRoot? 0: $(this).data('parent-comment-id'),
			html = "";
		
		//构建 HTML 块
		if(isRoot && !commentsNum){
			html += "<div class='comment-new-form clearfix' style='margin-left:0px;'>";
		}
		else{
			html += "<div class='comment-new-form clearfix'>";
		}
		html += "<div class='comment-input' contenteditable='true'></div>"
			+ "<span class='comment-submit'>发表</span>"		
			+ "<span class='comment-cancel'>取消</span>"
			+ "</div>";
			
		//插入DOM
		$(html).appendTo($(this).parents('.log-item'))	
			.find('.comment-input')
				.focus() //聚焦
				.blur(function(){	//失焦则从DOM中删除
					if($.trim($(this).text()) == ""){
						$(this).parent().detach();
					}
				})
			.next()
				.click(function(){	//提交回复
					var comment = $(this).prev().text();
					$.ajax({
						url: 'comment_proc.php',
						type: 'post',
						data: {
							'proc': 'new',
							'comment': comment,
							'posterID': posterID,
							'logID': logID,
							'parentCommentID': parentCommentID,
							'isRoot': isRoot
						}
					});
					
					$(this).parent().detach();

					location.reload();
				})
			.next()	//取消回复
				.click(function(){
					$(this).parent().detach();	
				});
	});
	
	//若不是 Goal 创建者，则停止执行 js 代码
	var isCreator = <?php echo $isCreator? 1: 0; ?>;
	if(!isCreator){
		return;
	}

	//初始化 Goal 标题编辑框
	$('#dialog-edit-goal-title').dialog({
		autoOpen: false,
		modal: true,
		draggable: false,
		resizable: false,
		title: '编辑目标',
		width: 430,
		buttons: {
			'确定': function(){
				$('#form-edit-goal-title').submit();			
			},
			'取消': function(){
				$(this).dialog('close');
			}
		}
	});
	
	//打开 Goal 标题编辑框
	$('#cmd-edit-goal-title').click(function(){
		var goalTitle = $('#goal-title').text();
		$('#input-goal-title').val(goalTitle);
		$('#dialog-edit-goal-title').dialog('open');
	});
	
	//初始化 Goal 愿景
	$('#dialog-edit-goal-reason').dialog({
		autoOpen: false,
		modal: true,
		draggable: false,
		resizable: false,
		title: '编辑愿景',
		width: 430,
		buttons: {
			'确定': function(){
				$('#form-edit-goal-reason').submit();			
			},
			'取消': function(){
				$(this).dialog('close');
			}
		}
	});
	
	//打开 Goal 愿景编辑框
	$('#cmd-edit-goal-reason').click(function(){
		var goalReason = $('#goal-reason').text();
		$('#input-goal-reason').val(goalReason);
		$('#dialog-edit-goal-reason').dialog('open');
	});
	
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
		var logTitle = $(this).parent().parent().find('.log-title').first().text();
		$("#form-edit-log #log-title").val(logTitle);
		
		//内容
		var logContent = $(this).parent().parent().find('.log-content').first().text();
		$("#form-edit-log #log-content").val(logContent);
		
		$('#dialog-edit-log').dialog('open');
	});
	
	//记录删除警告框
	$('.log-cmd-delete').click(function(){
		if(!confirm("确定删除此记录？")){
			return false;
		}
	});
	
	//初始化步骤编辑框
	$("#dialog-edit-steps").dialog({
		autoOpen: false,
		modal: true,
		draggable: false,
		resizable: false,
		title: '调整步骤',
		width: 430,
		buttons: {
			'保存': function(){
				$('#goal-steps').empty();
			
				$('.step-edit-area').each(function(index){
					var text = $.trim($(this).text());
					
					if(text == ''){
						return true;	//若为空，则跳过此次循环
					}
					
					//若存在无步骤的警告标语，则去掉
					if($('#no-step-caution')[0]){
						$('#no-step-caution').remove();
					}
					
					var stepType = $(this).attr('data-type'),
						stepID = $(this).attr('data-stepid');					
					
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
								stepContent: text,
								stepIndex: index
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
								stepContent: text,
								stepIndex: index
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
						html += "<li>"
							+ "<div class='step-edit-area' data-type='original' data-stepid='" + entry.StepID +"' contenteditable='true'>" + entry.StepContent + "</div>"
							+ "<span class='delete-step-item'>删除</span>"
							+ "<span class='add-step-item'>增加</span>"
							+ "</li>";
					});
				}
				html += '</ul>';

				$('#dialog-edit-steps').html(html);
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

<!-- Goal Details -->
<div id='goal-details-panel'>

	<!-- Title -->
	<div id='goal-title-wap'>
		<span id='goal-title'><?php echo $GOAL['Title']; ?></span
		><span id='goal-title-underline'>_ _ _</span
		><a id='cmd-edit-goal-title'>修改</a>
			
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
			?>
			<a class='isFinished'>已完成</a>	
			<?php
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
			<a class='isCheered'>已鼓励</a>			
			<?php 
				}
			} ?>
		</div>
	</div>

	<!-- Reason -->	
	<?php 
		@html_out_panel_header('愿景', '修改', 'cmd-edit-goal-reason', '', $isCreator);
	?>
	
	<p id='goal-reason'><?php echo $GOAL['Reason']; ?></p>

	<!-- Steps -->
	<?php
		@html_out_panel_header('计划', '调整', 'cmd-edit-steps', '', $isCreator);
		$steps = get_steps($GOAL_ID);
		if(count($steps) == 0){
			echo "<p id='no-step-caution' style='margin:0 0 5px 5px;font-size:13px;'>还没有任何规划哦~</p>";
		} 
	?>
	
	<ul id='goal-steps'>
		<?php
		foreach($steps as $step){
			echo "<li>". $step['StepContent']. "</li>";
		} ?>
	</ul>

	<!-- Logs -->
	<?php
	@html_out_panel_header('记录', '添加', 'cmd-add-log', '', $isCreator);
	
	$logs = get_logs($GOAL_ID);

	if(count($logs) != 0){
		foreach($logs as $log){
			echo "<div class='log-item'>";
				//标题和内容
				if($log['LogTitle'] != ''){
					echo "<p class='log-title'>". $log['LogTitle']. "</p>";			
				}
				echo "<p class='log-content'>". $log['LogContent']. "</p>";
			
				//操作按钮
				echo "<div class='log-cmd-time-wap'>";
					$commentsNum = get_log_comments_num($log['LogID']);
					echo "<a class='small-cmd comment-cmd-new' 
							data-log-id='". $log['LogID']. "'
							data-poster-id='". $_SESSION['valid_user_id']. "'
							data-is-root='1'
							data-num-comments='". $commentsNum. "'
							>回复";
					if($commentsNum){
						echo "(". $commentsNum. ")";
					}
					echo "</a>";
			
					if($isCreator){
						echo "<a class='small-cmd log-cmd-edit' 
								data-log-id='". $log['LogID'] ."'>编辑</a>"
							. "<a class='small-cmd log-cmd-delete'
								href='log_proc.php?proc=delete&logID=". $log['LogID']. "'>删除</a>";
					}
					
					//时间
					echo "<p class='log-time'>". $log['LogTime']. "</p>"
				. "</div>";
			
				//回复
				html_output_comments($log['LogID']);
			echo "</div>";
		}
	}
	else {
		echo "<p style='font-size:13px;clear:both;'>还没有任何记录哦~</p>";
	}
	
	?>
</div>

<!-- 边栏 -->
<div id="goal-sidebar-panel">

	<!-- Creator -->
	<?php
		@html_out_panel_header('创建者');
		$goalOwner = get_goal_owner($GOAL_ID); 
	?>
	
	<a class='user-icon' href='person.php?userID=<?php echo $goalOwner['UserID'] ?>'  >
		<img src='<?php echo get_user_profile($goalOwner['UserID']) ?>' title='<?php echo $goalOwner['Username'] ?>' />
	</a>

	<!-- Cheerers -->	
	<?php
		$cheerers = get_goal_cheerers($GOAL_ID, 16);
		
		$numCheerers = count($cheerers);
		
		//若无鼓励者，则不显示此模块
		if($numCheerers != 0){
			@html_out_panel_header('鼓励者', '全部 ('.count($cheerers).')', 'cmd-all-cheerers', 'cheer_page_cheerers.php?goalID='.$GOAL_ID);
		
			foreach($cheerers as $cheerer){
				echo "<a href='person.php?userID=". $cheerer['UserID']. "'>"
						. "<img class='user-icon' src='". get_user_profile($cheerer['UserID']). "' title='". $cheerer['Username']. "' />"
					. "</a>";
			}
		}
	?>
</div>

<?php if($isCreator){ ?>

<!-- 编辑标题 -->
<div id='dialog-edit-goal-title'>
	<form id="form-edit-goal-title" action="goal_proc.php" method="post">
		<input type='text' id='input-goal-title' autocomplete='off' placeholder='标题' name='goalTitle'>	
		<input type="hidden" name="goalID" value="<?php echo $GOAL_ID ?>" />
		<input type="hidden" name="proc" value="update_goal_title" />
	</form>		
</div>

<!-- 编辑愿景 -->
<div id='dialog-edit-goal-reason'>
	<form id="form-edit-goal-reason" action="goal_proc.php" method="post">
		<textarea id='input-goal-reason' rows='2' autocomplete='off' placeholder='愿景' name='goalReason'></textarea>
		<input type="hidden" name="goalID" value="<?php echo $GOAL_ID ?>" />
		<input type="hidden" name="proc" value="update_goal_reason" />
	</form>	
</div>

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
	html_output_authed_footer();
?>