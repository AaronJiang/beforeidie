<?php /* Smarty version Smarty-3.1.12, created on 2012-10-24 10:56:16
         compiled from "..\view\dyn\followers.tp" */ ?>
<?php /*%%SmartyHeaderCode:171455087a934032607-03686953%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6b16e5e765da4848319683ba6ab2e2aaa2579273' => 
    array (
      0 => '..\\view\\dyn\\followers.tp',
      1 => 1351068960,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '171455087a934032607-03686953',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5087a934035d77_92295291',
  'variables' => 
  array (
    'username' => 0,
    'userID' => 0,
    'followers' => 0,
    'fow' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5087a934035d77_92295291')) {function content_5087a934035d77_92295291($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('../header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>"关注 ".((string)$_smarty_tpl->tpl_vars['username']->value)." 的人们",'page'=>'page-followers'), 0);?>


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