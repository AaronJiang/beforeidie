<?php /* Smarty version Smarty-3.1.12, created on 2012-12-27 14:52:22
         compiled from "..\view\person\person.tp" */ ?>
<?php /*%%SmartyHeaderCode:2882750dc529606ce01-68721232%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '408a68eee0c915ea04698cd6d0862e63ac44b953' => 
    array (
      0 => '..\\view\\person\\person.tp',
      1 => 1356615548,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2882750dc529606ce01-68721232',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'user' => 0,
    'isCreator' => 0,
    'hasGravatar' => 0,
    'goals' => 0,
    'goal' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_50dc529618ed96_88804618',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50dc529618ed96_88804618')) {function content_50dc529618ed96_88804618($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('../header.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array('title'=>((string)$_smarty_tpl->tpl_vars['user']->value['Username']),'page'=>'page-person'), 0);?>


<script type='text/javascript' src='../js/goal-comment.js'></script>
<script type="text/javascript">



$(document).ready(function(){
	
	// index
	$('.goal-index').each(function(index){
		$(this).text(index + 1);
	});



<?php if ($_smarty_tpl->tpl_vars['isCreator']->value){?>
	

	// lock
	$('.btn-lock').click(function(){
		var goalID = $(this).attr('data-goal-id'),
			isPublic = $(this).attr('data-is-public'),
			btn = $(this);

		$.ajax({
			url: 'PersonC.php',
			type: 'POST',
			data: {
				'act': 'change_goal_state',
				'goalID': goalID,
				'isPublic': isPublic
			},
			success: function(isSucc){
				if(isSucc){
					// 切换图标样式
					if(isPublic == 1){
						// 若之前为 unlock
						$(btn).removeClass('btn-lock-false');
						$(btn).attr({'title': '开锁啦', 'data-is-public': 0});
					} else {
						// 若之前为 lock
						$(btn).addClass('btn-lock-false');
						$(btn).attr({'title': '锁起来，只给自己看', 'data-is-public': 1});
					}
				}
			}
		});
	});

	// delete
	$('.btn-remove').click(function(){
		var goalID = $(this).attr('data-goal-id'),
			goalTitle = $(this).attr('data-goal-title'),
			isSure = confirm('确定舍弃 ' + goalTitle + " ?"),
			goalItem = $(this).parents('.goal-item').first();

		if(isSure){
			$.ajax({
				url: 'PersonC.php',
				type: 'POST',
				data: {
					'act': 'drop_goal',
					'goalID': goalID
				},
				success: function(isSucc){
					if(isSucc){
						$(goalItem).detach();

						// refresh index
						$('.goal-index').each(function(index){
							$(this).text(index + 1);
						});
					}
				}
			});
		}
	});

	
<?php }?>

});

</script>

<div id='user-info-wap' class="clearleft">
	<?php if ($_smarty_tpl->tpl_vars['isCreator']->value&&!$_smarty_tpl->tpl_vars['hasGravatar']->value){?>
	<a href="http://en.gravatar.com/" target="_blank" title="去 Gravatar 上传你的头像，全球通用哦，亲！"><img class='avatar avatar-side avatar-large' src='<?php echo $_smarty_tpl->tpl_vars['user']->value['AvatarUrl'];?>
' /></a>
	<?php }else{ ?>
	<img class='avatar avatar-side avatar-large' src='<?php echo $_smarty_tpl->tpl_vars['user']->value['AvatarUrl'];?>
' />
	<?php }?>

	<div id="user-info">
		<div id="title">
		<?php if ($_smarty_tpl->tpl_vars['isCreator']->value){?>
			Before I die I want to...
		<?php }else{ ?>
			<?php if ($_smarty_tpl->tpl_vars['user']->value['Sex']=='male'){?>
			Before he dies he wants to...
			<?php }else{ ?>
			Before she dies she wants to...
			<?php }?>
		<?php }?>
		</div>
		<div id="username"><?php echo $_smarty_tpl->tpl_vars['user']->value['Username'];?>
</div>
	</div>
</div>

<div class='goal-wap'>
	<?php  $_smarty_tpl->tpl_vars['goal'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['goal']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['goals']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['goal']->key => $_smarty_tpl->tpl_vars['goal']->value){
$_smarty_tpl->tpl_vars['goal']->_loop = true;
?>
	<div class="goal-item">
		<span class='goal-index'></span>
		<a class="goal-title" href='GoalC.php?act=details&goalID=<?php echo $_smarty_tpl->tpl_vars['goal']->value['GoalID'];?>
'><?php echo $_smarty_tpl->tpl_vars['goal']->value['Title'];?>
</a>
		
		<?php if ($_smarty_tpl->tpl_vars['isCreator']->value){?>
		<div class="extra-info-wap">

			<!-- lock -->
			<?php if ($_smarty_tpl->tpl_vars['goal']->value['IsPublic']){?>
			<span class="btn-icon btn-lock btn-lock-false" data-goal-id="<?php echo $_smarty_tpl->tpl_vars['goal']->value['GoalID'];?>
" data-is-public="1" title="锁起来，只给自己看"></span>
			<?php }else{ ?>
			<span class="btn-icon btn-lock" data-goal-id="<?php echo $_smarty_tpl->tpl_vars['goal']->value['GoalID'];?>
" data-is-public="0" title="开锁啦"></span>
			<?php }?>

			<!-- delete -->
			<span class="btn-icon btn-remove" data-goal-id="<?php echo $_smarty_tpl->tpl_vars['goal']->value['GoalID'];?>
" data-goal-title="<?php echo $_smarty_tpl->tpl_vars['goal']->value['Title'];?>
" title="去掉它"></span>
		
		</div>
		<?php }?>

	</div>
	<?php } ?>
</div>

<?php echo $_smarty_tpl->getSubTemplate ('../footer.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>
<?php }} ?>