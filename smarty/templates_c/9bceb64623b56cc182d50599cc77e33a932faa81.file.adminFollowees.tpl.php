<?php /* Smarty version Smarty-3.1.12, created on 2012-10-22 13:43:37
         compiled from "..\view\dyn\adminFollowees.tpl" */ ?>
<?php /*%%SmartyHeaderCode:41595085312662ea80-84447898%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9bceb64623b56cc182d50599cc77e33a932faa81' => 
    array (
      0 => '..\\view\\dyn\\adminFollowees.tpl',
      1 => 1350906215,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '41595085312662ea80-84447898',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_50853126737cd1_16332464',
  'variables' => 
  array (
    'followeesNum' => 0,
    'followees' => 0,
    'fow' => 0,
    'userID' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50853126737cd1_16332464')) {function content_50853126737cd1_16332464($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('../header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>'管理我的关注','page'=>'page-admin-followees'), 0);?>


<p class='subtitle'>我的关注 (<?php echo $_smarty_tpl->tpl_vars['followeesNum']->value;?>
)</p>

<?php  $_smarty_tpl->tpl_vars['fow'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['fow']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['followees']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['fow']->key => $_smarty_tpl->tpl_vars['fow']->value){
$_smarty_tpl->tpl_vars['fow']->_loop = true;
?>
<div class='followee-item clearfix'>
	<a href="PersonC.php?act=person&userID=<?php echo $_smarty_tpl->tpl_vars['fow']->value['UserID'];?>
">
		<img class='user-avatar' title="<?php echo $_smarty_tpl->tpl_vars['fow']->value['Username'];?>
" src="<?php echo $_smarty_tpl->tpl_vars['fow']->value['Avatar'];?>
" />
	</a>
		
	<div class='user-info'>
		<p class='user-name'><a href="PersonC.php?act=person&userID=<?php echo $_smarty_tpl->tpl_vars['fow']->value['UserID'];?>
"><?php echo $_smarty_tpl->tpl_vars['fow']->value['Username'];?>
</a></p>
		<p class='goal-info'>
			<b><?php echo $_smarty_tpl->tpl_vars['fow']->value['GoalsNum']['now'];?>
</b> 进行
			&nbsp;|&nbsp;
			<b><?php echo $_smarty_tpl->tpl_vars['fow']->value['GoalsNum']['future'];?>
</b> 待启
			&nbsp;|&nbsp;
			<b><?php echo $_smarty_tpl->tpl_vars['fow']->value['GoalsNum']['finish'];?>
</b> 完成
		</p>
	</div>
	
	<div class='cmd-wap'>
		<a class='cmd' href="DynC.php?act=disfollow&followerID=<?php echo $_smarty_tpl->tpl_vars['userID']->value;?>
&followeeID=<?php echo $_smarty_tpl->tpl_vars['fow']->value['UserID'];?>
">取消关注</a>
	</div>
</div>
<?php } ?>

<?php echo $_smarty_tpl->getSubTemplate ('../footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>