<?php /* Smarty version Smarty-3.1.12, created on 2012-10-21 18:27:31
         compiled from "F:\xampp\htdocs\Dream\view\panel_header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:485508418f48d71d0-33852254%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e1800792d667413b4f2c59583bff5d9a611ca219' => 
    array (
      0 => 'F:\\xampp\\htdocs\\Dream\\view\\panel_header.tpl',
      1 => 1350836849,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '485508418f48d71d0-33852254',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_508418f48fa040_91263495',
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
<?php if ($_valid && !is_callable('content_508418f48fa040_91263495')) {function content_508418f48fa040_91263495($_smarty_tpl) {?><div class='panel-header'>	<div class='panel-title'><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</div>			<div class='panel-cmd-wapper'>			<?php ob_start();?><?php echo (($tmp = @$_smarty_tpl->tpl_vars['cmd']->value)===null||$tmp==='' ? '' : $tmp);?>
<?php $_tmp1=ob_get_clean();?><?php ob_start();?><?php echo (($tmp = @$_smarty_tpl->tpl_vars['isCreator']->value)===null||$tmp==='' ? '' : $tmp);?>
<?php $_tmp2=ob_get_clean();?><?php ob_start();?><?php echo (($tmp = @$_smarty_tpl->tpl_vars['isCreator']->value)===null||$tmp==='' ? '' : $tmp);?>
<?php $_tmp3=ob_get_clean();?><?php if ($_tmp1!=''&&(($_tmp2!=''&&$_smarty_tpl->tpl_vars['isCreator']->value)||$_tmp3=='')){?>			<span class='panel-underline'>_ _ _</span>			<a class="panel-cmd"				<?php ob_start();?><?php echo (($tmp = @$_smarty_tpl->tpl_vars['cmdID']->value)===null||$tmp==='' ? '' : $tmp);?>
<?php $_tmp4=ob_get_clean();?><?php if ($_tmp4!=''){?>				id="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['cmdID']->value)===null||$tmp==='' ? '' : $tmp);?>
"				<?php }?>				<?php ob_start();?><?php echo (($tmp = @$_smarty_tpl->tpl_vars['link']->value)===null||$tmp==='' ? '' : $tmp);?>
<?php $_tmp5=ob_get_clean();?><?php if ($_tmp5!=''){?>				href="<?php echo $_smarty_tpl->tpl_vars['link']->value;?>
"				<?php }?>				><?php echo $_smarty_tpl->tpl_vars['cmd']->value;?>
</a>			<?php }?>		</div></div><?php }} ?>