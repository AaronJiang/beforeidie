<?php /* Smarty version Smarty-3.1.12, created on 2012-11-10 15:40:35
         compiled from "..\view\home\home.tp" */ ?>
<?php /*%%SmartyHeaderCode:31409509293526ae268-11942860%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '72b905238d67c1e1b57f59e0732c67d17383d7ad' => 
    array (
      0 => '..\\view\\home\\home.tp',
      1 => 1352558415,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '31409509293526ae268-11942860',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_509293528393c3_71002865',
  'variables' => 
  array (
    'hotGoals' => 0,
    'goal' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_509293528393c3_71002865')) {function content_509293528393c3_71002865($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('../header.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>'发现','page'=>'page-home'), 0);?>
<p class='subtitle'>发现 Goal</p><?php  $_smarty_tpl->tpl_vars['goal'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['goal']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['hotGoals']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['goal']->key => $_smarty_tpl->tpl_vars['goal']->value){
$_smarty_tpl->tpl_vars['goal']->_loop = true;
?><div class='discover-goal-item'>	<p class='discover-goal-title'>		<a href='GoalC.php?act=details&goalID=<?php echo $_smarty_tpl->tpl_vars['goal']->value['GoalID'];?>
'><?php echo $_smarty_tpl->tpl_vars['goal']->value['Title'];?>
</a>	</p>		<p class='discover-goal-reason'><?php echo $_smarty_tpl->tpl_vars['goal']->value['Reason'];?>
</p>		<div class='goal-num-wap'>		<span><b><?php echo $_smarty_tpl->tpl_vars['goal']->value['LogsNum'];?>
</b> 记录</span>		<span>/</span>		<span><b><?php echo $_smarty_tpl->tpl_vars['goal']->value['CheersNum'];?>
</b> 鼓励</span>		<span>/</span>		<span><a href='PersonC.php?act=person&userID=<?php echo $_smarty_tpl->tpl_vars['goal']->value['CreatorID'];?>
'><?php echo $_smarty_tpl->tpl_vars['goal']->value['Creator'];?>
<a></span>	</div></div><?php } ?><?php echo $_smarty_tpl->getSubTemplate ('../footer.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>