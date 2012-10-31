<?php /* Smarty version Smarty-3.1.12, created on 2012-10-31 15:41:36
         compiled from "..\view\person\followers.tp" */ ?>
<?php /*%%SmartyHeaderCode:15303509138a0642215-77134235%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f5b3351705a96f3ff97e66f3488bb26dac6434af' => 
    array (
      0 => '..\\view\\person\\followers.tp',
      1 => 1351068960,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15303509138a0642215-77134235',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'username' => 0,
    'userID' => 0,
    'followers' => 0,
    'fow' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_509138a06fab41_94506436',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_509138a06fab41_94506436')) {function content_509138a06fab41_94506436($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('../header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>"关注 ".((string)$_smarty_tpl->tpl_vars['username']->value)." 的人们",'page'=>'page-followers'), 0);?>


<p class='subtitle'>关注 <a href='PersonC.php?act=person&userID=<?php echo $_smarty_tpl->tpl_vars['userID']->value;?>
'><?php echo $_smarty_tpl->tpl_vars['username']->value;?>
</a> 的人们：</p>

<?php  $_smarty_tpl->tpl_vars['fow'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['fow']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['followers']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['fow']->key => $_smarty_tpl->tpl_vars['fow']->value){
$_smarty_tpl->tpl_vars['fow']->_loop = true;
?>
<a href='PersonC.php?act=person&userID=<?php echo $_smarty_tpl->tpl_vars['fow']->value['UserID'];?>
'>
	<img class='user-icon'
		src='<?php echo $_smarty_tpl->tpl_vars['fow']->value['Avatar'];?>
'
		title='<?php echo $_smarty_tpl->tpl_vars['fow']->value['Username'];?>
' />
</a>
<?php } ?>

<?php echo $_smarty_tpl->getSubTemplate ('../footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>