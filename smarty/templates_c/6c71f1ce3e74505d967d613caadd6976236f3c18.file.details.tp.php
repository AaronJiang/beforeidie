<?php /* Smarty version Smarty-3.1.12, created on 2012-12-08 02:53:01
         compiled from "..\view\goal\details.tp" */ ?>
<?php /*%%SmartyHeaderCode:1933950938337f31405-89020659%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6c71f1ce3e74505d967d613caadd6976236f3c18' => 
    array (
      0 => '..\\view\\goal\\details.tp',
      1 => 1354931579,
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
    'creator' => 0,
    'log' => 0,
    'userID' => 0,
    'userAvatar' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5093833847d1f5_79212337')) {function content_5093833847d1f5_79212337($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('../header.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>((string)$_smarty_tpl->tpl_vars['goal']->value['Title']),'page'=>'page-goal-details'), 0);?>


<script type='text/javascript' src='../js/goal-comment.js'></script>
<script type="text/javascript">


$(document).ready(function(){

	// 更新标题
	$('#goal-title').blur(function(){
		var goalTitle = $(this).text(),
			goalID = $(this).data('goal-id');

		$.ajax({
			url: 'GoalC.php',
			type: 'POST',
			data: {
				'act': 'update_goal_title',
				'goalID': goalID,
				'goalTitle': goalTitle
			}
		});
	});

	// 更新内容
	$('#log-content').blur(function(){
		var logID = $(this).data('log-id');
		var logContent = $(this).html();

		$.ajax({
			url: 'GoalC.php',
			type: 'POST',
			data: {
				'act': 'update_log',
				'logID': logID,
				'logContent': logContent 
			}
		});
	});
});


</script>


<!-- Title -->
<div id='title-wap'>
	<h2 id="goal-title" data-goal-id="<?php echo $_smarty_tpl->tpl_vars['goal']->value['GoalID'];?>
" contenteditable="true"><?php echo $_smarty_tpl->tpl_vars['goal']->value['Title'];?>
</h2>
	<div id='goal-cmd-wap'></div>
	<div id="goal-creator">by <a href="PersonC.php?act=person&userID=<?php echo $_smarty_tpl->tpl_vars['creator']->value['UserID'];?>
"><?php echo $_smarty_tpl->tpl_vars['creator']->value['Username'];?>
</a></div>
</div>

<!-- Log -->
<div id='log-wap' class='new-comment-parent'>

	<div id="log-content" data-log-id="<?php echo $_smarty_tpl->tpl_vars['log']->value['LogID'];?>
" contenteditable="true"><?php echo $_smarty_tpl->tpl_vars['log']->value['LogContent'];?>
</div>	
	
	<div class="log-footer">
		<!--<a class='cmd-new-comment' 
			data-log-id="<?php echo $_smarty_tpl->tpl_vars['log']->value['LogID'];?>
"
			data-poster-id="<?php echo $_smarty_tpl->tpl_vars['userID']->value;?>
"
			data-is-root='1'
			data-avatar-url="<?php echo $_smarty_tpl->tpl_vars['userAvatar']->value;?>
"
		>回复<?php if ($_smarty_tpl->tpl_vars['log']->value['commentsNum']!=0){?>(<?php echo $_smarty_tpl->tpl_vars['log']->value['commentsNum'];?>
)<?php }?></a>
		<span class='log-time'><?php echo $_smarty_tpl->tpl_vars['log']->value['LogTime'];?>
</span>-->
	</div>
			
	
</div>

<?php echo $_smarty_tpl->getSubTemplate ('../footer.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>