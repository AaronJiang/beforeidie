<?php /* Smarty version Smarty-3.1.12, created on 2012-11-01 09:42:05
         compiled from "..\view\user_dyns.tc" */ ?>
<?php /*%%SmartyHeaderCode:2319509235dd643059-74947621%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd9de8ae09ea90123878fb4207faf5128a916f388' => 
    array (
      0 => '..\\view\\user_dyns.tc',
      1 => 1351758717,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2319509235dd643059-74947621',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'dyns' => 0,
    'dyn' => 0,
    'userID' => 0,
    'userAvatar' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_509235dd9d23a1_52984980',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_509235dd9d23a1_52984980')) {function content_509235dd9d23a1_52984980($_smarty_tpl) {?><?php  $_smarty_tpl->tpl_vars['dyn'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['dyn']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['dyns']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['dyn']->key => $_smarty_tpl->tpl_vars['dyn']->value){
$_smarty_tpl->tpl_vars['dyn']->_loop = true;
?>
<div class='dynamic-item clearfix new-comment-parent'>
	
		
	<a href="PersonC.php?act=person&userID=<?php echo $_smarty_tpl->tpl_vars['dyn']->value['PosterID'];?>
">
		<img class='dynamic-poster-profile' 
			title="<?php echo $_smarty_tpl->tpl_vars['dyn']->value['Poster'];?>
"
			src="<?php echo $_smarty_tpl->tpl_vars['dyn']->value['PosterAvatar'];?>
" />
	</a>

	
	<?php if ($_smarty_tpl->tpl_vars['dyn']->value['Type']=='newLog'){?>
	<div class='dynamic-content-wap'>
		
		<p class='dynamic-header'>	
			<a class="dynamic-goal-creater" href="PersonC.php?act=person&userID=<?php echo $_smarty_tpl->tpl_vars['dyn']->value['PosterID'];?>
"><?php echo $_smarty_tpl->tpl_vars['dyn']->value['Poster'];?>
</a>
			<span>在目标</span>
			<a href="GoalC.php?act=details&goalID=<?php echo $_smarty_tpl->tpl_vars['dyn']->value['GoalID'];?>
" class='dynamic-goal-title'><?php echo $_smarty_tpl->tpl_vars['dyn']->value['GoalTitle'];?>
</a>
			<span>中写到</span>
		</p>

		
		<?php if ($_smarty_tpl->tpl_vars['dyn']->value['LogTitle']!=''){?>
		<p class='dynamic-log-title'><?php echo $_smarty_tpl->tpl_vars['dyn']->value['LogTitle'];?>
</p>
		<?php }?>
		<p class='dynamic-log-content'><?php echo $_smarty_tpl->tpl_vars['dyn']->value['LogContent'];?>
</p>

		
		<div class='dynamic-footer'>
			<a class='small-cmd cmd-new-comment'
				data-poster-id="<?php echo $_smarty_tpl->tpl_vars['userID']->value;?>
"
				data-log-id="<?php echo $_smarty_tpl->tpl_vars['dyn']->value['LogID'];?>
"
				data-is-root='1'
				data-avatar-url="<?php echo $_smarty_tpl->tpl_vars['userAvatar']->value;?>
"
				>回复</a>
			<p class='dynamic-time'><?php echo $_smarty_tpl->tpl_vars['dyn']->value['Time'];?>
</p>
		</div>
	</div>

	
	<?php if ($_smarty_tpl->tpl_vars['dyn']->value['commentsNum']!=0){?>
	<div class='comments-wap'>
		<?php  $_smarty_tpl->tpl_vars['comm'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['comm']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['dyn']->value['comments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['comm']->key => $_smarty_tpl->tpl_vars['comm']->value){
$_smarty_tpl->tpl_vars['comm']->_loop = true;
?>
		<?php echo $_smarty_tpl->getSubTemplate ('comments.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

		<?php } ?>
	</div>
	<?php }?>

	
	<?php }elseif($_smarty_tpl->tpl_vars['dyn']->value['Type']=='newGoal'){?>
	<div class='dynamic-content-wap'>
	
		<p class='dynamic-header'>
			<a class='dynamic-goal-creater' href="PersonC.php?act=person&userID=<?php echo $_smarty_tpl->tpl_vars['dyn']->value['PosterID'];?>
"><?php echo $_smarty_tpl->tpl_vars['dyn']->value['Poster'];?>
</a>
			<span>设立了目标</span>
			<a href="GoalC.php?act=details&goalID=<?php echo $_smarty_tpl->tpl_vars['dyn']->value['GoalID'];?>
" class='dynamic-goal-title'><?php echo $_smarty_tpl->tpl_vars['dyn']->value['GoalTitle'];?>
</a>
		</p>
		
		<p class='dynamic-goal-reason'><?php echo $_smarty_tpl->tpl_vars['dyn']->value['GoalReason'];?>
</p>
	
		
		<div class='dynamic-footer'>
			<?php if (!$_smarty_tpl->tpl_vars['dyn']->value['isCheered']){?>
			<a class='small-cmd' href="GoalC.php?act=cheer&userID=<?php echo $_smarty_tpl->tpl_vars['userID']->value;?>
&goalID=<?php echo $_smarty_tpl->tpl_vars['dyn']->value['GoalID'];?>
">鼓励</a>
			<?php }?>
			
			<p class='dynamic-time'><?php echo $_smarty_tpl->tpl_vars['dyn']->value['Time'];?>
</p>
		</div>
	</div>

	
	<?php }elseif($_smarty_tpl->tpl_vars['dyn']->value['Type']=='finishGoal'){?>			
	<div class='dynamic-content-wap'>
		<p class='dynamic-header'>
			<a class='dynamic-goal-creater' href="PersonC.php?act=person&userID=<?php echo $_smarty_tpl->tpl_vars['dyn']->value['PosterID'];?>
"><?php echo $_smarty_tpl->tpl_vars['dyn']->value['Poster'];?>
</a>
			<span>完成了目标</span>
			<a href="GoalC.php?act=details&goalID=<?php echo $_smarty_tpl->tpl_vars['dyn']->value['GoalID'];?>
" class='dynamic-goal-title'><?php echo $_smarty_tpl->tpl_vars['dyn']->value['GoalTitle'];?>
</a>
		</p>

		<?php if ($_smarty_tpl->tpl_vars['dyn']->value['LogTitle']!=''){?>
		<p class='dynamic-log-title'><?php echo $_smarty_tpl->tpl_vars['dyn']->value['LogTitle'];?>
</p>
		<?php }?>
		<p class='dynamic-log-content'><?php echo $_smarty_tpl->tpl_vars['dyn']->value['LogContent'];?>
</p>
	
		
		<div class='dynamic-footer'>
			<a class='small-cmd cmd-new-comment'
				data-poster-id="<?php echo $_smarty_tpl->tpl_vars['userID']->value;?>
"
				data-log-id="<?php echo $_smarty_tpl->tpl_vars['dyn']->value['LogID'];?>
"
				data-is-root='1'
				data-avatar-url="<?php echo $_smarty_tpl->tpl_vars['userAvatar']->value;?>
"
				>回复</a>
			<p class='dynamic-time'><?php echo $_smarty_tpl->tpl_vars['dyn']->value['Time'];?>
</p>
		</div>
	</div>
	
	
	<?php if ($_smarty_tpl->tpl_vars['dyn']->value['commentsNum']!=0){?>
	<div class='comments-wap'>
		<?php  $_smarty_tpl->tpl_vars['comm'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['comm']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['dyn']->value['comments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['comm']->key => $_smarty_tpl->tpl_vars['comm']->value){
$_smarty_tpl->tpl_vars['comm']->_loop = true;
?>
		<?php echo $_smarty_tpl->getSubTemplate ('comments.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

		<?php } ?>
	</div>
	<?php }?>
	
	
	<?php }elseif($_smarty_tpl->tpl_vars['dyn']->value['Type']=='followOther'){?>	
	<div class='dynamic-content-wap'>
		<p class='dynamic-header'>
			<a class='dynamic-goal-creater' href="PersonC.php?act=person&userID=<?php echo $_smarty_tpl->tpl_vars['dyn']->value['PosterID'];?>
"><?php echo $_smarty_tpl->tpl_vars['dyn']->value['Poster'];?>
</a>
			<span>关注了</span>
			<a class='dynamic-goal-creater' href="PersonC.php?act=person&userID=<?php echo $_smarty_tpl->tpl_vars['dyn']->value['FolloweeID'];?>
"><?php echo $_smarty_tpl->tpl_vars['dyn']->value['Followee'];?>
</a>							
		</p>

		<div class='dynamic-footer'>
			<p class='dynamic-time'><?php echo $_smarty_tpl->tpl_vars['dyn']->value['Time'];?>
</p>
		</div>
	</div>
	<?php }?>

</div>
<?php } ?><?php }} ?>