<?php /* Smarty version Smarty-3.1.12, created on 2012-10-31 15:34:23
         compiled from "..\view\dyn\dyns.tp" */ ?>
<?php /*%%SmartyHeaderCode:20211509132961a0da3-41490128%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ffdb63ec61991f929da3f1122a6dd4c05db6694f' => 
    array (
      0 => '..\\view\\dyn\\dyns.tp',
      1 => 1351693751,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20211509132961a0da3-41490128',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5091329629f0d1_91793011',
  'variables' => 
  array (
    'userID' => 0,
    'followeesNum' => 0,
    'followees' => 0,
    'fow' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5091329629f0d1_91793011')) {function content_5091329629f0d1_91793011($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('../header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>'友邻动态','page'=>'page-followee-dynamics'), 0);?>

,

 $_from = $_smarty_tpl->tpl_vars['followees']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['fow']->key => $_smarty_tpl->tpl_vars['fow']->value){
$_smarty_tpl->tpl_vars['fow']->_loop = true;
?>
" href="person.php?userID=<?php echo $_smarty_tpl->tpl_vars['fow']->value['UserID'];?>
">
" />
<?php }} ?>