<?php /* Smarty version Smarty-3.1.12, created on 2012-12-03 13:50:01
         compiled from "..\view\person\followers.tp" */ ?>
<?php /*%%SmartyHeaderCode:8812509e3655f25b29-36069991%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f5b3351705a96f3ff97e66f3488bb26dac6434af' => 
    array (
      0 => '..\\view\\person\\followers.tp',
      1 => 1354538996,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8812509e3655f25b29-36069991',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_509e36560ce8d5_21449453',
  'variables' => 
  array (
    'username' => 0,
    'userID' => 0,
    'followersNum' => 0,
    'followers' => 0,
    'fow' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_509e36560ce8d5_21449453')) {function content_509e36560ce8d5_21449453($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('../header.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>"关注 ".((string)$_smarty_tpl->tpl_vars['username']->value)." 的人们",'page'=>'page-followers'), 0);?>


<h3 class="page-title">
	关注 <a href="PersonC.php?act=person&userID=<?php echo $_smarty_tpl->tpl_vars['userID']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['username']->value;?>
</a> 的人 / <?php echo $_smarty_tpl->tpl_vars['followersNum']->value;?>

</h3>

<?php  $_smarty_tpl->tpl_vars['fow'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['fow']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['followers']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
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
</div>
<?php } ?>

<?php echo $_smarty_tpl->getSubTemplate ('../footer.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>