<?php /* Smarty version Smarty-3.1.12, created on 2012-11-10 13:37:39
         compiled from "..\view\goal\edit.tp" */ ?>
<?php /*%%SmartyHeaderCode:17491509e2f5b59e7c5-65278564%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ded67ae390f7b771dd2e3f2c97cc883c55ce3785' => 
    array (
      0 => '..\\view\\goal\\edit.tp',
      1 => 1352551018,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17491509e2f5b59e7c5-65278564',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_509e2f5b6ed436_52921926',
  'variables' => 
  array (
    'goal' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_509e2f5b6ed436_52921926')) {function content_509e2f5b6ed436_52921926($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('../header.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>'编辑Goal','page'=>'page-edit-goal'), 0);?>



<script type="text/javascript">
	$(document).ready(function(){
		$('#form-edit-goal').validationEngine();
	});
</script>


<p class='subtitle'>编辑Goal</p>

<form id="form-edit-goal" action="GoalC.php" method="post">
	<div>
		<input type="text" name="title" class='validate[required]' id="goal-title" autocomplete="off" value="<?php echo $_smarty_tpl->tpl_vars['goal']->value['Title'];?>
" />
	</div>
			
	<div>
		<textarea rows="8" name="why" class='validate[required]' id="goal-why"><?php echo $_smarty_tpl->tpl_vars['goal']->value['Reason'];?>
</textarea>
	</div>

	<div>
		<select name="isPublic" id="goal-ispublic">
			<option value="1" <?php if ($_smarty_tpl->tpl_vars['goal']->value['IsPublic']==1){?> selected='selected'<?php }?>>公开</option>
			<option value="0" <?php if ($_smarty_tpl->tpl_vars['goal']->value['IsPublic']==0){?> selected='selected'<?php }?>>私密</option>
		</select>
	</div>

	<div>
		<input type="submit" value="确定" id="update-goal" />
	</div>
	
	<input type="hidden" name="goalID" value="<?php echo $_smarty_tpl->tpl_vars['goal']->value['GoalID'];?>
">
	<input type="hidden" name="act" value="update_goal">
</form>

<?php echo $_smarty_tpl->getSubTemplate ('../footer.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>