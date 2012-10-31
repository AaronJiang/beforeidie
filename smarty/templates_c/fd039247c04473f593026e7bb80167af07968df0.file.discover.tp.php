<?php /* Smarty version Smarty-3.1.12, created on 2012-10-31 15:55:08
         compiled from "..\view\discover\discover.tp" */ ?>
<?php /*%%SmartyHeaderCode:52850913bcc8aed82-89630058%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fd039247c04473f593026e7bb80167af07968df0' => 
    array (
      0 => '..\\view\\discover\\discover.tp',
      1 => 1351165945,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '52850913bcc8aed82-89630058',
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
  'unifunc' => 'content_50913bcc9cc696_85060585',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50913bcc9cc696_85060585')) {function content_50913bcc9cc696_85060585($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('../header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>'发现','page'=>'page-discover'), 0);?>
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