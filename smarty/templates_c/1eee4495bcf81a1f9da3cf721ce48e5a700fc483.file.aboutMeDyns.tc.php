<?php /* Smarty version Smarty-3.1.12, created on 2012-10-23 11:03:35
         compiled from "..\view\dyn\aboutMeDyns.tc" */ ?>
<?php /*%%SmartyHeaderCode:1160950865c4fbdbdf9-40760622%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1eee4495bcf81a1f9da3cf721ce48e5a700fc483' => 
    array (
      0 => '..\\view\\dyn\\aboutMeDyns.tc',
      1 => 1350982898,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1160950865c4fbdbdf9-40760622',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_50865c50079ff2_04233435',
  'variables' => 
  array (
    'dyns' => 0,
    'dyn' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50865c50079ff2_04233435')) {function content_50865c50079ff2_04233435($_smarty_tpl) {?><?php  $_smarty_tpl->tpl_vars['dyn'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['dyn']->_loop = false;
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
	
			
	<?php if ($_smarty_tpl->tpl_vars['dyn']->value['Type']=='newCommentOnMyLog'){?>
	<div class='dynamic-content-wap'>
		<div class='dynamic-header'>
			<a class='dynamic-goal-creater' href="PersonC.php?userID=<?php echo $_smarty_tpl->tpl_vars['dyn']->value['PosterID'];?>
"><?php echo $_smarty_tpl->tpl_vars['dyn']->value['Poster'];?>
</a>
			<?php if ($_smarty_tpl->tpl_vars['dyn']->value['CommentIsRoot']){?>
			<span>评论了我的目标</span>
			<a href="GoalC.php?act=details&goalID=<?php echo $_smarty_tpl->tpl_vars['dyn']->value['GoalID'];?>
" class='dynamic-goal-title'><?php echo $_smarty_tpl->tpl_vars['dyn']->value['GoalTitle'];?>
</a>
			<?php }else{ ?>
			<span>在我的目标</span>
			<a href="GoalC.php?act=details&goalID=<?php echo $_smarty_tpl->tpl_vars['dyn']->value['GoalID'];?>
" class='dynamic-goal-title'><?php echo $_smarty_tpl->tpl_vars['dyn']->value['GoalTitle'];?>
</a>
			<span>中回复</span>
			<?php }?>
			<span>：</span>
		</div>
		
		<div class='dynamic-log-wap'>
			<p class='dynamic-log-title'><?php echo $_smarty_tpl->tpl_vars['dyn']->value['LogTitle'];?>
</p>
			<p class='dynamic-log-content'><?php echo $_smarty_tpl->tpl_vars['dyn']->value['LogContent'];?>
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
		<?php echo $_smarty_tpl->getSubTemplate ('../goal/comments.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

		<?php } ?>
	</div>
	<?php }?>
	
					
	<?php }elseif($_smarty_tpl->tpl_vars['dyn']->value['Type']=='newCommentOnOtherLog'){?>
	<div class='dynamic-content-wap'>
		
		<div class='dynamic-header'>
			<a class='dynamic-goal-creater' href="PersonC.php?act=person&userID=<?php echo $_smarty_tpl->tpl_vars['dyn']->value['PosterID'];?>
"><?php echo $_smarty_tpl->tpl_vars['dyn']->value['Poster'];?>
</a>
			<span>在目标</span>
			<a href="GoalC.php?act=details&goalID=<?php echo $_smarty_tpl->tpl_vars['dyn']->value['GoalID'];?>
" class='dynamic-goal-title'><?php echo $_smarty_tpl->tpl_vars['dyn']->value['GoalTitle'];?>
</a>
			<span>中回复：</span>
		</div>
						
		
		<div class='dynamic-log-wap'>
			<p class='dynamic-log-title'><?php echo $_smarty_tpl->tpl_vars['dyn']->value['LogTitle'];?>
</p>
			<p class='dynamic-log-content'><?php echo $_smarty_tpl->tpl_vars['dyn']->value['LogContent'];?>
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
		<?php echo $_smarty_tpl->getSubTemplate ('../goal/comments.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

		<?php } ?>
	</div>
	<?php }?>
	
	
	<?php }elseif($_smarty_tpl->tpl_vars['dyn']->value['Type']=='newCheer'){?>
	<div class='dynamic-content-wap'>
		
		<p class='dynamic-header'>
			<a class='dynamic-goal-creater' href="PersonC.php?act=person&userID=<?php echo $_smarty_tpl->tpl_vars['dyn']->value['PosterID'];?>
"><?php echo $_smarty_tpl->tpl_vars['dyn']->value['Poster'];?>
</a>
			<span>鼓励了我的目标</span>
			<a href="GoalC.php?act=details&goalID=<?php echo $_smarty_tpl->tpl_vars['dyn']->value['GoalID'];?>
" class='dynamic-goal-title'><?php echo $_smarty_tpl->tpl_vars['dyn']->value['GoalTitle'];?>
</a>
		</p>

		
		<div class='dynamic-footer'>
			<p class='dynamic-time'><?php echo $_smarty_tpl->tpl_vars['dyn']->value['Time'];?>
</p>
		</div>
	</div>

		
	<?php }elseif($_smarty_tpl->tpl_vars['dyn']->value['Type']=='newFollow'){?>			
	<div class='dynamic-content-wap'>
		<p class='dynamic-header'>
			<a class='dynamic-goal-creater' href="Personc.php?act=person&userID=<?php echo $_smarty_tpl->tpl_vars['dyn']->value['PosterID'];?>
"><?php echo $_smarty_tpl->tpl_vars['dyn']->value['Poster'];?>
</a>
			<span>关注了我</span>
		</p>

		<div class='dynamic-footer'>
			<p class='dynamic-time'><?php echo $_smarty_tpl->tpl_vars['dyn']->value['Time'];?>
</p>
		</div>
	</div>
	<?php }?>

</div>
<?php } ?>	
<?php }} ?>