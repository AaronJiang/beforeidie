<?php /* Smarty version Smarty-3.1.12, created on 2012-10-22 10:39:19
         compiled from "..\view\home\home.tpl" */ ?>
<?php /*%%SmartyHeaderCode:262625083561a969784-37903799%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6bdd45a46df56176cecfecfa9c56711456f63f29' => 
    array (
      0 => '..\\view\\home\\home.tpl',
      1 => 1350873557,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '262625083561a969784-37903799',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5083561aa8b7a7_37061988',
  'variables' => 
  array (
    'goalNum' => 0,
    'goals' => 0,
    'goalType' => 0,
    'goal' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5083561aa8b7a7_37061988')) {function content_5083561aa8b7a7_37061988($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('../header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>'我的Goals','page'=>'page-home'), 0);?>

]</a></li>
]</a></li>
]</a></li>
 $_from = $_smarty_tpl->tpl_vars['goals']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['goal']->key => $_smarty_tpl->tpl_vars['goal']->value){
$_smarty_tpl->tpl_vars['goal']->_loop = true;
?>
'>
'>
</p>
</p>
</b> 启动</p>
</b> 达成</p>							
</b> 计划 | <b><?php echo $_smarty_tpl->tpl_vars['goal']->value['logsNum'];?>
</b> 记录</p>
"
'
'
"
'
'
<?php }} ?>