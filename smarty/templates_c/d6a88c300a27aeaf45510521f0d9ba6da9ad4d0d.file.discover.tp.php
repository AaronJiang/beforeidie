<?php /* Smarty version Smarty-3.1.12, created on 2012-10-25 13:52:27
         compiled from "..\view\goal\discover.tp" */ ?>
<?php /*%%SmartyHeaderCode:971508927fb981dd7-67939263%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd6a88c300a27aeaf45510521f0d9ba6da9ad4d0d' => 
    array (
      0 => '..\\view\\goal\\discover.tp',
      1 => 1351165945,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '971508927fb981dd7-67939263',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'hotGoals' => 0,
    'goal' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_508927fba417e5_12337553',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_508927fba417e5_12337553')) {function content_508927fba417e5_12337553($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('../header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>'发现','page'=>'page-discover'), 0);?>

 $_from = $_smarty_tpl->tpl_vars['hotGoals']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['goal']->key => $_smarty_tpl->tpl_vars['goal']->value){
$_smarty_tpl->tpl_vars['goal']->_loop = true;
?>
'><?php echo $_smarty_tpl->tpl_vars['goal']->value['Title'];?>
</a>
</p>
'><?php echo $_smarty_tpl->tpl_vars['goal']->value['Creator'];?>
<a></p>
</b> 规划</span>
</b> 记录</span>
</b> 鼓励</span>
<?php }} ?>