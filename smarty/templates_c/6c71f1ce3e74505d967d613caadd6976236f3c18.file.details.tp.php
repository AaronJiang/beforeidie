<?php /* Smarty version Smarty-3.1.12, created on 2012-12-03 09:43:23
         compiled from "..\view\goal\details.tp" */ ?>
<?php /*%%SmartyHeaderCode:1933950938337f31405-89020659%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6c71f1ce3e74505d967d613caadd6976236f3c18' => 
    array (
      0 => '..\\view\\goal\\details.tp',
      1 => 1354524198,
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
    'isCreator' => 0,
    'log' => 0,
    'userID' => 0,
    'userAvatar' => 0,
    'creator' => 0,
    'creatorAvatar' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5093833847d1f5_79212337')) {function content_5093833847d1f5_79212337($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('../header.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>((string)$_smarty_tpl->tpl_vars['goal']->value['Title']),'page'=>'page-goal-details'), 0);?>


<script type='text/javascript' src='../js/goal-comment.js'></script>
<script type="text/javascript">


$(document).ready(function(){

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
			<?php }?>
			</div>
		</div>
		
		<!-- Reason -->
		<div id='goal-reason'><?php echo $_smarty_tpl->tpl_vars['goal']->value['Reason'];?>
</div>
		
		<!-- Log -->
		<div id='log-wap'>

			<div id='log-wap' class='new-comment-parent'>

				
				<div class="log-content" contenteditable="false"><?php echo $_smarty_tpl->tpl_vars['log']->value['LogContent'];?>
</div>
						
				
				<div class='log-footer'>
					<a class='btn btn-tiny btn-cmd cmd-new-comment' 
						data-log-id="<?php echo $_smarty_tpl->tpl_vars['log']->value['LogID'];?>
"
						data-poster-id="<?php echo $_smarty_tpl->tpl_vars['userID']->value;?>
"
						data-is-root='1'
						data-avatar-url="<?php echo $_smarty_tpl->tpl_vars['userAvatar']->value;?>
"
						>回复<?php if ($_smarty_tpl->tpl_vars['log']->value['commentsNum']!=0){?>(<?php echo $_smarty_tpl->tpl_vars['log']->value['commentsNum'];?>
)<?php }?></a>

					<?php if ($_smarty_tpl->tpl_vars['isCreator']->value){?>
					<a class='btn btn-tiny btn-cmd log-cmd-edit' 
						data-log-id="<?php echo $_smarty_tpl->tpl_vars['log']->value['LogID'];?>
">编辑</a>
					<?php }?>
			
					
					<span class='log-time'><?php echo $_smarty_tpl->tpl_vars['log']->value['LogTime'];?>
</span>
				</div>
						
				
				<?php if ($_smarty_tpl->tpl_vars['log']->value['commentsNum']!=0){?>
				<div class='comments-wap'>
					<?php  $_smarty_tpl->tpl_vars['comm'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['comm']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['log']->value['comments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['comm']->key => $_smarty_tpl->tpl_vars['comm']->value){
$_smarty_tpl->tpl_vars['comm']->_loop = true;
?>
					<?php echo $_smarty_tpl->getSubTemplate ('../comments.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

					<?php } ?>
				</div>
				<?php }?>

			</div>
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
	</div>

</div>

<?php if ($_smarty_tpl->tpl_vars['isCreator']->value){?>

<!-- 添加记录 -->
<div id='dialog-new-log'>
	<form id="form-new-log" action="GoalC.php" method="post">
		<textarea id="log-content" class='validate[required]' autocomplete='off' placeholder="内容" name="logContent"></textarea>
		<input type="hidden" name="goalID" value="<?php echo $_smarty_tpl->tpl_vars['goal']->value['GoalID'];?>
" />
		<input type="hidden" name="act" value="new_log" />
	</form>	
</div>

<!-- 修改记录 -->
<div id='dialog-edit-log'>
	<form id="form-edit-log" action="GoalC.php" method="post">
		<textarea id="log-content" class='validate[required]' autocomplete='off' placeholder="内容" name="logContent"></textarea>	
		<input type="hidden" name="logID" />
		<input type="hidden" name="act" value="update_log" />
	</form>	
</div>

<?php }?>

<?php echo $_smarty_tpl->getSubTemplate ('../footer.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>