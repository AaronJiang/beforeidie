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
<script type='text/javascript' src='js/goal-comment.js'></script>

<script type="text/javascript">

$(document).ready(function(){
	//全局变量
	var GOAL_ID = <?php echo $_REQUEST['goalID'] ?>,
		USER_ID = <?php echo $_SESSION['valid_user_id'] ?>,
		isCreator = <?php echo $isCreator? 1: 0 ?>;

	
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

	/* Edit Reason
	----------------------------------------------------*/
	
	//初始化 Goal 愿景
	$('#dialog-edit-goal-reason').dialog({
		autoOpen: false,
		modal: true,
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

	/* New Log
	----------------------------------------------------*/
	
	//初始化记录增加框
	$('#dialog-add-log').dialog({
		autoOpen: false,
		modal: true,
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

	/* Edit Log
	----------------------------------------------------*/
	
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
	$('.log-cmd-edit').live('click', function(){
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
	
	/* Finish Goal
	----------------------------------------------------*/
	
	//初始化 Goal 完成框
	$('#dialog-finish-goal').dialog({
		autoOpen: false,
		modal: true,
		resizable: false,
		title: '完成目标',
		width: 500,
		buttons: {
			'保存': function(){
				$('#form-finish-goal').submit();
			},
			'取消': function(){
				$(this).dialog('close');
			}
		}	
	});
	
	//打开 Goal 完成框
	$('#cmd-finish-goal').click(function(){
		var goalTitle = $('#goal-title').text();
		
		$('#dialog-finish-goal').dialog({
			'title': "祝贺你完成目标：" + goalTitle
		});
		
		$('#dialog-finish-goal').dialog('open');
		
		$("textarea[name='logContent']").focus();
	});
	
	//记录删除警告框
	$('.log-cmd-delete').live('click', function(){
		if(!confirm("确定删除此记录？")){
			return false;
		}
	});
	
	/* Edit Steps
	----------------------------------------------------*/
	
	//初始化计划编辑框
	$("#dialog-edit-steps").dialog({
		autoOpen: false,
		modal: true,
		draggable: false,
		resizable: false,
		title: '调整计划',
		width: 430,
		buttons: {
			'保存': function(){
				$('#steps-list').empty();
				
				var index = 0;
				
				$('.step-edit-area').each(function(){
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
						$('#steps-list').append("<li>" + text + "</li>");
					}
					
					//删除步骤
					if(stepType == 'delete'){
						$.ajax({
							url: 'step_proc.php',
							data: {
								proc: 'delete',
								stepID: stepID
							}
						});
					}
					//新增步骤
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
						index++;
					}
					//修改步骤
					else{	
						$.ajax({
							url: 'step_proc.php',
							data: {
								proc: 'update',
								stepID: stepID,
								stepContent: text,
								stepIndex: index
							}
						});
						index++;					
					}
				});
				
				$(this).dialog('close');
			},
			'取消': function(){
				$(this).dialog('close');
			}
		}
	});

	//打开计划编辑框
	$("#cmd-edit-steps").live('click', function(){
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
	
	//删除计划
	$('#step-edit-list .delete-step-item').live('click', function(){
		$(this).prev().attr('data-type', 'delete');
		$(this).parent().hide();
	});

	//增加计划
	$('#step-edit-list .add-step-item').live('click', function(){
		var html = '';
		html += "<li>";
		html += "<div class='step-edit-area' data-type='new' contenteditable='true'></div>";
		html += "<span class='delete-step-item'>删除</span>";
		html += "<span class='add-step-item'>增加</span>"
		html += "</li>";
		$(this).parent().after(html);
	});

	/* Pager
	----------------------------------------------------*/
	
	var PAGE_NUM = 1,	//当前页数
		TOTAL_PAGE_NUM = $('#total-page-num').text();	//总页数
		
	//加载函数
	function load_logs(pageNum){
		var data = {
			proc: 'get_logs',
			'goalID': GOAL_ID,
			'pageNum': PAGE_NUM,
			'isCreator': isCreator
		};
		$('#logs').load('html_proc.php', data, function(){
			$('#curr-page-num').text(PAGE_NUM);	
		});
	}
	
	//加载第一页
	load_logs(PAGE_NUM);
	
	//上一页
	$('#page-up').click(function(){
		if(PAGE_NUM <= 1)
			return;
		
		PAGE_NUM -=1; 
		load_logs(PAGE_NUM);
	});
	
	//下一页
	$('#page-down').click(function(){
		if(PAGE_NUM >= TOTAL_PAGE_NUM)
			return;
			
		PAGE_NUM += 1;
		load_logs(PAGE_NUM);
	})
});

</script>

<!-- Main Panel -->
<div id='main-panel'>

	<!-- Title -->
	<div id='title-wap'>
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
			<a id='cmd-finish-goal'>完成</a>
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
	<div id='reason-wap'>
		<?php 
		@html_out_panel_header('愿景', '修改', 'cmd-edit-goal-reason', '', $isCreator);
		?>
	
		<p id='goal-reason'><?php echo $GOAL['Reason']; ?></p>
	</div>

	<!-- Steps -->
	<div id='steps-wap'>
		<?php
		@html_out_panel_header('计划', '调整', 'cmd-edit-steps', '', $isCreator);
		$steps = get_steps($GOAL_ID);
		if(count($steps) == 0){
			echo "<p id='no-step-caution' style='margin:0 0 5px 5px;font-size:13px;'>还没有任何规划哦~</p>";
		} ?>
		
		<ul id='steps-list'>
			<?php
			foreach($steps as $step){
				echo "<li>". $step['StepContent']. "</li>";
			} ?>
		</ul>
	</div>
	
	<!-- Logs -->
	<div id='logs-wap'>
		<?php
		@html_out_panel_header('记录', '添加', 'cmd-add-log', '', $isCreator);
		
		//总页数
		$logsSum = get_goal_logs_num($GOAL_ID);
		$pageSum = ($logsSum == 0)? 1: floor(($logsSum + 19) / 20);
		?>
		
		<div id='logs-pager'>
			<span id='curr-page-num'>1</span>
			<span>/</span>
			<span id='total-page-num'><?php echo $pageSum ?></span>
			<a id='page-up' >上页</a
			><a id='page-down'>下页</a>
		</div>

		<div id='logs'></div>
	</div>
</div>

<!-- Sidebar Panel -->
<div id="sidebar-panel">

	<!-- Creator -->
	<div id='creator-wap'>
	<?php
		@html_out_panel_header('创建者');
		$goalOwner = get_goal_owner($GOAL_ID); 
	?>
		
		<a class='user-icon' href='person.php?userID=<?php echo $goalOwner['UserID'] ?>'  >
			<img src='<?php echo get_user_profile($goalOwner['UserID']) ?>' title='<?php echo $goalOwner['Username'] ?>' />
		</a>
	</div>

	<!-- Cheerers -->
	<div id='cheerers-wap'>
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
		<input type='text' id='log-title' autocomplete='off' placeholder='标题（可不填）' name='logTitle' />	
		<textarea id="log-content" autocomplete='off' placeholder="内容" name="logContent"></textarea>
		<input type="hidden" name="goalID" value="<?php echo $GOAL_ID ?>" />
		<input type="hidden" name="typeID" value="1" />
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

<!-- 完成Goal -->
<div id='dialog-finish-goal'>	
	<p id='period'>从 <?php echo $GOAL['StartTime']. ' 至 '. now_date() ?></p>

	<form id='form-finish-goal' action='goal_proc.php' method='post'>
		<input type='text' value='完结篇' name='logTitle' />
		<textarea rows='10' placeholder='写点神马作为完结篇吧，比如感受啊，给他人的建议啊之类的' name='logContent'></textarea>
		<input type='hidden' name='goalID' value='<?php echo $GOAL_ID ?>' />
		<input type='hidden' name='proc' value='finish' />
	</form>
</div>

<?php 
	}
	html_output_authed_footer();
?>