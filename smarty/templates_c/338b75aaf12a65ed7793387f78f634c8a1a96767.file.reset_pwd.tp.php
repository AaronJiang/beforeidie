<?php /* Smarty version Smarty-3.1.12, created on 2012-10-25 09:05:54
         compiled from "..\view\account\reset_pwd.tp" */ ?>
<?php /*%%SmartyHeaderCode:212215088e3da4665f8-20943765%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '338b75aaf12a65ed7793387f78f634c8a1a96767' => 
    array (
      0 => '..\\view\\account\\reset_pwd.tp',
      1 => 1351148751,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '212215088e3da4665f8-20943765',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5088e3da5b4a22_18959626',
  'variables' => 
  array (
    'email' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5088e3da5b4a22_18959626')) {function content_5088e3da5b4a22_18959626($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('uheader.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>'重置密码','page'=>'page-reset-pwd'), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ('slogan.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


<script type='text/javascript'>

$(document).ready(function(){
	$('form-reset-pwd').validationEngine();	
});

</script>

<div id='form-wap'>
	<form id='form-reset-pwd' action='AccountC.php' method='post'>
		<input type='password' id='newPwd' class='validate[required, minSize[6]]' title='输入你的新密码，6-16位之间，建议数字和字母混合。' placeholder='新的密码' autocomplete='off' name='pwd' />
		
		<input type='password' class='validate[required, equals[newPwd]]' title='重复一遍又不会怀孕！' placeholder='重复密码' autocomplete='off' name='re-pwd' />

		<input type='hidden' name='email' value='<?php echo $_smarty_tpl->tpl_vars['email']->value;?>
'>
		
		<div class='form-footer'>
			<a href='AccountC.php?act=p_register'>注册</a>
			<a href='AccountC.php?act=login'>登陆</a>
			<input type='submit' value='提交'>
		</div>
		
		<input type='hidden' name='act' value='reset_pwd'>
	</form>
</div>

<?php echo $_smarty_tpl->getSubTemplate ('ufooter.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>