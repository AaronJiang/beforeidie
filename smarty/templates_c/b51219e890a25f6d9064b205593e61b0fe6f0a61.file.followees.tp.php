<?php /* Smarty version Smarty-3.1.12, created on 2012-11-01 08:14:48
         compiled from "..\view\person\followees.tp" */ ?>
<?php /*%%SmartyHeaderCode:1906650913a19cd5329-88697013%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b51219e890a25f6d9064b205593e61b0fe6f0a61' => 
    array (
      0 => '..\\view\\person\\followees.tp',
      1 => 1351753200,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1906650913a19cd5329-88697013',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_50913a19da6738_11556155',
  'variables' => 
  array (
    'username' => 0,
    'userID' => 0,
    'followees' => 0,
    'fow' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50913a19da6738_11556155')) {function content_50913a19da6738_11556155($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('../header.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>((string)$_smarty_tpl->tpl_vars['username']->value)." 关注的人们",'page'=>'page-followees'), 0);?>


<p class='subtitle'><a href='PersonC.php?act=person&userID=<?php echo $_smarty_tpl->tpl_vars['userID']->value;?>
'><?php echo $_smarty_tpl->tpl_vars['username']->value;?>
</a> 关注的人们：</p>

<?php  $_smarty_tpl->tpl_vars['fow'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['fow']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['followees']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
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

<?php echo $_smarty_tpl->getSubTemplate ('../footer.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>