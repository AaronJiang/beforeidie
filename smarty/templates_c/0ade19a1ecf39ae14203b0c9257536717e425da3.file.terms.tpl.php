<?php /* Smarty version Smarty-3.1.12, created on 2012-10-21 05:29:48
         compiled from "..\view\home\terms.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1063850835c636d3076-98842385%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0ade19a1ecf39ae14203b0c9257536717e425da3' => 
    array (
      0 => '..\\view\\home\\terms.tpl',
      1 => 1350790185,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1063850835c636d3076-98842385',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_50835c636d7459_11029523',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50835c636d7459_11029523')) {function content_50835c636d7459_11029523($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('../header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>'条款和隐私','page'=>'page-terms'), 0);?>


<div id='main-panel'>

	<p class='main-title'>使用条款<p>

	<ul>
		<li>
			本站不允许您发布任何带有政治、色情、暴力、诽谤、侮辱、威胁、猥亵、攻击或其他违反法律或公共秩序的文字或图片，也不允许您发布侵害他人名誉、隐私、商业机密、商标权、著作权、专利权或其他知识产权的文字或图片。管理员有权利删除不合适的内容。
		</li>

		<li>
			本站对由注册会员发布的任何内容不享有版权，内容的版权属于原始发布者，如果您需要拷贝、转载或引用部分内容，请提前获取发布者本人的许可。对于发布不当内容而带来的法律责任，也由发布者本人承担，如有必要，本站将配合司法机关进行相应的调查。
		</li>
	
		<li>
			对于黑客入侵等情形所造成的资料丢失或外流，本站不必负法律责任。
		</li>

		<li>
			本站希望能长期为您提供服务，但保留暂停或终止服务的权利。
		</li>
	</ul>
	
	<p class='main-title'>隐私保护</p>

	<ul>
		<li>
			在使Goal的过程中，您只需提供作为唯一标识的Email帐号，本站不会出售、交易您的Email。
		</li>
		
		<li>
			您的登录密码经过可靠的MD5单向加密后存入数据库，因此即使网站管理员也无法知道您的真正密码。
		</li>
			
		<li>
			本站不会将您记录在Goal上的任何信息以任何方式转让给第三方。
		</li>
	</ul>
</div>

<?php echo $_smarty_tpl->getSubTemplate ('me.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ('../footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>