<?php /* Smarty version Smarty-3.1.12, created on 2012-12-09 12:09:36
         compiled from "..\view\goal\details.tp" */ ?>
<?php /*%%SmartyHeaderCode:1933950938337f31405-89020659%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6c71f1ce3e74505d967d613caadd6976236f3c18' => 
    array (
      0 => '..\\view\\goal\\details.tp',
      1 => 1355051277,
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
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5093833847d1f5_79212337')) {function content_5093833847d1f5_79212337($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('../header.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>((string)$_smarty_tpl->tpl_vars['goal']->value['Title']),'page'=>'page-goal-details'), 0);?>


<script type='text/javascript' src='../js/goal-comment.js'></script>
<script type="text/javascript">


$(document).ready(function(){

	/*
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
	$('#goal-content').blur(function(){
		var goalID = $(this).data('goal-id'),
			content = $(this).html();

		$.ajax({
			url: 'GoalC.php',
			type: 'POST',
			data: {
				'act': 'update_goal_content',
				'goalID': goalID,
				'content': content 
			}
		});
	});
	*/

	$(window).unload(function(){
		var goalID = $('#goal-title').data('goal-id'),
			goalTitle = $('#goal-title').text(),
			goalContent = $('#goal-content').html();
			
		$.ajax({
			url: 'GoalC.php',
			type: 'POST',
			async: false,
			data: {
				'act': 'update_goal',
				'goalID': goalID,
				'goalTitle': goalTitle,
				'goalContent': goalContent
			}
		});
	});
});


</script>

<div id='title-wap'>
	<h2 id="goal-title" data-goal-id="<?php echo $_smarty_tpl->tpl_vars['goal']->value['GoalID'];?>
" contenteditable="true"><?php echo $_smarty_tpl->tpl_vars['goal']->value['Title'];?>
</h2>
	<div id="goal-creator">by <a href="PersonC.php?act=person&userID=<?php echo $_smarty_tpl->tpl_vars['creator']->value['UserID'];?>
"><?php echo $_smarty_tpl->tpl_vars['creator']->value['Username'];?>
</a></div>
</div>

<div id="goal-content" data-goal-id="<?php echo $_smarty_tpl->tpl_vars['goal']->value['GoalID'];?>
" contenteditable="true"><?php echo $_smarty_tpl->tpl_vars['goal']->value['Content'];?>
</div>	

<?php echo $_smarty_tpl->getSubTemplate ('../footer.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>