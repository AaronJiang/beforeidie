<?php /* Smarty version Smarty-3.1.12, created on 2012-11-10 13:32:32
         compiled from "..\view\goal\my_goals.tp" */ ?>
<?php /*%%SmartyHeaderCode:86855092389266ba61-86670242%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ff4ccf6f18376754a98af16d2527f0aabe8ef0da' => 
    array (
      0 => '..\\view\\goal\\my_goals.tp',
      1 => 1352550737,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '86855092389266ba61-86670242',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_50923892839931_85815615',
  'variables' => 
  array (
    'goals' => 0,
    'goalType' => 0,
    'goal' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50923892839931_85815615')) {function content_50923892839931_85815615($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('../header.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>'我的Goals','page'=>'page-my-goals'), 0);?>

 $_from = $_smarty_tpl->tpl_vars['goals']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['goal']->key => $_smarty_tpl->tpl_vars['goal']->value){
$_smarty_tpl->tpl_vars['goal']->_loop = true;
?>
'>
'>
</p>
</p>
</b> 记录</p>
"
"
"
<?php }} ?>