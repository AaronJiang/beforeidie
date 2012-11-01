<?php /* Smarty version Smarty-3.1.12, created on 2012-11-01 08:10:16
         compiled from "..\view\goal\logs.tc" */ ?>
<?php /*%%SmartyHeaderCode:552050913f92186c35-87044713%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8c21159c20a621bad90988db1914f9ddbae8202b' => 
    array (
      0 => '..\\view\\goal\\logs.tc',
      1 => 1351753390,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '552050913f92186c35-87044713',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_50913f922d4df6_26485714',
  'variables' => 
  array (
    'logsNum' => 0,
    'logs' => 0,
    'log' => 0,
    'userID' => 0,
    'userAvatar' => 0,
    'isCreator' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50913f922d4df6_26485714')) {function content_50913f922d4df6_26485714($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['logsNum']->value!=0){?>

	<?php  $_smarty_tpl->tpl_vars['log'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['log']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['logs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['log']->key => $_smarty_tpl->tpl_vars['log']->value){
$_smarty_tpl->tpl_vars['log']->_loop = true;
?>
	<div class='log-item new-comment-parent'>

		
		<?php if ($_smarty_tpl->tpl_vars['log']->value['LogTitle']!=''){?>
		<p class='log-title'><?php echo $_smarty_tpl->tpl_vars['log']->value['LogTitle'];?>
</p>			
		<?php }?>
		<p class='log-content'><?php echo $_smarty_tpl->tpl_vars['log']->value['LogContent'];?>
</p>
				
		
		<div class='log-cmd-time-wap'>
			<a class='small-cmd cmd-new-comment' 
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
			<a class='small-cmd log-cmd-edit' 
				data-log-id="<?php echo $_smarty_tpl->tpl_vars['log']->value['LogID'];?>
">编辑</a>
			<?php }?>
									
			<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['log']->value['TypeID'];?>
<?php $_tmp1=ob_get_clean();?><?php if ($_smarty_tpl->tpl_vars['isCreator']->value&&$_tmp1!=0){?>
			<a class='small-cmd log-cmd-delete'
				href="GoalC.php?act=delete_log&logID=<?php echo $_smarty_tpl->tpl_vars['log']->value['LogID'];?>
">删除</a>
			<?php }?>
	
			
			<p class='log-time'><?php echo $_smarty_tpl->tpl_vars['log']->value['LogTime'];?>
</p>
		</div>
				
		
		<?php if ($_smarty_tpl->tpl_vars['log']->value['commentsNum']!=0){?>
		<div class='comments-wap'>
			<?php  $_smarty_tpl->tpl_vars['comm'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['comm']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['log']->value['comments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['comm']->key => $_smarty_tpl->tpl_vars['comm']->value){
$_smarty_tpl->tpl_vars['comm']->_loop = true;
?>
			<?php echo $_smarty_tpl->getSubTemplate ('comments.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

			<?php } ?>
		</div>
		<?php }?>
	</div>
	<?php } ?>
	
<?php }else{ ?>

	

<?php }?><?php }} ?>