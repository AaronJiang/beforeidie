<?php /* Smarty version Smarty-3.1.12, created on 2012-12-10 16:15:44
         compiled from "..\view\account\slogan.tc" */ ?>
<?php /*%%SmartyHeaderCode:158055092934e5fa132-92442296%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6f5a8be88edbdb8e14dcb4b5ed188e09f91eda30' => 
    array (
      0 => '..\\view\\account\\slogan.tc',
      1 => 1355028015,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '158055092934e5fa132-92442296',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5092934e616db2_49613671',
  'variables' => 
  array (
    'sInfo' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5092934e616db2_49613671')) {function content_5092934e616db2_49613671($_smarty_tpl) {?><p id='login-slogan'>	已经有 <b><?php echo $_smarty_tpl->tpl_vars['sInfo']->value['usersNum'];?>
</b> 位用户，在 <img id='logo' src='../imgs/new.png' /> 写下了 <b><?php echo $_smarty_tpl->tpl_vars['sInfo']->value['goalsNum'];?>
</b> 个目标<p><?php }} ?>