<?php /* Smarty version Smarty-3.1.12, created on 2012-10-22 12:38:06
         compiled from "..\view\dyn\followee_dyns.tpl" */ ?>
<?php /*%%SmartyHeaderCode:233075085206a92ee39-62317596%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '98e076af81e3f65389fe2588c5c11a3e3d06df66' => 
    array (
      0 => '..\\view\\dyn\\followee_dyns.tpl',
      1 => 1350902283,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '233075085206a92ee39-62317596',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5085206a9f1415_93079622',
  'variables' => 
  array (
    'userID' => 0,
    'followeesNum' => 0,
    'followees' => 0,
    'fow' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5085206a9f1415_93079622')) {function content_5085206a9f1415_93079622($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('../header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>'动态','page'=>'page-followee-dynamics'), 0);?>

,

 $_from = $_smarty_tpl->tpl_vars['followees']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['fow']->key => $_smarty_tpl->tpl_vars['fow']->value){
$_smarty_tpl->tpl_vars['fow']->_loop = true;
?>
" href="person.php?userID=<?php echo $_smarty_tpl->tpl_vars['fow']->value['UserID'];?>
">
" />
<?php }} ?>