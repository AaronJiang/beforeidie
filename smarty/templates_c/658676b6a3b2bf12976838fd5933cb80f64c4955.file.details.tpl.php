<?php /* Smarty version Smarty-3.1.12, created on 2012-10-22 16:54:29
         compiled from "..\view\goal\details.tpl" */ ?>
<?php /*%%SmartyHeaderCode:67435083eba82ca817-93662169%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '658676b6a3b2bf12976838fd5933cb80f64c4955' => 
    array (
      0 => '..\\view\\goal\\details.tpl',
      1 => 1350916380,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '67435083eba82ca817-93662169',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5083eba82ce241_84586945',
  'variables' => 
  array (
    'goal' => 0,
    'userID' => 0,
    'isCreator' => 0,
    'isFinished' => 0,
    'isCheered' => 0,
    'stepsNum' => 0,
    'steps' => 0,
    'step' => 0,
    'pagesNum' => 0,
    'creator' => 0,
    'creatorAvatar' => 0,
    'cheerersNum' => 0,
    'cheerers' => 0,
    'cheerer' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5083eba82ce241_84586945')) {function content_5083eba82ce241_84586945($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'F:\\xampp\\htdocs\\Dream\\smarty\\libs\\plugins\\modifier.date_format.php';
?><?php echo $_smarty_tpl->getSubTemplate ('../header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>((string)$_smarty_tpl->tpl_vars['goal']->value['Title']),'page'=>'page-goal-details'), 0);?>


<script type='text/javascript' src='../js/goal-comment.js'></script>
<script type="text/javascript">

$(document).ready(function(){
	//全局变量
	var GOAL_ID = <?php echo $_smarty_tpl->tpl_vars['goal']->value['GoalID'];?>
,
		USER_ID = <?php echo $_smarty_tpl->tpl_vars['userID']->value;?>
;

	/* Pager
	----------------------------------------------------*/
	
	var PAGE_NUM = 1,	//当前页数
		NUM_PER_PAGE = 20,
		TOTAL_PAGE_NUM = $('#total-page-num').text(),	//总页数
		isCreator = <?php echo $_smarty_tpl->tpl_vars['isCreator']->value;?>
;

		
	//加载函数
	function load_logs(pageNum){
		var data = {
			act: 'getLogs',
			'goalID': GOAL_ID,
			'pageNum': pageNum,
			'numPerPage': NUM_PER_PAGE,
			'isCreator': isCreator
		};
		
		$('#logs').load('GoalC.php', data, function(){
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
	
});

</script>

<!-- Main Panel -->
<div id='main-panel'>

	<!-- Title -->
	<div id='title-wap'>
		<span id='goal-title'><?php echo $_smarty_tpl->tpl_vars['goal']->value['Title'];?>
</span>
		<?php if ($_smarty_tpl->tpl_vars['isCreator']->value){?>
		<span id='goal-title-underline'>_ _ _</span>
		<a id='cmd-edit-goal-title'>修改</a>
		<?php }?>
		
		<div id='goal-cmd-wap'>	
		<?php if ($_smarty_tpl->tpl_vars['isCreator']->value){?>
			<?php if ($_smarty_tpl->tpl_vars['isFinished']->value){?>
			<a class='isFinished'>已完成</a>
			<?php }else{ ?>
			<a id='cmd-finish-goal'>完成</a>
			<?php }?>
		<?php }else{ ?>
			<?php if ($_smarty_tpl->tpl_vars['isCheered']->value){?>
			<a class='isCheered'>已鼓励</a>
			<?php }else{ ?>
			<a href="CheerC.php?act=cheer&userID=<?php echo $_smarty_tpl->tpl_vars['userID']->value;?>
&goalID=<?php echo $_smarty_tpl->tpl_vars['goal']->value['GoalID'];?>
">鼓励</a>
			<?php }?>
		<?php }?>
		</div>
	</div>

	<!-- Reason -->
	<div id='reason-wap'>
		<?php echo $_smarty_tpl->getSubTemplate ('../panel_header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>'愿景','cmd'=>'修改','cmdID'=>'cmd-edit-goal-reason','isCreator'=>((string)$_smarty_tpl->tpl_vars['isCreator']->value)), 0);?>

		<p id='goal-reason'><?php echo $_smarty_tpl->tpl_vars['goal']->value['Reason'];?>
</p>
	</div>

	<!-- Steps -->
	<div id='steps-wap'>
		<?php echo $_smarty_tpl->getSubTemplate ('../panel_header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>'计划','cmd'=>'调整','cmdID'=>'cmd-edit-steps','isCreator'=>((string)$_smarty_tpl->tpl_vars['isCreator']->value)), 0);?>

		
		<?php if ($_smarty_tpl->tpl_vars['stepsNum']->value==0){?>
		<p id='no-step-caution' style='margin:0 0 5px 5px;font-size:13px;'>还没有任何规划哦~</p>
		<?php }?>
		
		<ul id='steps-list'>
			<?php  $_smarty_tpl->tpl_vars['step'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['step']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['steps']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['step']->key => $_smarty_tpl->tpl_vars['step']->value){
$_smarty_tpl->tpl_vars['step']->_loop = true;
?>
			<li><?php echo $_smarty_tpl->tpl_vars['step']->value['StepContent'];?>
</li>
			<?php } ?>
		</ul>
	</div>
	
	<!-- Logs -->
	<div id='logs-wap'>
		<?php echo $_smarty_tpl->getSubTemplate ('../panel_header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>'记录','cmd'=>'添加','cmdID'=>'cmd-add-log','isCreator'=>((string)$_smarty_tpl->tpl_vars['isCreator']->value)), 0);?>

		
		<div id='logs-pager'>
			<span id='curr-page-num'>1</span>
			<span>/</span>
			<span id='total-page-num'><?php echo $_smarty_tpl->tpl_vars['pagesNum']->value;?>
</span>
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
		<?php echo $_smarty_tpl->getSubTemplate ('../panel_header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>'创建者'), 0);?>

		
		<a class='user-icon' href="PersonC.php?act=person&userID=<?php echo $_smarty_tpl->tpl_vars['creator']->value['UserID'];?>
">
			<img src="<?php echo $_smarty_tpl->tpl_vars['creatorAvatar']->value;?>
" title="<?php echo $_smarty_tpl->tpl_vars['creator']->value['Username'];?>
" />
		</a>
	</div>

	<!-- Cheerers -->
	<?php if ($_smarty_tpl->tpl_vars['cheerersNum']->value!=0){?>
		<?php echo $_smarty_tpl->getSubTemplate ('../panel_header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>'鼓励者','cmd'=>"全部 (".((string)$_smarty_tpl->tpl_vars['cheerersNum']->value).")",'cmdID'=>'cmd-all-cheerers','link'=>"GoalC.php?act=cheerers&goalID=".((string)$_smarty_tpl->tpl_vars['goal']->value['GoalID'])), 0);?>

		
		<?php  $_smarty_tpl->tpl_vars['cheerer'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cheerer']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['cheerers']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cheerer']->key => $_smarty_tpl->tpl_vars['cheerer']->value){
$_smarty_tpl->tpl_vars['cheerer']->_loop = true;
?>
		<a href="person.php?userID=<?php echo $_smarty_tpl->tpl_vars['cheerer']->value['UserID'];?>
">
			<img class='user-icon' src="<?php echo $_smarty_tpl->tpl_vars['cheerer']->value['Avatar'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['cheerer']->value['Username'];?>
" />
		</a>
		<?php } ?>
	<?php }?>
	</div>
</div>

<?php if ($_smarty_tpl->tpl_vars['isCreator']->value){?>

<!-- 编辑标题 -->
<div id='dialog-edit-goal-title'>
	<form id="form-edit-goal-title" action="GoalC.php" method="post">
		<input type='text' class='validate[required]' id='input-goal-title' autocomplete='off' placeholder='标题' name='goalTitle'>	
		<input type="hidden" name="goalID" value="<?php echo $_smarty_tpl->tpl_vars['goal']->value['GoalID'];?>
" />
		<input type="hidden" name="act" value="updateGoalTitle" />
	</form>		
</div>

<!-- 编辑愿景 -->
<div id='dialog-edit-goal-reason'>
	<form id="form-edit-goal-reason" action="GoalC.php" method="post">
		<textarea id='input-goal-reason' class='validate[required]' rows='2' autocomplete='off' placeholder='愿景' name='goalReason'></textarea>
		<input type="hidden" name="goalID" value="<?php echo $_smarty_tpl->tpl_vars['goal']->value['GoalID'];?>
" />
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
		<input type="hidden" name="goalID" value="<?php echo $_smarty_tpl->tpl_vars['goal']->value['GoalID'];?>
" />
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
	<p id='period'>从 <?php echo $_smarty_tpl->tpl_vars['goal']->value['StartTime'];?>
 ' 至 ' <?php echo smarty_modifier_date_format(time(),'%Y-%m-%d');?>
</p>

	<form id='form-finish-goal' action='GoalC.php' method='post'>
		<input type='text' value='完结篇' class='validate[required]' name='logTitle' />
		<textarea rows='10' class='validate[required]' placeholder='写点神马作为完结篇吧，比如感受啊、建议啊之类的' name='logContent'></textarea>
		<input type='hidden' name='goalID' value="<?php echo $_smarty_tpl->tpl_vars['goal']->value['GoalID'];?>
" />
		<input type='hidden' name='act' value='finishGoal' />
	</form>
</div>

<?php }?>

<?php echo $_smarty_tpl->getSubTemplate ('../footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>