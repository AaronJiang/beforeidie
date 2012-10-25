<?php /* Smarty version Smarty-3.1.12, created on 2012-10-25 03:40:35
         compiled from "..\view\account\slogan.tc" */ ?>
<?php /*%%SmartyHeaderCode:24386508898330fe528-49766016%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6f5a8be88edbdb8e14dcb4b5ed188e09f91eda30' => 
    array (
      0 => '..\\view\\account\\slogan.tc',
      1 => 1351129233,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '24386508898330fe528-49766016',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5088983311d764_40988485',
  'variables' => 
  array (
    'sInfo' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5088983311d764_40988485')) {function content_5088983311d764_40988485($_smarty_tpl) {?><p id='login-slogan'>	<span>已经有 <b><?php echo $_smarty_tpl->tpl_vars['sInfo']->value['usersNum'];?>
</b> 位用户，</span>	<span>在 <img id='logo' src='../imgs/new.png' /> 设立了 <b><?php echo $_smarty_tpl->tpl_vars['sInfo']->value['goalsNum'];?>
</b> 个目标，</span>	<span>写下了 <b><?php echo $_smarty_tpl->tpl_vars['sInfo']->value['logsNum'];?>
</b> 条记录</span><p><?php }} ?>