<?php /* Smarty version Smarty-3.1.12, created on 2012-10-23 10:15:15
         compiled from "..\view\dyn\followeeDyns.tpl" */ ?>
<?php /*%%SmartyHeaderCode:24575085304da026a7-30353635%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1c475ee1b8befbd67b5ab14e235f0af385eb7c68' => 
    array (
      0 => '..\\view\\dyn\\followeeDyns.tpl',
      1 => 1350980113,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '24575085304da026a7-30353635',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5085304daff586_29913572',
  'variables' => 
  array (
    'userID' => 0,
    'followeesNum' => 0,
    'followees' => 0,
    'fow' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5085304daff586_29913572')) {function content_5085304daff586_29913572($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('../header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>'友邻动态','page'=>'page-followee-dynamics'), 0);?>

,

 $_from = $_smarty_tpl->tpl_vars['followees']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['fow']->key => $_smarty_tpl->tpl_vars['fow']->value){
$_smarty_tpl->tpl_vars['fow']->_loop = true;
?>
" href="person.php?userID=<?php echo $_smarty_tpl->tpl_vars['fow']->value['UserID'];?>
">
" />
<?php }} ?>