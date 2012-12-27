<?php /* Smarty version Smarty-3.1.12, created on 2012-12-27 14:52:49
         compiled from "..\view\discover\discover.tp" */ ?>
<?php /*%%SmartyHeaderCode:99650dc52b18450d7-77396961%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fd039247c04473f593026e7bb80167af07968df0' => 
    array (
      0 => '..\\view\\discover\\discover.tp',
      1 => 1356349460,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '99650dc52b18450d7-77396961',
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
  'unifunc' => 'content_50dc52b19023f3_63740619',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50dc52b19023f3_63740619')) {function content_50dc52b19023f3_63740619($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('../header.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array('title'=>'发现','page'=>'page-discover'), 0);?>
<h3 class="page-title">Before they die...</h3><?php  $_smarty_tpl->tpl_vars['goal'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['goal']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['hotGoals']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['goal']->key => $_smarty_tpl->tpl_vars['goal']->value){
$_smarty_tpl->tpl_vars['goal']->_loop = true;
?><div class='goal-item'>	<div class='goal-title'>		<a href='GoalC.php?act=details&goalID=<?php echo $_smarty_tpl->tpl_vars['goal']->value['GoalID'];?>
'><?php echo $_smarty_tpl->tpl_vars['goal']->value['Title'];?>
</a>	</div>		<div class='goal-content'><?php echo $_smarty_tpl->tpl_vars['goal']->value['Content'];?>
</div>		<div class='goal-info-wap'>		by <a href='PersonC.php?act=person&userID=<?php echo $_smarty_tpl->tpl_vars['goal']->value['CreatorID'];?>
'><?php echo $_smarty_tpl->tpl_vars['goal']->value['Creator'];?>
</a>	</div></div><?php } ?><?php echo $_smarty_tpl->getSubTemplate ('../footer.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>
<?php }} ?>