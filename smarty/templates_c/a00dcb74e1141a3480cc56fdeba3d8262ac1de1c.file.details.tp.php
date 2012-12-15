<?php /* Smarty version Smarty-3.1.12, created on 2012-12-15 04:09:40
         compiled from "..\view\account\details.tp" */ ?>
<?php /*%%SmartyHeaderCode:341850937e85584b76-70932658%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a00dcb74e1141a3480cc56fdeba3d8262ac1de1c' => 
    array (
      0 => '..\\view\\account\\details.tp',
      1 => 1355540978,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '341850937e85584b76-70932658',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_50937e8564a530_29247132',
  'variables' => 
  array (
    'user' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50937e8564a530_29247132')) {function content_50937e8564a530_29247132($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('../header.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>'个人资料','page'=>'page-account-details'), 0);?>
<h3 class='page-title'>个人资料</h3><table id='table-account-details'>	<tr>		<td class='item-header'>用户：</td>		<td><?php echo $_smarty_tpl->tpl_vars['user']->value['Name'];?>
</td>	</tr>	<tr>		<td class='item-header'>头像：</td>		<td>			<img id='avatar' src='<?php echo $_smarty_tpl->tpl_vars['user']->value['Avatar'];?>
' />						<span>			<?php if ($_smarty_tpl->tpl_vars['user']->value['HasGravatar']){?>			(<a title='去 Gravatar 更换你的头像' 				target='_blank'				href='http://en.gravatar.com/emails/' 				class='btn btn-tiny btn-cmd'>更换</a>)			<?php }else{ ?>			(<a title='到 Gravatar 上传你的头像，全球认证哦，亲！' 				target='_blank'				href='http://en.gravatar.com/' 				class='btn btn-tiny btn-cmd'>上传</a>)						<?php }?>			</span>		</td>	</tr>	<tr>		<td class='item-header'>邮箱：</td>		<td><?php echo $_smarty_tpl->tpl_vars['user']->value['Email'];?>
</td>	</tr>		<tr>		<td class='item-header'>密码：</td>		<td>			<span>				(<a title='更改密码' href='AccountC.php?act=change_pwd' class='btn btn-tiny btn-cmd'>更改</a>)			</span>		</td>	</tr></table><?php echo $_smarty_tpl->getSubTemplate ('../footer.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>