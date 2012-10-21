<?php /* Smarty version Smarty-3.1.12, created on 2012-10-21 14:33:17
         compiled from "..\view\goal\edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:45275083eb8dae9aa8-07502410%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0ba33c0b507836cd83df417eecfaae8aa5a37da0' => 
    array (
      0 => '..\\view\\goal\\edit.tpl',
      1 => 1350822794,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '45275083eb8dae9aa8-07502410',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'goal' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5083eb8dbf9148_05287097',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5083eb8dbf9148_05287097')) {function content_5083eb8dbf9148_05287097($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('../header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>'编辑Goal','page'=>'page-edit-goal'), 0);?>



<script type="text/javascript">
	$(document).ready(function(){
		$('#form-edit-goal').validationEngine();
	
		$('#goal-starttime').datepicker({
			changeMonth: true,
			changeYear: true,
			showOtherMonths: true,
			selectOtherMonths: true
		});
	
		if($('#goal-type')[0].selectedIndex == 1){
			$('#goal-starttime').show();
		}
		
		$('#goal-type').change(function(){
			var $time = $('#goal-starttime');
			if(this.selectedIndex == 1){
				$time.fadeIn('fast');
				$('#goal-starttime').datepicker('show');
			}
			else{
				$time.fadeOut('fast');
			}
		});
	});
</script>


<p class='subtitle'>编辑 Goal</p>

<form id="form-edit-goal" action="goal_proc.php" method="post">
	<div>
		<input type="text" name="title" class='validate[required]' id="goal-title" autocomplete="off" value="<?php echo $_smarty_tpl->tpl_vars['goal']->value['Title'];?>
" />
	</div>
			
	<div>
		<textarea rows="8" name="why" class='validate[required]' id="goal-why"><?php echo $_smarty_tpl->tpl_vars['goal']->value['Reason'];?>
</textarea>
	</div>
	
	<div style="display:<?php if ($_smarty_tpl->tpl_vars['goal']->value['GoalType']=='finish'){?>none<?php }else{ ?>block<?php }?>">
		<select name="goalType" id="goal-type">
			<option value="now" <?php if ($_smarty_tpl->tpl_vars['goal']->value['GoalType']=='now'){?>selected='selected'<?php }?>>立即启动梦想</option>
			<option value="future" <?php if ($_smarty_tpl->tpl_vars['goal']->value['GoalType']=='future'){?>selected='selected'<?php }?>>在未来启动梦想</option>
			<option value="finish" style="display:none" <?php if ($_smarty_tpl->tpl_vars['goal']->value['GoalType']=='finish'){?>selected='selected'<?php }?>></option>
		</select>
		<input type="text" name="startTime" id="goal-starttime" value="<?php echo $_smarty_tpl->tpl_vars['goal']->value['StartTime'];?>
" autocomplete="off"/>
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
	<input type="hidden" name="proc" value="update">
</form>

<?php echo $_smarty_tpl->getSubTemplate ('../footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>