<?php /* Smarty version Smarty-3.1.12, created on 2012-11-22 16:41:17
         compiled from "F:\xampp\htdocs\Goal\view\comments.tc" */ ?>
<?php /*%%SmartyHeaderCode:2498250ae479d884019-30699574%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2a3cc4cae2ce3a04ea2b6621aa14dc5a1ba4842c' => 
    array (
      0 => 'F:\\xampp\\htdocs\\Goal\\view\\comments.tc',
      1 => 1352964297,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2498250ae479d884019-30699574',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'comm' => 0,
    'userID' => 0,
    'userAvatar' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_50ae479d9deba2_98081815',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50ae479d9deba2_98081815')) {function content_50ae479d9deba2_98081815($_smarty_tpl) {?>

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