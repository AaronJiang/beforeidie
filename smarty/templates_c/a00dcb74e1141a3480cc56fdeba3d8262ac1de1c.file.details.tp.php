<?php /* Smarty version Smarty-3.1.12, created on 2012-11-01 08:11:24
         compiled from "..\view\account\details.tp" */ ?>
<?php /*%%SmartyHeaderCode:64435088ed907e3208-30070898%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a00dcb74e1141a3480cc56fdeba3d8262ac1de1c' => 
    array (
      0 => '..\\view\\account\\details.tp',
      1 => 1351753867,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '64435088ed907e3208-30070898',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5088ed908dc9c1_61429214',
  'variables' => 
  array (
    'user' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5088ed908dc9c1_61429214')) {function content_5088ed908dc9c1_61429214($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('../header.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>'个人资料','page'=>'page-account-details'), 0);?>
<p class='subtitle'>个人资料</p><table id='table-account-details'>	<tr>		<td class='item-header'>用户：</td>		<td><?php echo $_smarty_tpl->tpl_vars['user']->value['Name'];?>
</td>	</tr>	<tr>		<td class='item-header'>头像：</td>		<td>			<img id='avatar' src='<?php echo $_smarty_tpl->tpl_vars['user']->value['Avatar'];?>
' />						<span>			<?php if ($_smarty_tpl->tpl_vars['user']->value['HasGravatar']){?>			(<a title='在 Gravatar 更换你的头像' 				target='_blank' href='http://en.gravatar.com/emails/' 				class='small-cmd'>更换</a>)			<?php }else{ ?>			(<a title='在 Gravatar 上传你的头像，全球认证哦，亲！' 				target='_blank' href='http://en.gravatar.com/' 				class='small-cmd'>上传</a>)						<?php }?>			</span>		</td>	</tr>	<tr>		<td class='item-header'>邮箱：</td>		<td><?php echo $_smarty_tpl->tpl_vars['user']->value['Email'];?>
</td>	</tr>		<tr>		<td class='item-header'>密码：</td>		<td>			<span>(<a title='更改密码' href='AccountC.php?act=change_pwd' class='small-cmd'>更改</a>)</span>		</td>	</tr></table><?php echo $_smarty_tpl->getSubTemplate ('../footer.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>