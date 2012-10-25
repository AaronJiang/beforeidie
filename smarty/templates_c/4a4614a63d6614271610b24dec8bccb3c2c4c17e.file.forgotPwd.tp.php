<?php /* Smarty version Smarty-3.1.12, created on 2012-10-25 08:31:56
         compiled from "..\view\account\forgotPwd.tp" */ ?>
<?php /*%%SmartyHeaderCode:316825088dc8f2087b3-88014189%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4a4614a63d6614271610b24dec8bccb3c2c4c17e' => 
    array (
      0 => '..\\view\\account\\forgotPwd.tp',
      1 => 1351146713,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '316825088dc8f2087b3-88014189',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5088dc8f312650_18470353',
  'variables' => 
  array (
    'from' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5088dc8f312650_18470353')) {function content_5088dc8f312650_18470353($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('uheader.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>'忘记密码','page'=>'page-forgot-pwd'), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ('slogan.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


<script type='text/javascript'>

$(document).ready(function(){
	$('#form-forgot-pwd').validationEngine();
});

</script>

<div id='form-wap'>
	
	<?php if ($_smarty_tpl->tpl_vars['from']->value=="login"){?>
	<p id='account-message'>亲，请输入你的邮箱，我们会把密码重置链接发过去哦！</p>
			
	<?php  }else{ if (!isset($_smarty_tpl->tpl_vars['from'])) $_smarty_tpl->tpl_vars['from'] = new Smarty_Variable(null);if ($_smarty_tpl->tpl_vars['from']->value = "sended"){?>
	<p id='account-message'>亲，密码重置链接已发送，请进入邮箱完成重置操作吧！</p>
	<!-- 移除下方的发送表单 -->
	<script type='text/javascript'>
		$(document).ready(function(){
			$('#form-forgot-pwd').detach();
		});
	</script>
	
	<?php }elseif($_smarty_tpl->tpl_vars['from']->value=="resetError"){?>
	<p id='account-message'>亲，密码重置失败，请输入你的邮箱再发一次吧！</p>

	<?php }elseif($_smarty_tpl->tpl_vars['from']->value=="resetSucc"){?>
	<p id='account-message'>亲，密码重置成功，马上 <a href='AccountC.php?act=login'>登陆</a> 吧！</p>
	<!-- 移除下方的发送表单 -->
	<script type='text/javascript'>
		$(document).ready(function(){
			$('#form-forgot-pwd').detach();
		});
	</script>
	<?php }}?>

	<form id='form-forgot-pwd' action='AccountC.php' method='post'>
		<input type='text' class='validate[required]' placeholder='邮箱' autocomplete='off' name='email' />
		
		<div class='form-footer'>
			<input type='submit' value='提交' />
			<input type='hidden' name='act' value='send_reset_pwd_email' />
		</div>		
	</form>
</div>

<?php echo $_smarty_tpl->getSubTemplate ('ufooter.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>