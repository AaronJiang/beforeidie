<?php /* Smarty version Smarty-3.1.12, created on 2012-11-14 16:45:48
         compiled from "F:\xampp\htdocs\Dream\view\panel_header.tc" */ ?>
<?php /*%%SmartyHeaderCode:21413509235e00a4a64-68713106%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e31f6be1c1cce65b97a4b18aac4043bec112e44a' => 
    array (
      0 => 'F:\\xampp\\htdocs\\Dream\\view\\panel_header.tc',
      1 => 1352907726,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '21413509235e00a4a64-68713106',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_509235e0237327_73541503',
  'variables' => 
  array (
    'title' => 0,
    'cmd' => 0,
    'isCreator' => 0,
    'cmdID' => 0,
    'link' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_509235e0237327_73541503')) {function content_509235e0237327_73541503($_smarty_tpl) {?><div class='panel-header'>	<div class='panel-title'><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</div>			<div class='panel-cmd-wapper'>			<?php ob_start();?><?php echo (($tmp = @$_smarty_tpl->tpl_vars['cmd']->value)===null||$tmp==='' ? '' : $tmp);?>
<?php $_tmp1=ob_get_clean();?><?php ob_start();?><?php echo (($tmp = @$_smarty_tpl->tpl_vars['isCreator']->value)===null||$tmp==='' ? '' : $tmp);?>
<?php $_tmp2=ob_get_clean();?><?php ob_start();?><?php echo (($tmp = @$_smarty_tpl->tpl_vars['isCreator']->value)===null||$tmp==='' ? '' : $tmp);?>
<?php $_tmp3=ob_get_clean();?><?php if ($_tmp1!=''&&(($_tmp2!=''&&$_smarty_tpl->tpl_vars['isCreator']->value)||$_tmp3=='')){?>			<span class='panel-underline'>_ _ _</span>			<a class="btn btn-small"				<?php ob_start();?><?php echo (($tmp = @$_smarty_tpl->tpl_vars['cmdID']->value)===null||$tmp==='' ? '' : $tmp);?>
<?php $_tmp4=ob_get_clean();?><?php if ($_tmp4!=''){?>				id="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['cmdID']->value)===null||$tmp==='' ? '' : $tmp);?>
"				<?php }?>				<?php ob_start();?><?php echo (($tmp = @$_smarty_tpl->tpl_vars['link']->value)===null||$tmp==='' ? '' : $tmp);?>
<?php $_tmp5=ob_get_clean();?><?php if ($_tmp5!=''){?>				href="<?php echo $_smarty_tpl->tpl_vars['link']->value;?>
"				<?php }?>				><?php echo $_smarty_tpl->tpl_vars['cmd']->value;?>
</a>			<?php }?>		</div></div><?php }} ?>