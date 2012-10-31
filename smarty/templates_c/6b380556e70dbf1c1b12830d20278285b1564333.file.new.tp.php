<?php /* Smarty version Smarty-3.1.12, created on 2012-10-31 15:55:10
         compiled from "..\view\goal\new.tp" */ ?>
<?php /*%%SmartyHeaderCode:2893750913bcea25162-93236632%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6b380556e70dbf1c1b12830d20278285b1564333' => 
    array (
      0 => '..\\view\\goal\\new.tp',
      1 => 1351695029,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2893750913bcea25162-93236632',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'userID' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_50913bceaa39b1_72226482',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50913bceaa39b1_72226482')) {function content_50913bceaa39b1_72226482($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('../header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>'新的Goal','page'=>'page-new-goal'), 0);?>



<script type="text/javascript">
	$(document).ready(function(){
	
		$('#form-new-goal').validationEngine();
	
		$('#goal-starttime').datepicker({
			changeMonth: true,
			changeYear: true,
			showOtherMonths: true,
			selectOtherMonths: true
		});
	
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


<p class='subtitle'>设立新的 Goal</p>

<form id="form-new-goal" action="GoalC.php" method="post">
	<div>
		<input type="text" placeholder="写下你的目标" class='validate[required]' name="title" id="goal-title" autocomplete="off"/>
	</div>
	
	<div>
		<textarea rows="8" placeholder="简单地描绘一下你的愿景吧！" class='validate[required]' name="why" id="goal-why"></textarea>
	</div>
	
	<div>
		<select name="goalType" id="goal-type">
			<option value="now">立即启动</option>
			<option value="future">在未来启动</option>
		</select>
		<input type="text" name="startTime" id="goal-starttime" autocomplete="off"/>
	</div>
	
	<div>
		<select id='goal-ispublic' name='isPublic'>
			<option value='1'>公开</option>
			<option value='0'>私密</option>
		</select>
	</div>
	
	<input type="hidden" name="act" value="new_goal" />
	<input type="hidden" name="userID" value='<?php echo $_smarty_tpl->tpl_vars['userID']->value;?>
' />
	
	<input type="submit" id="create-goal" value="添加" />
</form>

<?php echo $_smarty_tpl->getSubTemplate ('../footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>