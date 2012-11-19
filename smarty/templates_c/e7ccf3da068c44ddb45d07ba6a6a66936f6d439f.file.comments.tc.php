<?php /* Smarty version Smarty-3.1.12, created on 2012-11-16 02:30:26
         compiled from "..\view\comments.tc" */ ?>
<?php /*%%SmartyHeaderCode:2824850923746c4e557-92446092%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e7ccf3da068c44ddb45d07ba6a6a66936f6d439f' => 
    array (
      0 => '..\\view\\comments.tc',
      1 => 1352964297,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2824850923746c4e557-92446092',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_50923746dfea73_85134633',
  'variables' => 
  array (
    'comm' => 0,
    'userID' => 0,
    'userAvatar' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50923746dfea73_85134633')) {function content_50923746dfea73_85134633($_smarty_tpl) {?>

<div class='comment-item'>
	
	
	<a href="PersonC.php?act=person&userID=<?php echo $_smarty_tpl->tpl_vars['comm']->value['PosterID'];?>
">
		<img class="avatar avatar-side avatar-small"
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
</a> : <?php echo $_smarty_tpl->tpl_vars['comm']->value['Comment'];?>

			<?php }else{ ?>
			<a href="PersonC.php?act=person&userID=<?php echo $_smarty_tpl->tpl_vars['comm']->value['PosterID'];?>
"><?php echo $_smarty_tpl->tpl_vars['comm']->value['Poster'];?>
</a> : <a href="PersonC.php?act=person&userID=<?php echo $_smarty_tpl->tpl_vars['comm']->value['ReceiverID'];?>
">@<?php echo $_smarty_tpl->tpl_vars['comm']->value['Receiver'];?>
</a>
			<?php echo $_smarty_tpl->tpl_vars['comm']->value['Comment'];?>

			<?php }?>
		</div>
					
		
		<div class='comment-footer'>
			<span class='comment-time'><?php echo $_smarty_tpl->tpl_vars['comm']->value['Time'];?>
</span>
			<span class='btn btn-tiny btn-cmd cmd-new-comment'
				data-log-id="<?php echo $_smarty_tpl->tpl_vars['comm']->value['LogID'];?>
"
				data-parent-comment-id="<?php echo $_smarty_tpl->tpl_vars['comm']->value['CommentID'];?>
"
				data-poster-id="<?php echo $_smarty_tpl->tpl_vars['userID']->value;?>
"
				data-is-root='0'
				data-avatar-url="<?php echo $_smarty_tpl->tpl_vars['userAvatar']->value;?>
"
				>回复</span>
		</div>
	</div>
</div><?php }} ?>