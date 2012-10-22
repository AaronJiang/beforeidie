{include file='../header.tpl' title="{$goal.Title}" page='page-goal-details'}

<script type='text/javascript' src='../js/goal-comment.js'></script>
<script type="text/javascript">

$(document).ready(function(){
	//全局变量
	var GOAL_ID = {$goal.GoalID},
		USER_ID = {$userID};

	/* Pager
	----------------------------------------------------*/
	
	var PAGE_NUM = 1,	//当前页数
		NUM_PER_PAGE = 20,
		TOTAL_PAGE_NUM = $('#total-page-num').text(),	//总页数
		isCreator = {$isCreator};

	{literal}	
	//加载函数
	function load_logs(pageNum){
		var data = {
			act: 'getLogs',
			'goalID': GOAL_ID,
			'pageNum': pageNum,
			'numPerPage': NUM_PER_PAGE,
			'isCreator': isCreator
		};
		
		$('#logs').load('../html_proc.php', data, function(){
			$('#curr-page-num').text(pageNum);	
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
	});
	
	//若不是 Goal 创建者，则停止执行 js 代码
	if(!isCreator){
		return;
	}

	/* Edit Title
	----------------------------------------------------*/
	
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
		
		$('#form-edit-goal-title').validationEngine({
			promptPosition: 'topLeft',
			scroll: false
		});
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
		
		$('#form-edit-goal-reason').validationEngine({
			promptPosition: 'topLeft',
			scroll: false
		});
	});

	/* New Log
	----------------------------------------------------*/
	
	//初始化记录增加框
	$('#dialog-new-log').dialog({
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
		$('#dialog-new-log').dialog('open');
		
		//验证表单
		$('#form-new-log').validationEngine({
			promptPosition: 'topLeft',
			scroll: false
		});
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
		
		$('#form-edit-log').validationEngine({
			promptPosition: 'topLeft',
			scroll: false
		});
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
		
		$('#form-finish-goal').validationEngine({
			promptPosition: 'topLeft',
			scroll: false
		});
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
		width: 450,
		buttons: {
			'保存': function(){
				//清空步骤 List
				$('#steps-list').empty();
				
				var index = 0;
				
				$('.step-edit-area').each(function(){
					var text = $.trim($(this).text()),
						stepType = $(this).attr('data-type');
					
					//若为空，则跳过此次循环
					if(text == '' && stepType != 'original'){
						return true;
					}

					//若存在无步骤的警告标语，则去掉
					if($('#no-step-caution')[0]){
						$('#no-step-caution').remove();
					}
					
					var	stepID = $(this).attr('data-stepid'),
						needDelete = (stepType == 'delete') || ((stepType == 'original') && (text == ''));
					
					//更新页面中的步骤
					if(!needDelete){
						$('#steps-list').append("<li>" + text + "</li>");
					}
					
					//删除步骤
					if(needDelete){
						$.ajax({
							url: 'GoalC.php',
							data: {
								act: 'deleteStep',
								stepID: stepID
							}
						});
					}
					//新增步骤
					else if(stepType == 'new'){
						$.ajax({
							url: 'GoalC.php',
							data: {
								act: 'newStep',
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
							url: 'GoalC.php',
							data: {
								act: 'updateStep',
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
			url: 'GoalC.php',
			type: 'POST',
			data: {
				act: 'getSteps',
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
							+ "<span class='delete-step-item' data-type='original'>删除</span>"
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
	{/literal}
});

</script>

<!-- Main Panel -->
<div id='main-panel'>

	<!-- Title -->
	<div id='title-wap'>
		<span id='goal-title'>{$goal.Title}</span>
		{if $isCreator}
		<span id='goal-title-underline'>_ _ _</span>
		<a id='cmd-edit-goal-title'>修改</a>
		{/if}
		
		<div id='goal-cmd-wap'>	
		{if $isCreator}
			{if $isFinished}
			<a class='isFinished'>已完成</a>
			{else}
			<a id='cmd-finish-goal'>完成</a>
			{/if}
		{else}
			{if $isCheered}
			<a class='isCheered'>已鼓励</a>
			{else}
			<a href="CheerC.php?act=cheer&userID={$userID}&goalID={$goal.GoalID}">鼓励</a>
			{/if}
		{/if}
		</div>
	</div>

	<!-- Reason -->
	<div id='reason-wap'>
		{include file='../panel_header.tpl' 
			title='愿景'
			cmd='修改'
			cmdID='cmd-edit-goal-reason'
			isCreator="$isCreator"
		}
		<p id='goal-reason'>{$goal.Reason}</p>
	</div>

	<!-- Steps -->
	<div id='steps-wap'>
		{include file='../panel_header.tpl'
			title='计划'
			cmd='调整'
			cmdID='cmd-edit-steps'
			isCreator="$isCreator"
		}
		
		{if $stepsNum == 0}
		<p id='no-step-caution' style='margin:0 0 5px 5px;font-size:13px;'>还没有任何规划哦~</p>
		{/if}
		
		<ul id='steps-list'>
			{foreach $steps as $step}
			<li>{$step.StepContent}</li>
			{/foreach}
		</ul>
	</div>
	
	<!-- Logs -->
	<div id='logs-wap'>
		{include file='../panel_header.tpl'
			title='记录'
			cmd='添加'
			cmdID='cmd-add-log'
			isCreator="$isCreator"
		}
		
		<div id='logs-pager'>
			<span id='curr-page-num'>1</span>
			<span>/</span>
			<span id='total-page-num'>{$pagesNum}</span>
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
		{include file='../panel_header.tpl'
			title='创建者'
		}
		
		<a class='user-icon' href="PersonC.php?act=person&userID={$creator.UserID}">
			<img src="{$creatorAvatar}" title="{$creator.Username}" />
		</a>
	</div>

	<!-- Cheerers -->
	{if $cheerersNum != 0}
		{include file='../panel_header.tpl'
			title='鼓励者'
			cmd="全部 ($cheerersNum)"
			cmdID='cmd-all-cheerers'
			link="GoalC.php?act=cheerers&goalID={$goal.GoalID}"
		}
		
		{foreach $cheerers as $cheerer}
		<a href="person.php?userID={$cheerer.UserID}">
			<img class='user-icon' src="{$cheerer.Avatar}" title="{$cheerer.Username}" />
		</a>
		{/foreach}
	{/if}
	</div>
</div>

{if $isCreator}

<!-- 编辑标题 -->
<div id='dialog-edit-goal-title'>
	<form id="form-edit-goal-title" action="GoalC.php" method="post">
		<input type='text' class='validate[required]' id='input-goal-title' autocomplete='off' placeholder='标题' name='goalTitle'>	
		<input type="hidden" name="goalID" value="{$goal.GoalID}" />
		<input type="hidden" name="act" value="updateGoalTitle" />
	</form>		
</div>

<!-- 编辑愿景 -->
<div id='dialog-edit-goal-reason'>
	<form id="form-edit-goal-reason" action="GoalC.php" method="post">
		<textarea id='input-goal-reason' class='validate[required]' rows='2' autocomplete='off' placeholder='愿景' name='goalReason'></textarea>
		<input type="hidden" name="goalID" value="{$goal.GoalID}" />
		<input type="hidden" name="act" value="updateGoalReason" />
	</form>	
</div>

<!-- 编辑步骤 -->
<div id='dialog-edit-steps'></div>

<!-- 添加记录 -->
<div id='dialog-new-log'>
	<form id="form-new-log" action="GoalC.php" method="post">
		<input type='text' id='log-title' autocomplete='off' placeholder='标题（可不填）' name='logTitle' />	
		<textarea id="log-content" class='validate[required]' autocomplete='off' placeholder="内容" name="logContent"></textarea>
		<input type="hidden" name="goalID" value="{$goal.GoalID}" />
		<input type="hidden" name="typeID" value="1" />
		<input type="hidden" name="act" value="newLog" />
	</form>	
</div>

<!-- 修改记录 -->
<div id='dialog-edit-log'>
	<form id="form-edit-log" action="GoalC.php" method="post">
		<input type='text' id='log-title' autocomplete='off' placeholder='标题（可不填）' name='logTitle'>
		<textarea id="log-content" class='validate[required]' autocomplete='off' placeholder="内容" name="logContent"></textarea>	
		<input type="hidden" name="logID" />
		<input type="hidden" name="act" value="updateLog" />
	</form>	
</div>

<!-- 完成Goal -->
<div id='dialog-finish-goal'>	
	<p id='period'>从 {$goal.StartTime} ' 至 ' {$smarty.now|date_format:'%Y-%m-%d'}</p>

	<form id='form-finish-goal' action='GoalC.php' method='post'>
		<input type='text' value='完结篇' class='validate[required]' name='logTitle' />
		<textarea rows='10' class='validate[required]' placeholder='写点神马作为完结篇吧，比如感受啊、建议啊之类的' name='logContent'></textarea>
		<input type='hidden' name='goalID' value="{$goal.GoalID}" />
		<input type='hidden' name='act' value='finishGoal' />
	</form>
</div>

{/if}

{include file='../footer.tpl'}