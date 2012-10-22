<?php /* Smarty version Smarty-3.1.12, created on 2012-10-22 18:03:34
         compiled from "..\view\goal\comments.tpl" */ ?>
<?php /*%%SmartyHeaderCode:803550855e94760589-48347555%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ed8c6ae20356dc511abab15bfebb57e7a2fa177b' => 
    array (
      0 => '..\\view\\goal\\comments.tpl',
      1 => 1350921803,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '803550855e94760589-48347555',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_50855e94902958_86869147',
  'variables' => 
  array (
    'log' => 0,
    'comm' => 0,
    'userID' => 0,
    'userAvatar' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50855e94902958_86869147')) {function content_50855e94902958_86869147($_smarty_tpl) {?><div class='comments-wap'>
	<?php  $_smarty_tpl->tpl_vars['comm'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['comm']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['log']->value['comments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['comm']->key => $_smarty_tpl->tpl_vars['comm']->value){
$_smarty_tpl->tpl_vars['comm']->_loop = true;
?>
	
	
	<div class='comment-item clearfix'>
	
		
		<a href="person.php?userID=<?php echo $_smarty_tpl->tpl_vars['comm']->value['PosterID'];?>
">
			<img class="comment-poster-profile"
				title="<?php echo $_smarty_tpl->tpl_vars['comm']->value['Poster'];?>
"
				src="<?php echo $_smarty_tpl->tpl_vars['comm']->value['Avatar'];?>
" />
		</a>

		
		<div class='comment-main'>
					
			
			<div class='comment-header'>
				<?php if ($_smarty_tpl->tpl_vars['comm']->value['IsRoot']==1){?>
				<a href="PersonC.php?act=person&userID=<?php echo $_smarty_tpl->tpl_vars['comm']->value['PosterID'];?>
"><?php echo $_smarty_tpl->tpl_vars['comm']->value['Poster'];?>
</a>:<?php echo $_smarty_tpl->tpl_vars['comm']->value['Comment'];?>

				<?php }else{ ?>
				<a href="PersonC.php?act=person&userID=<?php echo $_smarty_tpl->tpl_vars['comm']->value['PosterID'];?>
"><?php echo $_smarty_tpl->tpl_vars['comm']->value['Poster'];?>
</a>:<a href="PersonC.php?act=person&userID=<?php echo $_smarty_tpl->tpl_vars['comm']->value['ReceiverID'];?>
">@<?php echo $_smarty_tpl->tpl_vars['comm']->value['Receiver'];?>
</a>
				<?php echo $_smarty_tpl->tpl_vars['comm']->value['Comment'];?>

				<?php }?>
			</div>
					
			
			<div class='comment-footer'>
				<span class='comment-time'><?php echo $_smarty_tpl->tpl_vars['comm']->value['Time'];?>
</span>
				&nbsp;
				<span class='comment-cmd cmd-new-comment'
					data-log-id="<?php echo $_smarty_tpl->tpl_vars['log']->value['LogID'];?>
"
					data-parent-comment-id="<?php echo $_smarty_tpl->tpl_vars['comm']->value['CommentID'];?>
"
					data-poster-id="<?php echo $_smarty_tpl->tpl_vars['userID']->value;?>
"
					data-is-root='0'
					data-avatar-url="<?php echo $_smarty_tpl->tpl_vars['userAvatar']->value;?>
"
					>回复<span>
			</div>
		</div>
	</div>
	<?php } ?>
</div><?php }} ?>