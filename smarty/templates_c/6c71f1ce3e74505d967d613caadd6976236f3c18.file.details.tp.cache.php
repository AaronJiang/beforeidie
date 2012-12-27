<?php /* Smarty version Smarty-3.1.12, created on 2012-12-27 14:52:40
         compiled from "..\view\goal\details.tp" */ ?>
<?php /*%%SmartyHeaderCode:651850dc52a805b016-71859922%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6c71f1ce3e74505d967d613caadd6976236f3c18' => 
    array (
      0 => '..\\view\\goal\\details.tp',
      1 => 1356597315,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '651850dc52a805b016-71859922',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'goal' => 0,
    'isCreator' => 0,
    'creator' => 0,
    'isLike' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_50dc52a8183ad8_29312595',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50dc52a8183ad8_29312595')) {function content_50dc52a8183ad8_29312595($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('../header.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array('title'=>((string)$_smarty_tpl->tpl_vars['goal']->value['Title']),'page'=>'page-goal-details'), 0);?>


<script type='text/javascript' src='../js/goal-comment.js'></script>
<script type="text/javascript">

<?php if ($_smarty_tpl->tpl_vars['isCreator']->value){?>

$(document).ready(function(){

	// save
	$(window).unload(function(){
		var goalID = $('#goal-title').data('goal-id'),
			goalTitle = $('#goal-title').text(),
			goalContent = $('#goal-content').html();
			
		$.ajax({
			url: 'GoalC.php',
			type: 'POST',
			async: false,
			data: {
				'act': 'update_goal',
				'goalID': goalID,
				'goalTitle': goalTitle,
				'goalContent': goalContent
			}
		});
	});

	// lock
	$('.btn-lock').click(function(){
		var goalID = $(this).attr('data-goal-id'),
			isPublic = $(this).attr('data-is-public'),
			btn = $(this);

		$.ajax({
			url: 'GoalC.php',
			type: 'POST',
			data: {
				'act': 'change_goal_state',
				'goalID': goalID,
				'isPublic': isPublic
			},
			success: function(isSucc){
				if(isSucc == 1){
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

	// like
	$('.btn-like').click(function(){
		var goalID = $(this).attr('data-goal-id'),
			userID = $(this).attr('data-user-id'),
			isLike = $(this).attr('data-is-like'),
			btn = $(this);

		$.ajax({
			url: 'GoalC.php',
			type: 'POST',
			data: {
				'act': 'change_goal_like',
				'goalID': goalID,
				'userID': userID,
				'isLike': isLike
			},
			success: function(isSucc){
				if(isSucc == 1){
					if(isLike == 1){
						// 若之前为 like
						$(btn).addClass('btn-like-false');
						$(btn).attr('data-is-like', 0);
					} else {
						// 若之前为 unlike
						$(btn).removeClass('btn-like-false');
						$(btn).attr('data-is-like', 1);
					}
				}
			}
		})
	});

});

<?php }?>

</script>

<div id='title-wap'>
	<h2 id="pre">
		<?php if ($_smarty_tpl->tpl_vars['isCreator']->value){?>
			Before I die I want to
		<?php }else{ ?>
			<?php if ($_smarty_tpl->tpl_vars['creator']->value['Sex']=='male'){?>
			Before he dies he wants to
			<?php }else{ ?>
			Before she dies she wants to
			<?php }?>
		<?php }?>
	</h2>
	<h2 id="goal-title" data-goal-id="<?php echo $_smarty_tpl->tpl_vars['goal']->value['GoalID'];?>
" contenteditable="<?php if ($_smarty_tpl->tpl_vars['isCreator']->value){?>true<?php }else{ ?>false<?php }?>"> <?php echo $_smarty_tpl->tpl_vars['goal']->value['Title'];?>
</h2>
	<div id="extra-info-wap">
		<?php if ($_smarty_tpl->tpl_vars['isCreator']->value){?>
			<!-- lock -->
			<?php if ($_smarty_tpl->tpl_vars['goal']->value['IsPublic']){?>
			<span class="btn-icon btn-lock btn-lock-false" data-goal-id="<?php echo $_smarty_tpl->tpl_vars['goal']->value['GoalID'];?>
" data-is-public="1" title="锁起来，只给自己看"></span>
			<?php }else{ ?>
			<span class="btn-icon btn-lock" data-goal-id="<?php echo $_smarty_tpl->tpl_vars['goal']->value['GoalID'];?>
" data-is-public="0" title="开锁啦"></span>
			<?php }?>
		<?php }else{ ?>
			<span id="goal-creator">by <a href="PersonC.php?act=person&userID=<?php echo $_smarty_tpl->tpl_vars['creator']->value['UserID'];?>
"><?php echo $_smarty_tpl->tpl_vars['creator']->value['Username'];?>
</a></span>
		<?php }?>
	</div>
</div>

<div id="goal-content" data-goal-id="<?php echo $_smarty_tpl->tpl_vars['goal']->value['GoalID'];?>
" contenteditable="<?php if ($_smarty_tpl->tpl_vars['isCreator']->value){?>true<?php }else{ ?>false<?php }?>"><?php echo $_smarty_tpl->tpl_vars['goal']->value['Content'];?>
</div>

<!-- 不为创造者且isLike不为空 -->
<?php if (!$_smarty_tpl->tpl_vars['isCreator']->value&&(($tmp = @$_smarty_tpl->tpl_vars['isLike']->value)===null||$tmp==='' ? 'unset' : $tmp)!='unset'){?>
	<?php if ($_smarty_tpl->tpl_vars['isLike']->value){?>
	<span class="btn-icon btn-like" data-goal-id="<?php echo $_smarty_tpl->tpl_vars['goal']->value['GoalID'];?>
" data-user-id="<?php echo $_SESSION['valid_user_id'];?>
" data-is-like="1"></span>
	<?php }else{ ?>
	<span class="btn-icon btn-like btn-like-false" data-goal-id="<?php echo $_smarty_tpl->tpl_vars['goal']->value['GoalID'];?>
" data-user-id="<?php echo $_SESSION['valid_user_id'];?>
" data-is-like="0"></span>
	<?php }?>
<?php }?>

<?php echo $_smarty_tpl->getSubTemplate ('../footer.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>
<?php }} ?>