<?php /* Smarty version Smarty-3.1.12, created on 2012-11-13 10:31:38
         compiled from "..\view\goal\new.tp" */ ?>
<?php /*%%SmartyHeaderCode:225625092389e5c3365-55689534%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6b380556e70dbf1c1b12830d20278285b1564333' => 
    array (
      0 => '..\\view\\goal\\new.tp',
      1 => 1352798564,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '225625092389e5c3365-55689534',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5092389e6abef7_81803631',
  'variables' => 
  array (
    'userID' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5092389e6abef7_81803631')) {function content_5092389e6abef7_81803631($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('../header.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>'新的Goal','page'=>'page-new-goal'), 0);?>



<script type="text/javascript">
	$(document).ready(function(){
		$('#form-new-goal').validationEngine();
	});
</script>


<h4 class="page-title">新的 Goal</h4>

<form id="form-new-goal" action="GoalC.php" method="post">
	<div>
		<input type="text" placeholder="写下你的目标" class='validate[required]' name="title" id="goal-title" autocomplete="off" />
	</div>
	
	<div>
		<textarea rows="8" placeholder="用几句话简单地介绍一下吧" class='validate[required]' name="why" id="goal-why"></textarea>
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
	<input type="submit" class="btn btn-primary" id="create-goal" value="添加" />
</form>

<?php echo $_smarty_tpl->getSubTemplate ('../footer.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>