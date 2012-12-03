<?php /* Smarty version Smarty-3.1.12, created on 2012-12-03 08:27:24
         compiled from "..\view\person\dyns.tc" */ ?>
<?php /*%%SmartyHeaderCode:2328350b0b1695adfc9-54763426%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2d3286c764b8f7e2848e694c2ed09ea5efe0d3b3' => 
    array (
      0 => '..\\view\\person\\dyns.tc',
      1 => 1354519572,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2328350b0b1695adfc9-54763426',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_50b0b16973b9b9_12462695',
  'variables' => 
  array (
    'dyns' => 0,
    'dyn' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50b0b16973b9b9_12462695')) {function content_50b0b16973b9b9_12462695($_smarty_tpl) {?><?php  $_smarty_tpl->tpl_vars['dyn'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['dyn']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['dyns']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['dyn']->key => $_smarty_tpl->tpl_vars['dyn']->value){
$_smarty_tpl->tpl_vars['dyn']->_loop = true;
?>
<div class='dynamic-item clearfix new-comment-parent'>
	
		
	<a href="PersonC.php?act=person&userID=<?php echo $_smarty_tpl->tpl_vars['dyn']->value['PosterID'];?>
">
		<img class="avatar avatar-side" title="<?php echo $_smarty_tpl->tpl_vars['dyn']->value['Poster'];?>
" src="<?php echo $_smarty_tpl->tpl_vars['dyn']->value['PosterAvatar'];?>
" />
	</a>

	
	<?php if ($_smarty_tpl->tpl_vars['dyn']->value['Type']=='newGoal'){?>
	<div class='dynamic-content-wap'>
	
		<p class='dynamic-header'>
			<a class='dynamic-goal-creater' href="PersonC.php?act=person&userID=<?php echo $_smarty_tpl->tpl_vars['dyn']->value['PosterID'];?>
"><?php echo $_smarty_tpl->tpl_vars['dyn']->value['Poster'];?>
</a>
			<span>想</span>
			<a href="GoalC.php?act=details&goalID=<?php echo $_smarty_tpl->tpl_vars['dyn']->value['GoalID'];?>
" class='dynamic-goal-title'><?php echo $_smarty_tpl->tpl_vars['dyn']->value['GoalTitle'];?>
</a>
		</p>
		
		<p class='dynamic-goal-reason'><?php echo $_smarty_tpl->tpl_vars['dyn']->value['GoalReason'];?>
</p>
	
		
		<div class='dynamic-footer'>
			<span class='dynamic-time'><?php echo $_smarty_tpl->tpl_vars['dyn']->value['Time'];?>
</span>
		</div>
	</div>
	<?php }?>

</div>
<?php } ?><?php }} ?>