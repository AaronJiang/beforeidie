<?php /* Smarty version Smarty-3.1.12, created on 2012-10-25 09:55:45
         compiled from "..\view\account\change_pwd.tp" */ ?>
<?php /*%%SmartyHeaderCode:182095088ee4c5a74a7-26851204%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c6b9be761aa2ebb18f2730ea449058621d3ea3fb' => 
    array (
      0 => '..\\view\\account\\change_pwd.tp',
      1 => 1351151741,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '182095088ee4c5a74a7-26851204',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5088ee4c6269c7_46553365',
  'variables' => 
  array (
    'userID' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5088ee4c6269c7_46553365')) {function content_5088ee4c6269c7_46553365($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('../header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>'更改密码','page'=>'page-change-pwd'), 0);?>



<script type='text/javascript'>

$(document).ready(function(){
	
	$('#form-change-pwd').validationEngine();
	
	$("#cancel-btn").click(function(){
		window.location = "account_page_details.php";
	});
});
</script>


<p class='subtitle'>更改密码</p>

<form id='form-change-pwd' action='AccountC.php' method='post'>
	<input type='password' class='validate[required]' autocomplete='off' placeholder='原密码' name='originalPwd' />

	<input type='password' class='validate[required, minSize[6]]' minlength='6' id='newPwd' autocomplete='off' placeholder='新密码' name='newPwd' />

	<input type='password' class='validate[required, equals[newPwd]]' autocomplete='off' equalto='#newPwd' placeholder='重复新密码' name='reNewPwd' />

	<div>
		<input type='submit' value='修改'>
		<input type='button' class='cancel' id='cancel-btn' value='取消'>
	</div>

	<input type='hidden' name='userID' value='<?php echo $_smarty_tpl->tpl_vars['userID']->value;?>
'>
	<input type='hidden' name='act' value='change_pwd'>
</form>


<?php echo $_smarty_tpl->getSubTemplate ('../footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>