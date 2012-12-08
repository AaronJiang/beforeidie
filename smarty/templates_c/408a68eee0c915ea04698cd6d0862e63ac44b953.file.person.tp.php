<?php /* Smarty version Smarty-3.1.12, created on 2012-12-08 02:52:56
         compiled from "..\view\person\person.tp" */ ?>
<?php /*%%SmartyHeaderCode:4986509235e2350e62-48954490%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '408a68eee0c915ea04698cd6d0862e63ac44b953' => 
    array (
      0 => '..\\view\\person\\person.tp',
      1 => 1354931555,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4986509235e2350e62-48954490',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_509235e26c2e46_48079691',
  'variables' => 
  array (
    'user' => 0,
    'goals' => 0,
    'goal' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_509235e26c2e46_48079691')) {function content_509235e26c2e46_48079691($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('../header.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>((string)$_smarty_tpl->tpl_vars['user']->value['Name'])." 的个人主页",'page'=>'page-person'), 0);?>


<script type='text/javascript' src='../js/goal-comment.js'></script>

<div id='user-info-wap' class='clearfix'>
	<img class='avatar avatar-side avatar-large' src='<?php echo $_smarty_tpl->tpl_vars['user']->value['Avatar'];?>
' />

	<div id="user-info">
		<div id="username"><?php echo $_smarty_tpl->tpl_vars['user']->value['Name'];?>
</div>
		<div id="other-info-wap">
			<div><a href='#'>1 收藏</a></div>
		</div>
	</div>
</div>

<div class='goal-wap'>
	<?php  $_smarty_tpl->tpl_vars['goal'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['goal']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['goals']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['goal']->key => $_smarty_tpl->tpl_vars['goal']->value){
$_smarty_tpl->tpl_vars['goal']->_loop = true;
?>
	<div class='goal-item'>
		<div>
			<a class='goal-title' href='GoalC.php?act=details&goalID=<?php echo $_smarty_tpl->tpl_vars['goal']->value['GoalID'];?>
'><?php echo $_smarty_tpl->tpl_vars['goal']->value['Title'];?>
</a>
		</div>
		
		<div class='goal-reason'></div>
	</div>
	<?php } ?>
</div>

<?php echo $_smarty_tpl->getSubTemplate ('../footer.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>