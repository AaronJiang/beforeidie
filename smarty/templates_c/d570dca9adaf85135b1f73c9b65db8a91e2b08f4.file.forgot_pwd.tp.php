<?php /* Smarty version Smarty-3.1.12, created on 2012-11-15 03:11:04
         compiled from "..\view\account\forgot_pwd.tp" */ ?>
<?php /*%%SmartyHeaderCode:1519450a44f38471af6-75371155%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd570dca9adaf85135b1f73c9b65db8a91e2b08f4' => 
    array (
      0 => '..\\view\\account\\forgot_pwd.tp',
      1 => 1351698713,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1519450a44f38471af6-75371155',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'from' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_50a44f38635f24_38596767',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50a44f38635f24_38596767')) {function content_50a44f38635f24_38596767($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('uheader.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>'忘记密码','page'=>'page-forgot-pwd'), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ('slogan.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


<script type='text/javascript'>

$(document).ready(function(){
	$('#form-forgot-pwd').validationEngine();
});

</script>

<div id='form-wap'>
	
	<?php if ($_smarty_tpl->tpl_vars['from']->value=="login"){?>
	<p id='account-message'>亲，请输入你的邮箱，我们会把密码重置链接发过去哦！</p>
	
	<?php }elseif($_smarty_tpl->tpl_vars['from']->value=="sended"){?>
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
	<p id='account-message'>亲，密码重置成功，马上 <a href='AccountC.php?act=p_login'>登陆</a> 吧！</p>
	<!-- 移除下方的发送表单 -->
	<script type='text/javascript'>
		$(document).ready(function(){
			$('#form-forgot-pwd').detach();
		});
	</script>
	<?php }?>

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