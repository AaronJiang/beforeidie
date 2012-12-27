<?php /* Smarty version Smarty-3.1.12, created on 2012-12-27 14:26:02
         compiled from "..\view\account\register.tp" */ ?>
<?php /*%%SmartyHeaderCode:1118150a49511095f63-45547307%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b265fd231dc9dfab9b0d95a26183d4fc13ecd225' => 
    array (
      0 => '..\\view\\account\\register.tp',
      1 => 1356614206,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1118150a49511095f63-45547307',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_50a49511301b53_56289514',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50a49511301b53_56289514')) {function content_50a49511301b53_56289514($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('uheader.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>'注册','page'=>'page-register'), 0);?>
<?php echo $_smarty_tpl->getSubTemplate ('slogan.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<script type='text/javascript'>$(document).ready(function(){	$("#form-register").validationEngine();});</script><div id='form-wap'>	<form id='form-register' class='clearfix' action='AccountC.php'>		<input type='text' title='你常用的邮箱' class='validate[required, custom[email], ajax[ajaxEmailRepeat]]' placeholder='邮箱' autocomplete='off' name='email' id='email' />		<input type='text' title='你的称呼，亲！' class='validate[required, ajax[ajaxNameRepeat]]' placeholder='称呼' autocomplete='off' name='username' id="username" />		<input type='password' title='设置密码，6-16位之间，建议数字和字母混合。' id='pwd' class='validate[required, minSize[6]]' placeholder='密码' autocomplete='off' name='password' />				<input type='password' title='重复一遍又不会怀孕！' class='validate[required, equals[pwd]]' placeholder='重复密码' autocomplete='off' name='re-password' />				<div class='form-footer'>			<a href='AccountC.php?act=login'>登陆</a>			<input class="btn btn-primary btn-large" type='submit' value='注册'>		</div>				<input type='hidden' name='act' value='new_user'>	</form></div><?php echo $_smarty_tpl->getSubTemplate ('ufooter.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>