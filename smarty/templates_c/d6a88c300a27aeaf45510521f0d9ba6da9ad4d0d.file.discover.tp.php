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
</b> 鼓励</span>	</div></div><?php } ?><?php echo $_smarty_tpl->getSubTemplate ('../footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>