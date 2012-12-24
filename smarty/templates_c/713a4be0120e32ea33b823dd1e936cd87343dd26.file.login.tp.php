<?php /* Smarty version Smarty-3.1.12, created on 2012-12-24 13:55:50
         compiled from "..\view\account\login.tp" */ ?>
<?php /*%%SmartyHeaderCode:285195092934e33fa62-64344460%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '713a4be0120e32ea33b823dd1e936cd87343dd26' => 
    array (
      0 => '..\\view\\account\\login.tp',
      1 => 1356353678,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '285195092934e33fa62-64344460',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5092934e528a21_40225000',
  'variables' => 
  array (
    'email' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5092934e528a21_40225000')) {function content_5092934e528a21_40225000($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('uheader.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>'登陆','page'=>'page-login'), 0);?>
<?php echo $_smarty_tpl->getSubTemplate ('slogan.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<script type='text/javascript'>$(document).ready(function(){	$("#form-login").validationEngine();});</script><div id='form-wap'>	<form id='form-login' action='AccountC.php' method='post'>		<input type='text' class='validate[required, custom[email]]' id='login-user' value="<?php echo $_smarty_tpl->tpl_vars['email']->value;?>
" placeholder='邮箱' class='required' minlength="6" autocomplete='off' name='email' />				<input type='password' class='validate[required]' id='login-pwd' placeholder='密码' class='required' minlength="6" autocomplete='off' name='password' />				<div class='form-footer'>			<a href='AccountC.php?act=forgot_pwd&from=login'>忘记密码</a>			<a href='AccountC.php?act=register'>注册</a>			<input class="btn btn-large btn-primary" type='submit' value='登陆'>		</div>				<input type='hidden' name='act' value='in'>	</form></div><?php echo $_smarty_tpl->getSubTemplate ('ufooter.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>