<?php /* Smarty version Smarty-3.1.12, created on 2012-10-24 10:57:02
         compiled from "..\view\dyn\followees.tp" */ ?>
<?php /*%%SmartyHeaderCode:326295087ad3458f566-25902349%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '39777c2e768568dfd01df3c4c3078b25b030cb36' => 
    array (
      0 => '..\\view\\dyn\\followees.tp',
      1 => 1351069021,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '326295087ad3458f566-25902349',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5087ad346650b7_48399950',
  'variables' => 
  array (
    'username' => 0,
    'userID' => 0,
    'followees' => 0,
    'fow' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5087ad346650b7_48399950')) {function content_5087ad346650b7_48399950($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('../header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>((string)$_smarty_tpl->tpl_vars['username']->value)." 关注的人们",'page'=>'page-followees'), 0);?>


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

<?php echo $_smarty_tpl->getSubTemplate ('../footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>