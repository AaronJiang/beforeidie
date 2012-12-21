<?php /* Smarty version Smarty-3.1.12, created on 2012-12-21 14:20:34
         compiled from "..\view\like\like.tp" */ ?>
<?php /*%%SmartyHeaderCode:1655150d31e1e15ec11-80859775%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e1f98666be4cbff553acc15d9e0b599d40e1359d' => 
    array (
      0 => '..\\view\\like\\like.tp',
      1 => 1356095989,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1655150d31e1e15ec11-80859775',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_50d31e1e23baa7_31703929',
  'variables' => 
  array (
    'goals' => 0,
    'goal' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50d31e1e23baa7_31703929')) {function content_50d31e1e23baa7_31703929($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('../header.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>"收藏",'page'=>'page-likes'), 0);?>


<h3 class='page-title'>收藏</h3>

<?php  $_smarty_tpl->tpl_vars['goal'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['goal']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['goals']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['goal']->key => $_smarty_tpl->tpl_vars['goal']->value){
$_smarty_tpl->tpl_vars['goal']->_loop = true;
?>
<div class="goal-item">
	<div class="goal-title"><a href="GoalC.php?act=details&goalID=<?php echo $_smarty_tpl->tpl_vars['goal']->value['GoalID'];?>
"><?php echo $_smarty_tpl->tpl_vars['goal']->value['Title'];?>
</a></div>
	<div class="goal-content"><?php echo $_smarty_tpl->tpl_vars['goal']->value['Content'];?>
</div>
	<div class="goal-creator">by <a href="PersonC.php?act=person&userID=<?php echo $_smarty_tpl->tpl_vars['goal']->value['UserID'];?>
"><?php echo $_smarty_tpl->tpl_vars['goal']->value['Username'];?>
</a></div>
</div>
<?php } ?>

<?php echo $_smarty_tpl->getSubTemplate ('../footer.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>