<?php /* Smarty version Smarty-3.1.12, created on 2012-12-15 04:04:02
         compiled from "..\view\account\active.tp" */ ?>
<?php /*%%SmartyHeaderCode:2584250b031823b1e91-35544556%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '700aa5430e44c45064cac750a22fdbd48a9fd754' => 
    array (
      0 => '..\\view\\account\\active.tp',
      1 => 1353724494,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2584250b031823b1e91-35544556',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_50b03182539725_29154801',
  'variables' => 
  array (
    'from' => 0,
    'email' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50b03182539725_29154801')) {function content_50b03182539725_29154801($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('uheader.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>'激活','page'=>'page-active-account'), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ('slogan.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


<div id='form-wap'>
	
	<?php if ($_smarty_tpl->tpl_vars['from']->value=='register'||$_smarty_tpl->tpl_vars['from']->value=='sended'){?>
	<p id='account-message'>亲，激活邮件已发送到你的邮箱，请进入邮箱激活账户吧！</p>
	
	<?php }elseif($_smarty_tpl->tpl_vars['from']->value=='unactive'){?>
	<p id='account-message'>亲，你的账户尚未激活，请进入邮箱激活账户吧！</p>
			
	<?php }elseif($_smarty_tpl->tpl_vars['from']->value=='activeError'){?>
	<p id='account-message'>亲，账户激活失败，请点击下方按钮再发一次激活邮件吧！</p>

	<?php }elseif($_smarty_tpl->tpl_vars['from']->value=='activeSucc'){?>
	<!-- 移除下方的发送表单 -->
	<script type='text/javascript'>
		$(document).ready(function(){
			$('#form-send-active-email').detach();
		});
	</script>
	<p id='account-message'>亲，账户激活成功，马上 <a href='AccountC.php?act=login'>登陆</a> 吧！</p>
	<?php }?>

	<form id='form-send-active-email' action='AccountC.php' method='post'>
		<div class='form-footer'>
			<a href='AccountC.php?act=login'>登陆</a>
			<input class="btn btn-large btn-primary" type='submit' value='再发一次' />
		</div>

		<input type='hidden' value='<?php echo $_smarty_tpl->tpl_vars['email']->value;?>
' name='email' />
		<input type='hidden' name='act' value='send_active_email' />
	</form>
</div>

<?php echo $_smarty_tpl->getSubTemplate ('ufooter.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>