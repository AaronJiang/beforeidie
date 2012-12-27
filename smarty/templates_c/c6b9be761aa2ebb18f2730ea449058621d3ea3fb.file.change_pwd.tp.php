<?php /* Smarty version Smarty-3.1.12, created on 2012-12-27 14:23:58
         compiled from "..\view\account\change_pwd.tp" */ ?>
<?php /*%%SmartyHeaderCode:70450a49883532c20-26678769%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c6b9be761aa2ebb18f2730ea449058621d3ea3fb' => 
    array (
      0 => '..\\view\\account\\change_pwd.tp',
      1 => 1356614620,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '70450a49883532c20-26678769',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_50a498835a6250_00918051',
  'variables' => 
  array (
    'userID' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50a498835a6250_00918051')) {function content_50a498835a6250_00918051($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('../header.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>'更改密码','page'=>'page-change-pwd'), 0);?>



<script type='text/javascript'>

$(document).ready(function(){
	
	$('#form-change-pwd').validationEngine();
	
	$("#cancel-btn").click(function(){
		window.history.go(-1);
	});
});
</script>


<h3 class='page-title'>更改密码</h3>

<form id='form-change-pwd' action='AccountC.php' method='post'>
	<input type='password' class='validate[required, ajax[ajaxPwdCorrect]]' autocomplete='off' placeholder='原密码' name='originalPwd' id='originalPwd' />

	<input type='password' class='validate[required, minSize[6]]' minlength='6' id='newPwd' autocomplete='off' placeholder='新密码' name='newPwd' />

	<input type='password' class='validate[required, equals[newPwd]]' autocomplete='off' equalto='#newPwd' placeholder='重复新密码' name='reNewPwd' />

	<div>
		<input class="btn btn-primary" type='submit' value='修改'>
		<input class='btn' type='button' id='cancel-btn' value='取消'>
	</div>

	<input type='hidden' name='userID' value='<?php echo $_smarty_tpl->tpl_vars['userID']->value;?>
'>
	<input type='hidden' name='act' value='change_password'>
</form>


<?php echo $_smarty_tpl->getSubTemplate ('../footer.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>