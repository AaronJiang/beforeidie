<?php /* Smarty version Smarty-3.1.12, created on 2012-11-01 08:35:03
         compiled from "..\view\home\home.tp" */ ?>
<?php /*%%SmartyHeaderCode:244455092205497a218-34180748%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '72b905238d67c1e1b57f59e0732c67d17383d7ad' => 
    array (
      0 => '..\\view\\home\\home.tp',
      1 => 1351753645,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '244455092205497a218-34180748',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_50922054cc3317_36746430',
  'variables' => 
  array (
    'hotGoals' => 0,
    'goal' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50922054cc3317_36746430')) {function content_50922054cc3317_36746430($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('../header.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>'发现','page'=>'page-discover'), 0);?>
<p class='subtitle'>发现有趣的 Goals</p><?php  $_smarty_tpl->tpl_vars['goal'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['goal']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['hotGoals']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['goal']->key => $_smarty_tpl->tpl_vars['goal']->value){
$_smarty_tpl->tpl_vars['goal']->_loop = true;
?><div class='discover-goal-item'>	<p class='discover-goal-title'>		<a href='goal_page_details.php?goalID=<?php echo $_smarty_tpl->tpl_vars['goal']->value['GoalID'];?>
'><?php echo $_smarty_tpl->tpl_vars['goal']->value['Title'];?>
</a>	</p>		<p class='discover-goal-reason'><?php echo $_smarty_tpl->tpl_vars['goal']->value['Reason'];?>
</p>		<p class='discover-goal-creator'>By <a href='Person.php?act=pserson&userID=<?php echo $_smarty_tpl->tpl_vars['goal']->value['CreatorID'];?>
'><?php echo $_smarty_tpl->tpl_vars['goal']->value['Creator'];?>
<a></p>		<div class='goal-num-wap'>		<span><b><?php echo $_smarty_tpl->tpl_vars['goal']->value['StepsNum'];?>
</b> 规划</span>		<span>|</span>		<span><b><?php echo $_smarty_tpl->tpl_vars['goal']->value['LogsNum'];?>
</b> 记录</span>		<span>|</span>		<span><b><?php echo $_smarty_tpl->tpl_vars['goal']->value['CheersNum'];?>
</b> 鼓励</span>	</div></div><?php } ?><?php echo $_smarty_tpl->getSubTemplate ('../footer.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>