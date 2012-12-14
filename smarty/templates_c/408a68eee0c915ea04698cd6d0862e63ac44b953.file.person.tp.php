<?php /* Smarty version Smarty-3.1.12, created on 2012-12-14 10:51:09
         compiled from "..\view\person\person.tp" */ ?>
<?php /*%%SmartyHeaderCode:4986509235e2350e62-48954490%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '408a68eee0c915ea04698cd6d0862e63ac44b953' => 
    array (
      0 => '..\\view\\person\\person.tp',
      1 => 1355478667,
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
    'likesNum' => 0,
    'goals' => 0,
    'goal' => 0,
    'isCreator' => 0,
    'IsLike' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_509235e26c2e46_48079691')) {function content_509235e26c2e46_48079691($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('../header.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>((string)$_smarty_tpl->tpl_vars['user']->value['Name'])." 的个人主页",'page'=>'page-person'), 0);?>


<script type='text/javascript' src='../js/goal-comment.js'></script>
<script type="text/javascript">


$(document).ready(function(){

	// index
	$('.goal-index').each(function(index){
		$(this).text(index + 1);
	})

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
			isSure = confirm('确定去掉 ' + goalTitle + " ?"),
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
					}
				}
			})
		}
	});
});


</script>

<div id='user-info-wap' class='clearfix'>
	<img class='avatar avatar-side avatar-large' src='<?php echo $_smarty_tpl->tpl_vars['user']->value['Avatar'];?>
' />

	<div id="user-info">
		<div id="username"><?php echo $_smarty_tpl->tpl_vars['user']->value['Name'];?>
</div>
		<div id="other-info-wap">
			以免当我生命终结时，发现自己，从来没有活过。
			<!--<div><a href='#'><?php echo $_smarty_tpl->tpl_vars['likesNum']->value;?>
 喜欢</a></div>-->
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
		
		<div class="extra-info-wap">
		<?php if ($_smarty_tpl->tpl_vars['isCreator']->value){?>

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

		<?php }else{ ?>

			<!-- like 
			<?php if ($_smarty_tpl->tpl_vars['IsLike']->value){?>
			<span class="btn-icon btn-like" data-goal-id="<?php echo $_smarty_tpl->tpl_vars['goal']->value['GoalID'];?>
" data-user-id="<?php echo $_SESSION['valid_user_id'];?>
" title="不喜欢啦"></span>
			<?php }else{ ?>
			<span class="btn-icon btn-like-false" data-goal-id="<?php echo $_smarty_tpl->tpl_vars['goal']->value['GoalID'];?>
" data-user-id="<?php echo $_SESSION['valid_user_id'];?>
" title="喜欢"></span>
			<?php }?>
			-->

		<?php }?>
		</div>

	</div>
	<?php } ?>
</div>

<?php echo $_smarty_tpl->getSubTemplate ('../footer.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>