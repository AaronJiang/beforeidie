<?php /* Smarty version Smarty-3.1.12, created on 2012-10-22 13:02:22
         compiled from "..\view\goal\cheerers.tpl" */ ?>
<?php /*%%SmartyHeaderCode:22198508527beb33dc3-85071821%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c2e925f2c837ec21254ffa8ac1da33f4083b6982' => 
    array (
      0 => '..\\view\\goal\\cheerers.tpl',
      1 => 1350903725,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '22198508527beb33dc3-85071821',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'goalID' => 0,
    'goalTitle' => 0,
    'cheerers' => 0,
    'cheerer' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_508527bebf9a02_50634455',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_508527bebf9a02_50634455')) {function content_508527bebf9a02_50634455($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('../header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>'鼓励 {$goalTitle} 的人们','page'=>'page-goal-cheerers'), 0);?>
	<p class='subtitle'>鼓励 <a href="GoalC.php?act=details&goalID=<?php echo $_smarty_tpl->tpl_vars['goalID']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['goalTitle']->value;?>
</a> 的人们：</p>		<?php  $_smarty_tpl->tpl_vars['cheerer'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cheerer']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['cheerers']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cheerer']->key => $_smarty_tpl->tpl_vars['cheerer']->value){
$_smarty_tpl->tpl_vars['cheerer']->_loop = true;
?>	<a href="PersonC.php?act=person&userID=<?php echo $_smarty_tpl->tpl_vars['cheerer']->value['UserID'];?>
">		<img class='user-icon'			src="<?php echo $_smarty_tpl->tpl_vars['cheerer']->value['Avatar'];?>
"			title="<?php echo $_smarty_tpl->tpl_vars['cheerer']->value['Username'];?>
" />	</a>	<?php } ?><?php echo $_smarty_tpl->getSubTemplate ('../footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>