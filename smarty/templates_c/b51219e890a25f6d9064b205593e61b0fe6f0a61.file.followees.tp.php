<?php /* Smarty version Smarty-3.1.12, created on 2012-12-03 14:29:10
         compiled from "..\view\person\followees.tp" */ ?>
<?php /*%%SmartyHeaderCode:24351509e3652ec2016-83359460%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b51219e890a25f6d9064b205593e61b0fe6f0a61' => 
    array (
      0 => '..\\view\\person\\followees.tp',
      1 => 1354538987,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '24351509e3652ec2016-83359460',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_509e365302e6d4_40956103',
  'variables' => 
  array (
    'username' => 0,
    'userID' => 0,
    'followeesNum' => 0,
    'followees' => 0,
    'fow' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_509e365302e6d4_40956103')) {function content_509e365302e6d4_40956103($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('../header.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>((string)$_smarty_tpl->tpl_vars['username']->value)." 关注的人们",'page'=>'page-followees'), 0);?>


<h3 class="page-title">
	<a href='PersonC.php?act=person&userID=<?php echo $_smarty_tpl->tpl_vars['userID']->value;?>
'><?php echo $_smarty_tpl->tpl_vars['username']->value;?>
</a> 关注的人 / <?php echo $_smarty_tpl->tpl_vars['followeesNum']->value;?>

</h3>

<?php  $_smarty_tpl->tpl_vars['fow'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['fow']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['followees']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['fow']->key => $_smarty_tpl->tpl_vars['fow']->value){
$_smarty_tpl->tpl_vars['fow']->_loop = true;
?>
<div class='followee-item clearfix'>
	<a href="PersonC.php?act=person&userID=<?php echo $_smarty_tpl->tpl_vars['fow']->value['UserID'];?>
">
		<img class='avatar avatar-side' title="<?php echo $_smarty_tpl->tpl_vars['fow']->value['Username'];?>
" src="<?php echo $_smarty_tpl->tpl_vars['fow']->value['Avatar'];?>
" />
	</a>
		
	<div class='user-info'>
		<div class='user-name'><a href="PersonC.php?act=person&userID=<?php echo $_smarty_tpl->tpl_vars['fow']->value['UserID'];?>
"><?php echo $_smarty_tpl->tpl_vars['fow']->value['Username'];?>
</a></div>
		<div class='goal-info'><b><?php echo $_smarty_tpl->tpl_vars['fow']->value['GoalsNum'];?>
</b> 目标</div>
	</div>
	
	<div class='cmd-wap'>
		<a class='btn btn-primary' href="DynC.php?act=disfollow_user&followerID=<?php echo $_smarty_tpl->tpl_vars['userID']->value;?>
&followeeID=<?php echo $_smarty_tpl->tpl_vars['fow']->value['UserID'];?>
">取消关注</a>
	</div>
</div>
<?php } ?>

<?php echo $_smarty_tpl->getSubTemplate ('../footer.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>