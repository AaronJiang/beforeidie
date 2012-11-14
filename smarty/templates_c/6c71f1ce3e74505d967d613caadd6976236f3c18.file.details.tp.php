<?php /* Smarty version Smarty-3.1.12, created on 2012-11-14 16:41:56
         compiled from "..\view\goal\details.tp" */ ?>
<?php /*%%SmartyHeaderCode:1933950938337f31405-89020659%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6c71f1ce3e74505d967d613caadd6976236f3c18' => 
    array (
      0 => '..\\view\\goal\\details.tp',
      1 => 1352907715,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1933950938337f31405-89020659',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5093833847d1f5_79212337',
  'variables' => 
  array (
    'goal' => 0,
    'userID' => 0,
    'isCreator' => 0,
    'isCheered' => 0,
    'pagesNum' => 0,
    'creator' => 0,
    'creatorAvatar' => 0,
    'cheerersNum' => 0,
    'cheerers' => 0,
    'cheerer' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5093833847d1f5_79212337')) {function content_5093833847d1f5_79212337($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('../header.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>((string)$_smarty_tpl->tpl_vars['goal']->value['Title']),'page'=>'page-goal-details'), 0);?>


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
			act: 'get_logs',
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

	/* Delete Log
	----------------------------------------------------*/

	//记录删除警告框
	$('.log-cmd-delete').live('click', function(){
		if(!confirm("确定删除此记录？")){
			return false;
		}
	});
	
	
});

</script>

<div class='row'>

	<div class='span9'>

		<!-- Title -->
		<div id='title-wap'>
			<h1 id='goal-title'><?php echo $_smarty_tpl->tpl_vars['goal']->value['Title'];?>
</h1>
			
			<div id='goal-cmd-wap'>	
			<?php if ($_smarty_tpl->tpl_vars['isCreator']->value){?>
				<a id='cmd-edit-goal' class="btn btn-small" href='GoalC.php?act=edit&goalID=<?php echo $_smarty_tpl->tpl_vars['goal']->value['GoalID'];?>
'>修改</a>
			<?php }else{ ?>
				<?php if ($_smarty_tpl->tpl_vars['isCheered']->value){?>
				<a class='btn btn-small'>已鼓励</a>
				<?php }else{ ?>
				<a class='btn btn-small' href="GoalC.php?act=cheer_goal&userID=<?php echo $_smarty_tpl->tpl_vars['userID']->value;?>
&goalID=<?php echo $_smarty_tpl->tpl_vars['goal']->value['GoalID'];?>
">鼓励</a>
				<?php }?>
			<?php }?>
			</div>
		</div>
		
		<!-- Reason -->
		<div id='goal-reason'><?php echo $_smarty_tpl->tpl_vars['goal']->value['Reason'];?>
</div>
		
		<!-- Logs -->
		<div id='logs-wap'>
			<a class="btn btn-small" id="cmd-add-log">添加</a>

			<!--
			<div id='logs-pager'>
				<span id='curr-page-num'>1</span>
				<span>/</span>
				<span id='total-page-num'><?php echo $_smarty_tpl->tpl_vars['pagesNum']->value;?>
</span>
				<a id='page-up' >上页</a
				><a id='page-down'>下页</a>
			</div>
			-->

			<div id='logs'></div>
		</div>
	</div>

	<div class='span3'>

		<!-- Creator -->
		<div id='creator-wap'>
			<?php echo $_smarty_tpl->getSubTemplate ('../panel_header.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>'创建者'), 0);?>

			
			<a href="PersonC.php?act=person&userID=<?php echo $_smarty_tpl->tpl_vars['creator']->value['UserID'];?>
">
				<img class='avatar avatar-multi' src="<?php echo $_smarty_tpl->tpl_vars['creatorAvatar']->value;?>
" title="<?php echo $_smarty_tpl->tpl_vars['creator']->value['Username'];?>
" />
			</a>
		</div>

		<!-- Cheerers -->
		<div>
			<?php if ($_smarty_tpl->tpl_vars['cheerersNum']->value!=0){?>
			<?php echo $_smarty_tpl->getSubTemplate ('../panel_header.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>'鼓励者','cmd'=>"全部/".((string)$_smarty_tpl->tpl_vars['cheerersNum']->value),'cmdID'=>'cmd-all-cheerers','link'=>"GoalC.php?act=cheerers&goalID=".((string)$_smarty_tpl->tpl_vars['goal']->value['GoalID'])), 0);?>

			
			<?php  $_smarty_tpl->tpl_vars['cheerer'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cheerer']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['cheerers']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cheerer']->key => $_smarty_tpl->tpl_vars['cheerer']->value){
$_smarty_tpl->tpl_vars['cheerer']->_loop = true;
?>
			<a href="PersonC.php?act=person&userID=<?php echo $_smarty_tpl->tpl_vars['cheerer']->value['UserID'];?>
">
				<img class='avatar avatar-multi' src="<?php echo $_smarty_tpl->tpl_vars['cheerer']->value['Avatar'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['cheerer']->value['Username'];?>
" />
			</a>
			<?php } ?>
			<?php }?>
		</div>
	</div>

</div>

<?php if ($_smarty_tpl->tpl_vars['isCreator']->value){?>

<!-- 添加记录 -->
<div id='dialog-new-log'>
	<form id="form-new-log" action="GoalC.php" method="post">
		<input type='text' id='log-title' autocomplete='off' placeholder='标题（可不填）' name='logTitle' />	
		<textarea id="log-content" class='validate[required]' autocomplete='off' placeholder="内容" name="logContent"></textarea>
		<input type="hidden" name="goalID" value="<?php echo $_smarty_tpl->tpl_vars['goal']->value['GoalID'];?>
" />
		<input type="hidden" name="typeID" value="1" />
		<input type="hidden" name="act" value="new_log" />
	</form>	
</div>

<!-- 修改记录 -->
<div id='dialog-edit-log'>
	<form id="form-edit-log" action="GoalC.php" method="post">
		<input type='text' id='log-title' autocomplete='off' placeholder='标题（可不填）' name='logTitle'>
		<textarea id="log-content" class='validate[required]' autocomplete='off' placeholder="内容" name="logContent"></textarea>	
		<input type="hidden" name="logID" />
		<input type="hidden" name="act" value="update_log" />
	</form>	
</div>

<?php }?>

<?php echo $_smarty_tpl->getSubTemplate ('../footer.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>