{include file='../header.tpl' title='我的Goals' page='page-home'}{literal}<script type="text/javascript">$(document).ready(function(){		//滑出命令栏	$('.goal-item').live("hover", function(event){		if(event.type == 'mouseenter'){			$(this).find('.goal-cmd-wap').animate({'bottom':'0px'}, 'fast');		} 		else if(event.type == 'mouseleave'){			$(this).find('.goal-cmd-wap').animate({'bottom':'-32px'}, 'fast');		};	});		//初始化 Goal 延迟对话框	$('#dialog-delay').dialog({		autoOpen: false,		modal: true,		width: 320,		draggable: false,		resizable: false,		buttons: {			'确认': function(){				$('#form-delay-goal').submit();			},			'取消': function(){				$(this).dialog('close');			}		}	});		//初始化 datapicker	$('#goal-starttime').datepicker({		changeMonth: true,		changeYear: true,		showOtherMonths: true,		selectOtherMonths: true	});			//弹出 Goal 延迟框	$('.goal-cmd-delay').click(function(){		//对话框标题		var goalTitle = $(this).data('title');		$('#dialog-delay').dialog('option', 'title', '推迟：' + goalTitle);				//设置表单隐藏域 goalID 的值		var goalID = $(this).data('goalid');		$("#form-delay-goal input[name='goalID']").val(goalID);			$('#dialog-delay').dialog('open');	});		//弹出放弃 Goal 警告框	$('.goal-cmd-drop').click(function(){		var goalTitle = $(this).data('title');		var isSure = confirm('确定放弃目标：' + goalTitle + "?");		if(!isSure){			return false;		}	});});</script>{/literal}<ul id="goal-selector" class="clearfix">	<li><a href="HomeC.php?act=home&goalType=now">进 行 中 [{$goalNum.now}]</a></li>	<li><a href="HomeC.php?act=home&goalType=future">待 启 动 [{$goalNum.future}]</a></li>	<li><a href="HomeC.php?act=home&goalType=finish">已 完 成 [{$goalNum.finish}]</a></li></ul><div id="content-goals">{foreach $goals as $goal}	<div class='goal-item goal-item-{$goalType}'>			{* Goal信息 *}		<a class='goal-link' href='GoalC.php?act=details&goalID={$goal.GoalID}'>			<p class='goal-title'>{$goal.Title}</p>			<p class='goal-why'>{$goal.Reason}</p>			<div class='goal-info-wap'>				{if $goalType == 'future'}				<p class='goal-starttime'>将于 <b>{$goal.StartTime}</b> 启动</p>				{elseif $goalType == 'finish'}				<p class='goal-endtime'>于 <b>{$goal.EndTime}</b> 达成</p>											{else}				<p><b>{$goal.stepsNum}</b> 计划 | <b>{$goal.logsNum}</b> 记录</p>				{/if}			</div>		</a>			{* 命令按钮 *}		<div class='goal-cmd-wap'>			<a class='goal-cmd goal-cmd-edit'				href="GoalC.php?act=edit&goalID={$goal.GoalID}"				>编辑</a>			{if $goalType == "now"}			<a class='goal-cmd goal-cmd-delay' 				data-goalid='{$goal.GoalID}'				data-title='{$goal.Title}'				>推迟</a>			{elseif $goalType == "future"}			<a class='goal-cmd goal-cmd-start'				href="HomeC.php?act=start_goal&goalID={$goal.GoalID}"				>启动</a>			{/if}			{if $goalType != "finish"}			<a class='goal-cmd goal-cmd-drop'				data-title='{$goal.Title}'				href='HomeC.php?act=drop_goal&goalID={$goal.GoalID}'				>放弃</a>				{/if}		</div>	</div>{/foreach}	</div><div id='dialog-delay' title='推迟启动'>	<form id='form-delay-goal' action='HomeC.php' method='post'>		<label for='goal-starttime'>启动时间：</label>		<input type='text' name='startTime' autocomplete="off" id='goal-starttime' />		<input type='hidden' name='goalID' value='' />		<input type='hidden' name='act' value='delay_goal' />	</form></div>{include file='../footer.tpl'}